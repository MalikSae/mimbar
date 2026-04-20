@extends('layouts.admin')
@section('title', 'Editor Landing Page: ' . $landingPage->title)

@stack('head')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

@section('content')
<div class="h-[calc(100vh-64px)] bg-gray-50 flex overflow-hidden w-full m-0" x-data="pageBuilder(@json($landingPage->blocks), '{{ $landingPage->slug }}')">
    
    <!-- PANEL KIRI -->
    <div class="w-[220px] bg-white border-r border-border flex flex-col h-full flex-shrink-0">
        <div class="p-4 border-b border-border bg-gray-50 flex items-center justify-between">
            <h2 class="text-sm font-bold text-gray-900 uppercase">Tambah Block</h2>
        </div>
        <div class="p-3 space-y-2 overflow-y-auto flex-1">
            @foreach($blockTypes as $type)
            <button type="button" @click="addBlock('{{ $type }}')" class="w-full text-left px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-primary-light hover:text-primary hover:border-primary-light rounded-lg border border-border transition-colors uppercase flex items-center justify-between">
                {{ str_replace('_', ' ', $type) }}
                <iconify-icon icon="lucide:plus" class="text-gray-400"></iconify-icon>
            </button>
            @endforeach
        </div>
        <div class="p-4 border-t border-border bg-gray-50">
            <p class="text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-wide">Preview Viewport</p>
            <div class="flex space-x-2">
                <button type="button" @click="viewportMode = 'desktop'" :class="viewportMode === 'desktop' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 hover:bg-gray-100 border-border'" class="flex-1 py-1.5 px-2 text-xs font-medium rounded border transition-colors flex justify-center items-center">
                    <iconify-icon icon="lucide:monitor" class="mr-1"></iconify-icon> Desktop
                </button>
                <button type="button" @click="viewportMode = 'mobile'" :class="viewportMode === 'mobile' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 hover:bg-gray-100 border-border'" class="flex-1 py-1.5 px-2 text-xs font-medium rounded border transition-colors flex justify-center items-center">
                    <iconify-icon icon="lucide:smartphone" class="mr-1"></iconify-icon> Mobile
                </button>
            </div>
        </div>
    </div>

    <!-- PANEL TENGAH -->
    <div class="flex-1 flex flex-col h-full overflow-hidden bg-muted">
        <!-- Header -->
        <div class="h-14 bg-white border-b border-border flex items-center justify-between px-6 flex-shrink-0 shadow-sm relative z-10">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.landing-pages.show', $landingPage) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                    <iconify-icon icon="lucide:arrow-left" class="text-xl"></iconify-icon>
                </a>
                <h1 class="text-base font-bold font-heading text-gray-900">{{ $landingPage->title }}</h1>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $landingPage->canvas_mode === 'full_canvas' ? 'bg-warning-surface text-warning' : 'bg-info-surface text-info' }}">{{ str_replace('_', ' ', $landingPage->canvas_mode) }}</span>
            </div>
            <div>
                <a href="/lp/{{ $landingPage->slug }}" target="_blank" class="text-sm font-medium text-primary hover:text-primary-dark flex items-center">
                    Buka di Tab Baru <iconify-icon icon="lucide:external-link" class="ml-1"></iconify-icon>
                </a>
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-6" id="middle-canvas-scroll">
            
            <div class="max-w-4xl mx-auto">
                <!-- Canvas area: daftar blocks (Sortable) -->
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Layers / Blocks</h2>
                    <span class="text-xs text-gray-500" x-text="blocks.length + ' blocks'"></span>
                </div>
                
                <div class="space-y-2 mb-8 min-h-[60px] bg-white p-3 rounded-xl border border-border shadow-sm" x-ref="sortableList">
                    <template x-for="(block, index) in blocks" :key="block.id">
                        <div class="flex items-center justify-between p-2.5 bg-gray-50 border border-border rounded-lg group hover:border-gray-300 transition-colors" :data-id="block.id" :class="activeBlock && activeBlock.id === block.id ? 'ring-2 ring-primary border-primary bg-primary-light/10' : ''">
                            <div class="flex items-center flex-1">
                                <div class="cursor-move text-gray-400 hover:text-gray-600 mr-2 px-1 py-2 sortable-handle relative group-hover:text-primary transition-colors">
                                    <iconify-icon icon="lucide:grip-vertical"></iconify-icon>
                                </div>
                                <span class="bg-gray-200 text-gray-600 text-[10px] font-bold px-1.5 py-0.5 rounded mr-3" x-text="block.order"></span>
                                <span class="text-sm font-semibold text-gray-800 uppercase tracking-wide" x-text="block.type.replace('_', ' ')"></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" @click="editBlock(block)" class="px-2.5 py-1 text-xs bg-white border border-border rounded text-primary hover:bg-primary-light transition-colors font-medium flex items-center">
                                    <iconify-icon icon="lucide:edit-2" class="mr-1"></iconify-icon> Edit
                                </button>
                                <button type="button" @click="deleteBlock(block)" class="px-2 py-1 text-xs bg-white border border-border rounded text-danger hover:bg-danger-surface transition-colors font-medium flex items-center">
                                    <iconify-icon icon="lucide:trash-2"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </template>
                    <template x-if="blocks.length === 0">
                        <div class="text-center py-6 text-gray-400 text-sm flex flex-col items-center">
                            <iconify-icon icon="lucide:layers" class="text-3xl mb-2 opacity-50"></iconify-icon>
                            Belum ada block. Tambahkan dari panel kiri.
                        </div>
                    </template>
                </div>

                <!-- Iframe Preview -->
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Live Preview</h2>
                    <button type="button" @click="refreshPreview()" class="text-xs text-primary hover:text-primary-dark font-medium flex items-center">
                        <iconify-icon icon="lucide:refresh-cw" class="mr-1 text-[10px]"></iconify-icon> Reload
                    </button>
                </div>
                
                <div class="flex justify-center bg-gray-200/50 border-2 border-dashed border-gray-300 rounded-xl p-4 overflow-hidden relative" style="min-height: 500px;">
                    <iframe 
                        x-ref="previewIframe"
                        src="/lp/{{ $landingPage->slug }}?preview=true" 
                        class="bg-white shadow-xl transition-all duration-300 origin-top overflow-hidden border border-gray-300"
                        :class="viewportMode === 'mobile' ? 'w-[390px] h-[844px] rounded-3xl' : 'w-full h-[800px] rounded-lg'"
                        frameborder="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL KANAN -->
    <div class="w-[320px] bg-white border-l border-border flex flex-col h-full shadow-[-4px_0_15px_-3px_rgba(0,0,0,0.05)] flex-shrink-0 transition-all duration-300 transform right-0" x-show="activeBlock !== null" x-transition:enter="duration-300 ease-out" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="duration-200 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" style="display: none;">
        
        <div class="h-14 border-b border-border flex items-center justify-between px-4 bg-gray-50 flex-shrink-0">
            <h2 class="text-sm font-bold text-gray-900 flex items-center">
                <iconify-icon icon="lucide:settings-2" class="mr-2 text-gray-400"></iconify-icon>
                <span x-text="activeBlock ? 'Edit ' + activeBlock.type.replace('_', ' ').toUpperCase() : ''"></span>
            </h2>
            <button type="button" @click="closePanel()" class="text-gray-400 hover:text-gray-900 transition-colors p-1 rounded hover:bg-gray-200">
                <iconify-icon icon="lucide:x" class="text-lg"></iconify-icon>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto">
            <template x-if="activeBlock">
                <div class="p-4 space-y-6">
                    
                    <!-- TOGGLE SETTINGS DESKTOP/MOBILE -->
                    <div class="flex space-x-1 p-1 bg-gray-100 rounded-lg border border-gray-200">
                        <button type="button" @click="activeTab = 'desktop'" :class="activeTab === 'desktop' ? 'bg-white shadow-sm text-primary font-bold' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-1.5 text-xs rounded-md transition-all flex items-center justify-center">
                            <iconify-icon icon="lucide:monitor" class="mr-1.5 text-[14px]"></iconify-icon> Desktop
                        </button>
                        <button type="button" @click="activeTab = 'mobile'" :class="activeTab === 'mobile' ? 'bg-white shadow-sm text-primary font-bold' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-1.5 text-xs rounded-md transition-all flex items-center justify-center">
                            <iconify-icon icon="lucide:smartphone" class="mr-1.5 text-[14px]"></iconify-icon> Mobile
                        </button>
                    </div>

                    <!-- CONTENT FIELDS -->
                    <div class="space-y-4">
                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-wide border-b border-border pb-1">Konten</h3>
                        
                        <!-- hero -->
                        <template x-if="activeBlock.type === 'hero'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Heading</label>
                                    <input type="text" x-model="activeBlock.content.heading" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Subheading</label>
                                    <textarea x-model="activeBlock.content.subheading" rows="3" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Button Label</label>
                                    <input type="text" x-model="activeBlock.content.button_label" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Button URL</label>
                                    <input type="text" x-model="activeBlock.content.button_url" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Image URL</label>
                                    <input type="text" x-model="activeBlock.content.image_url" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                    <p class="text-[10px] text-gray-500 mt-1">URL gambar atau path storage</p>
                                </div>
                            </div>
                        </template>

                        <!-- rich_text -->
                        <template x-if="activeBlock.type === 'rich_text'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1 flex items-center justify-between">
                                        Konten
                                        <span class="font-normal text-[10px] text-gray-400 lowercase">(mendukung HTML dasar)</span>
                                    </label>
                                    <textarea x-model="activeBlock.content.body" rows="12" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors font-mono text-[13px]"></textarea>
                                </div>
                            </div>
                        </template>

                        <!-- image -->
                        <template x-if="activeBlock.type === 'image'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Image URL</label>
                                    <input type="text" x-model="activeBlock.content.image_url" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Alt text</label>
                                    <input type="text" x-model="activeBlock.content.alt" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Keterangan gambar</label>
                                    <input type="text" x-model="activeBlock.content.caption" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                            </div>
                        </template>

                        <!-- donation_form -->
                        <template x-if="activeBlock.type === 'donation_form'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Campaign Title</label>
                                    <input type="text" x-model="activeBlock.content.campaign_title" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Target Amount</label>
                                    <input type="number" x-model.number="activeBlock.content.target_amount" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div class="flex items-center pt-1 mt-3">
                                    <input type="checkbox" :id="'show_prog_'+activeBlock.id" x-model="activeBlock.content.show_progress" class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                                    <label :for="'show_prog_'+activeBlock.id" class="ml-2 block text-sm font-medium text-gray-700">Tampilkan progress bar</label>
                                </div>
                            </div>
                        </template>

                        <!-- cta_button -->
                        <template x-if="activeBlock.type === 'cta_button'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Label</label>
                                    <input type="text" x-model="activeBlock.content.label" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">URL</label>
                                    <input type="text" x-model="activeBlock.content.url" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Style</label>
                                    <select x-model="activeBlock.content.style" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                        <option value="primary">Primary</option>
                                        <option value="secondary">Secondary</option>
                                        <option value="outline">Outline</option>
                                    </select>
                                </div>
                            </div>
                        </template>

                        <!-- progress_bar -->
                        <template x-if="activeBlock.type === 'progress_bar'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Label</label>
                                    <input type="text" x-model="activeBlock.content.label" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Current Amount</label>
                                    <input type="number" x-model.number="activeBlock.content.current_amount" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Target Amount</label>
                                    <input type="number" x-model.number="activeBlock.content.target_amount" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                            </div>
                        </template>

                        <!-- testimonial -->
                        <template x-if="activeBlock.type === 'testimonial'">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Quote</label>
                                    <textarea x-model="activeBlock.content.quote" rows="4" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Author</label>
                                    <input type="text" x-model="activeBlock.content.author" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Kota / Asal</label>
                                    <input type="text" x-model="activeBlock.content.location" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- SETTINGS FIELDS -->
                    <div class="space-y-4 pt-4 border-t border-border">
                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-wide border-b border-border pb-1" x-text="`Pengaturan ${activeTab}`"></h3>
                        
                        <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-border">
                            <input type="checkbox" :id="'visible_'+activeTab" x-model="activeBlock[activeTab + '_settings'].visible" class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                            <label :for="'visible_'+activeTab" class="ml-2 block text-sm font-medium text-gray-700" x-text="`Tampilkan di ${activeTab}`"></label>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Text Align</label>
                            <select x-model="activeBlock[activeTab + '_settings'].text_align" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Padding</label>
                            <select x-model="activeBlock[activeTab + '_settings'].padding" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                <option value="none">None</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Font Size</label>
                            <select x-model="activeBlock[activeTab + '_settings'].font_size" class="w-full text-sm border-border rounded-lg bg-gray-50 focus:bg-white focus:ring-primary focus:border-primary transition-colors">
                                <option value="small">Small</option>
                                <option value="base">Base</option>
                                <option value="large">Large</option>
                                <option value="xl">XL</option>
                            </select>
                        </div>
                    </div>

                </div>
            </template>
        </div>
        
        <div class="p-4 border-t border-border bg-white flex-shrink-0 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.02)]">
            <button type="button" @click="saveBlock()" :disabled="saving" class="w-full flex justify-center items-center py-2.5 px-4 rounded-lg shadow-sm font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary disabled:opacity-50 transition-colors">
                <span x-show="!saving" class="flex items-center"><iconify-icon icon="lucide:save" class="mr-2 text-lg"></iconify-icon> Simpan Perubahan</span>
                <span x-show="saving" class="flex items-center">
                    <iconify-icon icon="lucide:loader-2" class="animate-spin mr-2 text-lg"></iconify-icon> Menyimpan...
                </span>
            </button>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pageBuilder', (initialBlocks, lpSlug) => ({
            blocks: initialBlocks || [],
            activeBlock: null,
            activeTab: 'desktop', // desktop | mobile
            viewportMode: 'desktop', // desktop | mobile
            saving: false,
            lpId: '{{ $landingPage->id }}',
            
            init() {
                this.$nextTick(() => {
                    const sortableContainer = this.$refs.sortableList;
                    if(sortableContainer) {
                        new Sortable(sortableContainer, {
                            handle: '.sortable-handle',
                            animation: 150,
                            ghostClass: 'bg-gray-100',
                            onEnd: (evt) => {
                                const newOrderIds = Array.from(sortableContainer.children)
                                    .filter(el => el.hasAttribute('data-id'))
                                    .map(el => el.getAttribute('data-id'));
                                
                                const reorderedBlocks = [];
                                const orderPayload = [];
                                
                                newOrderIds.forEach((id, index) => {
                                    const block = this.blocks.find(b => b.id === id);
                                    if(block) {
                                        block.order = index + 1;
                                        reorderedBlocks.push(block);
                                        orderPayload.push({ id: block.id, order: block.order });
                                    }
                                });
                                
                                this.blocks = reorderedBlocks;
                                this.reorderBlocks(orderPayload);
                            }
                        });
                    }
                });
            },

            async addBlock(type) {
                try {
                    const res = await fetch(`/admin/landing-pages/${this.lpId}/blocks`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ type: type })
                    });
                    const result = await res.json();
                    if(result.success) {
                        this.blocks.push(result.block);
                        this.editBlock(result.block);
                    }
                } catch(e) {
                    console.error('Failed to add block', e);
                    alert("Terjadi kesalahan saat menambah block.");
                }
            },

            editBlock(block) {
                // Parse dan stringify untuk deep cloning objek, sehingga edit state terpisah dari parent array sampai di save
                this.activeBlock = JSON.parse(JSON.stringify(block));
                this.activeTab = 'desktop';
            },

            async saveBlock() {
                if(!this.activeBlock) return;
                this.saving = true;
                try {
                    const res = await fetch(`/admin/landing-pages/${this.lpId}/blocks/${this.activeBlock.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            content: this.activeBlock.content,
                            desktop_settings: this.activeBlock.desktop_settings,
                            mobile_settings: this.activeBlock.mobile_settings
                        })
                    });
                    const result = await res.json();
                    if(result.success) {
                        const index = this.blocks.findIndex(b => b.id === this.activeBlock.id);
                        if(index !== -1) {
                            this.blocks[index] = result.block;
                        }
                        this.activeBlock = JSON.parse(JSON.stringify(result.block));
                        this.refreshPreview();
                    }
                } catch(e) {
                    console.error('Failed to save block', e);
                    alert("Gagal menyimpan block!");
                } finally {
                    this.saving = false;
                }
            },

            async deleteBlock(block) {
                if(!window.confirm(`Yakin ingin menghapus block ${block.type.replace('_', ' ')} ini?`)) return;
                try {
                    const res = await fetch(`/admin/landing-pages/${this.lpId}/blocks/${block.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    const result = await res.json();
                    if(result.success) {
                        this.blocks = this.blocks.filter(b => b.id !== block.id);
                        if(this.activeBlock && this.activeBlock.id === block.id) {
                            this.closePanel();
                        }
                        this.refreshPreview();
                    }
                } catch(e) {
                    console.error('Failed to delete block', e);
                    alert("Gagal menghapus block!");
                }
            },

            closePanel() {
                this.activeBlock = null;
            },

            async reorderBlocks(newOrderPayload) {
                try {
                    await fetch(`/admin/landing-pages/${this.lpId}/blocks/reorder`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ blocks: newOrderPayload })
                    });
                    this.refreshPreview();
                } catch(e) {
                    console.error('Failed to reorder blocks', e);
                    alert('Gagal mengurutkan block.');
                }
            },

            refreshPreview() {
                if(this.$refs.previewIframe) {
                    const iframe = this.$refs.previewIframe;
                    const src = iframe.src;
                    const cleanSrc = src.split('&_t=')[0].split('?_t=')[0];
                    const separator = cleanSrc.includes('?') ? '&' : '?';
                    iframe.src = cleanSrc + separator + '_t=' + new Date().getTime();
                }
            }
        }));
    });
</script>
@endpush
@endsection
