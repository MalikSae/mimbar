@extends('layouts.admin')

@section('title', 'Galeri Program')

@section('content')
<div>

    {{-- Page Header --}}
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-family: var(--font-heading); font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px; display: inline-flex; align-items: center; gap: 8px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Galeri Program
            </h1>
            <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
                Upload dan kelola foto dokumentasi program
            </p>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div id="gallery-tabs" style="display: flex; gap: 8px; margin-bottom: 24px; flex-wrap: wrap;">
        @foreach($programTypes as $tabType)
            <a href="{{ route('admin.program-gallery.index', ['type' => $tabType]) }}"
               data-type="{{ $tabType }}"
               class="gallery-tab"
               style="padding: 8px 18px; border-radius: var(--radius-full); font-size: 13px; font-weight: 600;
                      text-decoration: none; transition: all 0.2s; cursor: pointer;
                      {{ $currentType === $tabType
                          ? 'background: var(--color-primary); color: white;'
                          : 'background: var(--color-white); color: var(--color-gray-600); border: 1px solid var(--color-border);' }}">
                {{ $tabType === 'slider_home' ? 'Slider Home' : ucfirst($tabType) }}
            </a>
        @endforeach
    </div>

    {{-- Upload Form --}}
    <div style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                padding: 24px; margin-bottom: 24px; box-shadow: var(--shadow-card);">
        <h3 style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 16px;">
            Upload Foto Baru
        </h3>

        @if(session('success'))
            <div style="background: var(--color-success-surface); color: var(--color-success); padding: 12px 16px;
                        border-radius: var(--radius-lg); font-size: 13px; font-weight: 500; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: var(--color-danger-surface); color: var(--color-danger); padding: 12px 16px;
                        border-radius: var(--radius-lg); font-size: 13px; margin-bottom: 16px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.program-gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 180px 1fr auto; gap: 12px; align-items: end;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">
                        Tipe Program
                    </label>
                    <select id="upload-type-select" name="program_type"
                            style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border);
                                   border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body);
                                   background: var(--color-white); color: var(--color-gray-900);">
                        @foreach($programTypes as $tabType)
                            <option value="{{ $tabType }}" {{ $currentType === $tabType ? 'selected' : '' }}>
                                {{ $tabType === 'slider_home' ? 'Slider Home' : ucfirst($tabType) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">
                        Foto (bisa pilih banyak)
                    </label>
                    <input type="file" name="photos[]" multiple accept="image/*" required
                           style="width: 100%; padding: 8px 12px; border: 1px solid var(--color-border);
                                  border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body);
                                  background: var(--color-white);">
                </div>

                <button type="submit"
                        style="padding: 10px 20px; background: var(--color-primary); color: white;
                               border: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600;
                               font-family: var(--font-heading); cursor: pointer; transition: background 0.2s;
                               white-space: nowrap;"
                        onmouseover="this.style.background='var(--color-primary-dark)'"
                        onmouseout="this.style.background='var(--color-primary)'">
                    Upload
                </button>
            </div>
        </form>
    </div>

    {{-- Gallery Grid — zona AJAX --}}
    <div id="gallery-section" style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                padding: 24px; box-shadow: var(--shadow-card); transition: opacity 0.15s;">
        @include('admin.program-gallery._grid', ['galleries' => $galleries, 'currentType' => $currentType])
    </div>
</div>

<script>
(function () {
    const BASE_URL = '{{ route('admin.program-gallery.index') }}';
    let activeType  = '{{ $currentType }}';
    let isFetching  = false;

    const section   = document.getElementById('gallery-section');
    const tabsWrap  = document.getElementById('gallery-tabs');
    const typeSelect = document.getElementById('upload-type-select');

    function setTabActive(type) {
        tabsWrap.querySelectorAll('.gallery-tab').forEach(tab => {
            const on = tab.dataset.type === type;
            tab.style.background = on ? 'var(--color-primary)' : 'var(--color-white)';
            tab.style.color      = on ? 'white' : 'var(--color-gray-600)';
            tab.style.border     = on ? 'none' : '1px solid var(--color-border)';
        });
        if (typeSelect) typeSelect.value = type;
    }

    async function loadGallery(type, push) {
        if (isFetching) return;
        isFetching = true;
        activeType = type;

        setTabActive(type);
        section.style.opacity = '0.4';
        section.style.pointerEvents = 'none';

        const url = BASE_URL + '?type=' + encodeURIComponent(type);

        try {
            const res  = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await res.text();

            const doc        = new DOMParser().parseFromString(html, 'text/html');
            const newSection = doc.getElementById('gallery-section');
            if (newSection) {
                section.innerHTML = newSection.innerHTML;
                // Re-init Alpine untuk elemen baru
                if (window.Alpine) {
                    section.querySelectorAll('[x-data]').forEach(el => Alpine.initTree(el));
                }
            }

            if (push) window.history.pushState({ type }, '', url);
        } catch (_) {
            window.location.href = BASE_URL + '?type=' + encodeURIComponent(type);
        } finally {
            section.style.opacity = '1';
            section.style.pointerEvents = '';
            isFetching = false;
        }
    }

    // Intercept klik tab
    tabsWrap.addEventListener('click', function (e) {
        const tab = e.target.closest('.gallery-tab');
        if (!tab) return;
        e.preventDefault();
        if (tab.dataset.type !== activeType) loadGallery(tab.dataset.type, true);
    });

    // Handle browser back/forward
    window.addEventListener('popstate', function (e) {
        const type = (e.state && e.state.type) || 'dakwah';
        if (type !== activeType) loadGallery(type, false);
    });
})();
</script>
@endsection
