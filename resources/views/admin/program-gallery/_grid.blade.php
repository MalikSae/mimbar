{{-- Partial: admin/program-gallery/_grid.blade.php --}}
{{-- Digunakan oleh index.blade.php (initial load) dan di-parse saat AJAX fetch --}}

<h3 style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 16px;">
    Foto — {{ $currentType === 'slider_home' ? 'Slider Home' : ucfirst($currentType) }}
</h3>

@if($galleries->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
        @foreach($galleries as $photo)
            <div style="position: relative; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--color-border);"
                 x-data="{ confirmDelete: false }">
                <img src="{{ asset('storage/' . $photo->file_path) }}"
                     alt="{{ $photo->caption ?? 'Foto program' }}"
                     loading="lazy"
                     style="width: 100%; height: 140px; object-fit: cover; display: block;">

                {{-- Delete button --}}
                <button @click="confirmDelete = true"
                        style="position: absolute; top: 6px; right: 6px; width: 28px; height: 28px;
                               background: rgba(0,0,0,0.55); border: none; border-radius: var(--radius-full);
                               color: white; cursor: pointer; display: flex; align-items: center;
                               justify-content: center; font-size: 14px; transition: background 0.2s;"
                        onmouseover="this.style.background='var(--color-danger)'"
                        onmouseout="this.style.background='rgba(0,0,0,0.55)'"
                        title="Hapus foto">
                    ✕
                </button>

                {{-- Confirm overlay --}}
                <div x-show="confirmDelete" x-cloak
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8);
                            display: flex; flex-direction: column; align-items: center;
                            justify-content: center; z-index: 10; padding: 10px; box-sizing: border-box;">
                    <span style="color: white; font-size: 13px; font-weight: 600; margin-bottom: 12px; text-align: center;">Hapus foto ini?</span>
                    <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                        <form action="{{ route('admin.program-gallery.destroy', $photo->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="padding: 7px 14px; background: var(--color-danger); color: white;
                                           border: none; border-radius: var(--radius-md); font-size: 12px;
                                           font-weight: 600; cursor: pointer; font-family: var(--font-body);">
                                Ya, Hapus
                            </button>
                        </form>
                        <button type="button" @click="confirmDelete = false"
                                style="padding: 7px 14px; background: rgba(255,255,255,0.15); color: white;
                                       border: 1px solid rgba(255,255,255,0.4); border-radius: var(--radius-md);
                                       font-size: 12px; font-weight: 600; cursor: pointer; font-family: var(--font-body); margin: 0;">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div style="text-align: center; padding: 48px 16px; color: var(--color-gray-400);">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
             stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px; display: block;">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
            <circle cx="12" cy="13" r="4"/>
        </svg>
        <p style="font-size: 14px; margin: 0;">
            Belum ada foto untuk program {{ $currentType === 'slider_home' ? 'Slider Home' : $currentType }}
        </p>
    </div>
@endif

{{-- Pagination --}}
@if($galleries->hasPages())
    <div style="margin-top: 20px;">
        {{ $galleries->appends(['type' => $currentType])->links() }}
    </div>
@endif
