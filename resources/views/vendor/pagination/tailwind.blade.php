@if ($paginator->hasPages())
    <style>
        .mimbar-pagination-wrapper { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            gap: 20px; 
            width: 100%; 
            font-family: var(--font-body);
        }
        .mimbar-page-info { 
            color: var(--color-gray-600); 
            font-size: 14px; 
        }
        .mimbar-pagination { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 8px; 
            flex-wrap: wrap; 
        }
        .mimbar-page-link { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            min-width: 40px; 
            height: 40px; 
            padding: 0 12px; 
            border-radius: var(--radius-lg); 
            background: white; 
            border: 1px solid var(--color-border); 
            color: var(--color-gray-900); 
            font-size: 14px; 
            font-weight: 500; 
            text-decoration: none; 
            transition: all 0.2s; 
        }
        .mimbar-page-link:hover:not(.disabled) { 
            background: var(--color-muted); 
            color: var(--color-primary); 
            border-color: var(--color-border); 
        }
        .mimbar-page-link.active { 
            background: var(--color-primary); 
            color: white; 
            border-color: var(--color-primary); 
        }
        .mimbar-page-link.disabled { 
            opacity: 0.5; 
            cursor: not-allowed; 
            background: var(--color-muted); 
        }
    </style>

    <div class="mimbar-pagination-wrapper">
        <nav class="mimbar-pagination" role="navigation" aria-label="Navigasi Halaman">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="mimbar-page-link disabled" aria-disabled="true">« Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="mimbar-page-link" aria-label="Sebelumnya">« Prev</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="mimbar-page-link disabled" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="mimbar-page-link active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="mimbar-page-link" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="mimbar-page-link" aria-label="Selanjutnya">Next »</a>
            @else
                <span class="mimbar-page-link disabled" aria-disabled="true">Next »</span>
            @endif

        </nav>

        <div class="mimbar-page-info">
            Menampilkan <strong>{{ $paginator->firstItem() ?? 0 }}</strong> sampai <strong>{{ $paginator->lastItem() ?? 0 }}</strong> dari <strong>{{ $paginator->total() }}</strong> hasil
        </div>
    </div>
@endif
