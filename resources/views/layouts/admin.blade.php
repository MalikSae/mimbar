<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Mimbar Al-Tauhid</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Fix Alpine.js x-show overriding display:flex on sidebar */
        #admin-sidebar[style*="display: none"] { display: none !important; }
        #admin-sidebar { display: flex !important; flex-direction: column !important; }
        /* Sidebar nav scroll */
        .sidebar-nav {
            flex: 1 !important;
            overflow-y: auto !important;
            min-height: 0 !important;
        }
        .sidebar-nav::-webkit-scrollbar { width: 5px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
        .sidebar-nav::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.4); }
    </style>
    @stack('head')
</head>
<body style="font-family: var(--font-body); background-color: var(--color-muted); margin: 0; overflow: hidden;"
      x-data="{ sidebarOpen: true }">

    <div style="display: flex; height: 100vh;">

        {{-- SIDEBAR --}}
        <aside id="admin-sidebar" style="width: 248px; background: var(--color-primary); height: 100vh;
                      flex-shrink: 0; overflow: hidden; transition: width 0.2s ease;"
               x-show="sidebarOpen"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 -translate-x-full"
               x-transition:enter-end="opacity-100 translate-x-0">

            {{-- Logo --}}
            <div style="padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: center;">
                <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-DARK-MODE.png') }}" 
                     alt="Logo Mimbar Al-Tauhid" 
                     style="height: 48px; width: auto; max-width: 100%; object-fit: contain;">

            </div>

            {{-- Nav --}}
            <nav class="sidebar-nav" style="padding: 12px 0; flex: 1; overflow-y: auto; min-height: 0;">
                @php
                    $navGroups = [
                        [
                            'group' => null,
                            'items' => [
                                [
                                    'route' => 'admin.dashboard',
                                    'label' => 'Dashboard',
                                    'active_pattern' => 'admin.dashboard',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Konten',
                            'items' => [
                                [
                                    'route' => 'admin.articles.index',
                                    'label' => 'Artikel',
                                    'active_pattern' => 'admin.articles.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
                                ],
                                [
                                    'route' => 'admin.news.index',
                                    'label' => 'Berita',
                                    'active_pattern' => 'admin.news.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 0-2 2zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6z"/></svg>',
                                ],
                                [
                                    'route' => 'admin.kategori.index',
                                    'label' => 'Kategori',
                                    'active_pattern' => 'admin.kategori.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Donasi',
                            'items' => [
                                [
                                    'route' => 'admin.programs.index',
                                    'label' => 'Program Donasi',
                                    'active_pattern' => 'admin.programs.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                                ],
                                [
                                    'route' => 'admin.donations.index',
                                    'label' => 'Data Donasi',
                                    'active_pattern' => 'admin.donations.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
                                ],
                                [
                                    'route' => 'admin.program-kategori.index',
                                    'label' => 'Kategori Program',
                                    'active_pattern' => 'admin.program-kategori.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Qurban',
                            'items' => [
                                [
                                    'route' => 'admin.qurban.items.index',
                                    'label' => 'Katalog Hewan',
                                    'active_pattern' => 'admin.qurban.items.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
                                ],
                                [
                                    'route' => 'admin.qurban.orders.index',
                                    'label' => 'Pesanan Qurban',
                                    'active_pattern' => 'admin.qurban.orders.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="13" y2="16"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Pustaka Digital',
                            'items' => [
                                [
                                    'route' => 'admin.ebooks.index',
                                    'label' => 'Katalog E-Book',
                                    'active_pattern' => 'admin.ebooks.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
                                ],
                                [
                                    'route' => 'admin.ebook-logs.index',
                                    'label' => 'Log & Unduhan',
                                    'active_pattern' => 'admin.ebook-logs.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="2 2 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Lainnya',
                            'items' => [
                                [
                                    'route' => 'admin.reports.index',
                                    'label' => 'Laporan',
                                    'active_pattern' => 'admin.reports.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
                                ],
                            ],
                        ],
                        [
                            'group' => 'Pengaturan',
                            'items' => [
                                [
                                    'route' => 'admin.bank-accounts.index',
                                    'label' => 'Data Rekening',
                                    'active_pattern' => 'admin.bank-accounts.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>',
                                ],
                                [
                                    'route' => 'admin.integrations.index',
                                    'label' => 'Integrasi',
                                    'active_pattern' => 'admin.integrations.*',
                                    'icon'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>',
                                ],
                            ],
                        ],
                    ];
                @endphp

                @foreach ($navGroups as $group)
                    {{-- Group Label --}}
                    @if ($group['group'])
                    <div style="padding: 14px 18px 4px; font-size: 10px; font-weight: 700;
                                text-transform: uppercase; letter-spacing: 0.1em;
                                color: rgba(255,255,255,0.3);">
                        {{ $group['group'] }}
                    </div>
                    @endif
                    {{-- Items --}}
                    @foreach ($group['items'] as $item)
                    @php 
                        $isActive = request()->routeIs($item['active_pattern']);
                        if (isset($item['params']) && $isActive) {
                            foreach ($item['params'] as $key => $value) {
                                if (request($key) !== $value) {
                                    $isActive = false;
                                }
                            }
                        }
                    @endphp
                    <a href="{{ route($item['route'], $item['params'] ?? []) }}"
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
                        {!! $item['icon'] !!}
                        <span>{{ $item['label'] }}</span>
                    </a>
                    @endforeach
                @endforeach
            </nav>


        </aside>

        {{-- MAIN CONTENT --}}
        <div style="flex: 1; display: flex; flex-direction: column; min-width: 0; height: 100vh;">
            {{-- Top bar --}}
            <header style="background: white; padding: 0 24px; height: 56px;
                           display: flex; align-items: center; justify-content: space-between;
                           border-bottom: 1px solid var(--color-border); flex-shrink: 0;">
                <button @click="sidebarOpen = !sidebarOpen"
                        style="background: none; border: none; cursor: pointer;
                               padding: 6px; border-radius: 6px;
                               color: var(--color-gray-600); display: flex; align-items: center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="font-size: 13px; color: var(--color-gray-600);">
                        {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                    </div>
                    {{-- Notif Bell --}}
                    <button style="background: none; border: none; cursor: pointer; padding: 6px; border-radius: 6px; color: var(--color-gray-600); display: flex; align-items: center; position: relative;" title="Notifikasi">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </button>
                    {{-- Avatar + Dropdown --}}
                    <div style="position: relative;" x-data="{ open: false }">
                        <button @click="open = !open" style="display: flex; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 4px; border-radius: 8px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: white; flex-shrink: 0;">
                                {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div style="text-align: left; line-height: 1.2;">
                                <div style="font-size: 12.5px; font-weight: 600; color: var(--color-gray-800); white-space: nowrap;">{{ auth('admin')->user()->name ?? '' }}</div>
                                <div style="font-size: 11px; color: var(--color-gray-500);">Administrator</div>
                            </div>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-gray-500);">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        {{-- Dropdown --}}
                        <div x-show="open" @click.outside="open = false"
                             style="position: absolute; right: 0; top: calc(100% + 8px); background: white; border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); border: 1px solid var(--color-border); min-width: 160px; z-index: 999; overflow: hidden;">
                            <div style="padding: 10px 14px; border-bottom: 1px solid var(--color-border);">
                                <div style="font-size: 12px; font-weight: 600; color: var(--color-gray-800);">{{ auth('admin')->user()->name ?? '' }}</div>
                                <div style="font-size: 11px; color: var(--color-gray-500);">{{ auth('admin')->user()->email ?? '' }}</div>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 10px 14px; background: none; border: none; cursor: pointer; font-size: 13px; color: #ef4444; font-family: var(--font-body);">
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
