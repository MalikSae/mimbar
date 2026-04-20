<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Penulis') — Mimbar Al-Tauhid</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #author-sidebar { display: flex !important; flex-direction: column !important; }
        .author-sidebar-nav {
            flex: 1 !important;
            overflow-y: auto !important;
            min-height: 0 !important;
        }
    </style>
    @stack('head')
</head>
<body style="font-family: var(--font-body); background-color: var(--color-muted); margin: 0; overflow: hidden;"
      x-data="{}">

    <div style="display: flex; height: 100vh;">

        {{-- SIDEBAR --}}
        <aside id="author-sidebar" style="width: 240px; background: var(--color-primary); height: 100vh;
                      flex-shrink: 0; overflow: hidden;">

            {{-- Logo --}}
            <div style="padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: center;">
                <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-DARK-MODE.png') }}"
                     alt="Logo Mimbar Al-Tauhid"
                     style="height: 44px; width: auto; max-width: 100%; object-fit: contain;">
                <div style="font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 8px; letter-spacing: 0.05em; text-transform: uppercase;">
                    Portal Penulis
                </div>
            </div>

            {{-- Nav --}}
            <nav class="author-sidebar-nav" style="padding: 16px 0;">
                @php
                    $isActive = request()->routeIs('author.dashboard') || request()->routeIs('author.artikel.*');
                @endphp
                <a href="{{ route('author.dashboard') }}"
                   style="display: flex; align-items: center; gap: 11px;
                          padding: 10px 18px; margin: 2px 10px;
                          border-radius: 8px;
                          color: {{ $isActive ? 'white' : 'rgba(255,255,255,0.65)' }};
                          background: {{ $isActive ? 'rgba(255,255,255,0.18)' : 'transparent' }};
                          text-decoration: none; font-size: 13.5px;
                          font-weight: {{ $isActive ? '600' : '400' }};
                          transition: background 0.15s, color 0.15s;"
                   onmouseover="if(!{{ $isActive ? 'true' : 'false' }}) { this.style.background='rgba(255,255,255,0.08)'; this.style.color='white'; }"
                   onmouseout="if(!{{ $isActive ? 'true' : 'false' }}) { this.style.background='transparent'; this.style.color='rgba(255,255,255,0.65)'; }">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                    <span>Artikel Saya</span>
                </a>
            </nav>

            {{-- Footer sidebar --}}
            <div style="padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                <div style="font-size: 11px; color: rgba(255,255,255,0.4); text-align: center;">
                    © {{ date('Y') }} Mimbar Al-Tauhid
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div style="flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh;">
            {{-- Top bar --}}
            <header style="background: white; padding: 0 24px; height: 56px;
                           display: flex; align-items: center; justify-content: space-between;
                           border-bottom: 1px solid var(--color-border); flex-shrink: 0;">
                <div style="font-size: 13px; color: var(--color-gray-600);">
                    {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    {{-- User info + Logout --}}
                    <div style="position: relative;" x-data="{ open: false }">
                        <button @click="open = !open"
                                style="display: flex; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 4px; border-radius: 8px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-primary);
                                        display: flex; align-items: center; justify-content: center;
                                        font-size: 13px; font-weight: 700; color: white; flex-shrink: 0;">
                                {{ strtoupper(substr(auth('author')->user()->name ?? 'P', 0, 1)) }}
                            </div>
                            <div style="text-align: left; line-height: 1.2;">
                                <div style="font-size: 12.5px; font-weight: 600; color: var(--color-gray-900); white-space: nowrap;">
                                    {{ auth('author')->user()->name ?? '' }}
                                </div>
                                <div style="font-size: 11px; color: var(--color-gray-500);">Penulis</div>
                            </div>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-gray-500);">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                             style="position: absolute; right: 0; top: calc(100% + 8px); background: white;
                                    border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                                    border: 1px solid var(--color-border); min-width: 160px; z-index: 999; overflow: hidden;">
                            <div style="padding: 10px 14px; border-bottom: 1px solid var(--color-border);">
                                <div style="font-size: 12px; font-weight: 600; color: var(--color-gray-900);">
                                    {{ auth('author')->user()->name ?? '' }}
                                </div>
                                <div style="font-size: 11px; color: var(--color-gray-500);">
                                    {{ auth('author')->user()->email ?? '' }}
                                </div>
                            </div>
                            <form method="POST" action="{{ route('author.logout') }}">
                                @csrf
                                <button type="submit"
                                        style="display: flex; align-items: center; gap: 8px; width: 100%;
                                               padding: 10px 14px; background: none; border: none;
                                               cursor: pointer; font-size: 13px; color: #ef4444;
                                               font-family: var(--font-body);">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16 17 21 12 16 7"/>
                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            {{-- Page content --}}
            <main style="flex: 1; padding: 28px; overflow-y: auto;">
                @yield('content')
            </main>
        </div>

    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
