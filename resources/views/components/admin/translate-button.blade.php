@props(['fields' => []])

@php
    $componentId = 'translate_' . uniqid();
    $fieldsJson = json_encode($fields);
@endphp

<div x-data="{{ $componentId }}()">
    <button type="button"
        @click="translate"
        :disabled="loading"
        style="background-color: var(--color-primary, #059669); transition: opacity 0.2s;"
        onmouseover="this.style.opacity='0.9'"
        onmouseout="this.style.opacity='1'"
        class="inline-flex items-center justify-center w-full gap-2 px-4 py-3 my-6 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed">
        <span x-show="!loading">🌐 Terjemahkan ke Arab</span>
        <span x-show="loading" class="flex items-center gap-2" style="display: none;">
            <svg class="w-4 h-4 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menerjemahkan...
        </span>
    </button>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('{{ $componentId }}', () => ({
        loading: false,
        fields: {!! $fieldsJson !!},

        async translate() {
            if (this.loading) return;
            this.loading = true;

            let payloadFields = {};
            for (let f of this.fields) {
                let el = document.getElementById(f.id);
                if (!el && f.type === 'html') {
                    el = document.querySelector('input[name="' + f.id + '"]');
                }
                if (el) {
                    payloadFields[f.id] = { text: el.value, type: f.type };
                }
            }

            try {
                let res = await fetch('{{ route('admin.translate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ fields: payloadFields })
                });

                let data = await res.json();

                if (data.success) {
                    const results = data.results || {};
                    for (let [key, translatedText] of Object.entries(results)) {
                        let targetId = key + '_ar';
                        let f = this.fields.find(x => x.id === key);

                        if (f && f.type === 'html') {
                            // Cara 1: langsung via registry instance (paling reliable)
                            if (window.tiptapEditors && window.tiptapEditors[targetId]) {
                                window.tiptapEditors[targetId].commands.setContent(translatedText);
                                // Sync hidden input
                                let hiddenInput = document.getElementById(targetId);
                                if (hiddenInput) hiddenInput.value = translatedText;
                            } else {
                                // Cara 2: fallback via event di editor element
                                // Editor element ID = targetId tapi dengan 'tiptap-editor-' prefix
                                // Contoh: content_ar → tiptap-editor-ar
                                let editorElId = 'tiptap-editor-' + targetId.replace('content_', '').replace('description_', '');
                                let editorEl = document.getElementById(editorElId);
                                if (editorEl) {
                                    editorEl.dispatchEvent(new CustomEvent('tiptap:set-content', {
                                        detail: { content: translatedText },
                                        bubbles: false
                                    }));
                                }
                                // Fallback hidden input
                                let targetInput = document.getElementById(targetId);
                                if (targetInput) {
                                    targetInput.value = translatedText;
                                    targetInput.dispatchEvent(new CustomEvent('tiptap:set-content', {
                                        detail: { content: translatedText },
                                        bubbles: true
                                    }));
                                }
                            }
                        } else {
                            let targetEl = document.getElementById(targetId);
                            if (targetEl) targetEl.value = translatedText;
                        }
                    }

                    // Success feedback
                    this.loading = false;
                    const successSpan = this.$el.querySelector('span[x-show]');
                    if (successSpan) {
                        const original = successSpan.innerText;
                        successSpan.innerText = 'Terjemahan selesai ✓';
                        setTimeout(() => { successSpan.innerText = original; }, 2500);
                    }
                    return;
                } else {
                    alert('Terjemahan gagal. Pastikan form awal telah diisi.');
                }
            } catch (e) {
                console.error(e);
                alert('Terjemahan gagal. Terjadi kesalahan jaringan atau server.');
            }
            this.loading = false;
        }
    }));
});
</script>
