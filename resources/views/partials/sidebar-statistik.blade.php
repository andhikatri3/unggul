@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@php
    // Ambil children statistik dari menu yang dikonfigurasi admin (sama dengan header dropdown)
    $statistikChildren = [];
    foreach (menu_tema() as $menu) {
        if (!empty($menu['childrens'])) {
            foreach ($menu['childrens'] as $child) {
                if (str_starts_with($child['link'] ?? '', 'statistik/')) {
                    $statistikChildren = array_values(array_filter(
                        $menu['childrens'],
                        fn($c) => ($c['link'] ?? '') !== 'data-wilayah'
                    ));
                    break 2;
                }
            }
        }
    }

    $isStatistikPage = request()->is('data-statistik*');
    $currentUrl      = rtrim(request()->url(), '/');

    $menuData = [
        [
            'label'    => 'Statistik Penduduk',
            'url'      => site_url('data-statistik'),
            'icon'     => 'fa-chart-bar',
            'aktif'    => $isStatistikPage,
            'children' => $statistikChildren,
        ],
        [
            'label'    => 'Wilayah Administratif',
            'url'      => site_url('data-wilayah'),
            'icon'     => 'fa-map-marker-alt',
            'aktif'    => request()->is('data-wilayah'),
            'children' => [],
        ],
        [
            'label'    => 'Daftar Pemilih (DPT)',
            'url'      => site_url('data-dpt'),
            'icon'     => 'fa-vote-yea',
            'aktif'    => request()->is('data-dpt'),
            'children' => [],
        ],
        [
            'label'    => 'Data Kesehatan',
            'url'      => site_url('data-kesehatan'),
            'icon'     => 'fa-heartbeat',
            'aktif'    => request()->is('data-kesehatan*'),
            'children' => [],
        ],
        [
            'label'    => 'Data Kelompok',
            'url'      => site_url('data-kelompok'),
            'icon'     => 'fa-users',
            'aktif'    => request()->is('data-kelompok*'),
            'children' => [],
        ],
        [
            'label'    => 'Data Lembaga',
            'url'      => site_url('data-lembaga'),
            'icon'     => 'fa-building',
            'aktif'    => request()->is('data-lembaga*'),
            'children' => [],
        ],
        [
            'label'    => 'Data Suplemen',
            'url'      => site_url('data-suplemen'),
            'icon'     => 'fa-database',
            'aktif'    => request()->is('data-suplemen*'),
            'children' => [],
        ],
    ];
@endphp

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2">
        <span class="w-1 h-5 bg-primary rounded-full flex-shrink-0"></span>
        <h3 class="text-sm font-bold text-gray-800 flex-1 uppercase tracking-wide">Data Informasi</h3>
        <i class="fas fa-layer-group text-primary/40 text-xs"></i>
    </div>

    <nav class="p-2">
        @foreach ($menuData as $idx => $item)
            @if (!empty($item['children']))
                {{-- Menu dengan dropdown --}}
                <div class="mb-1">
                    <button type="button"
                        onclick="toggleSubmenu('sidebar-statistik-sub-{{ $idx }}', this)"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all text-left bg-transparent border-0 cursor-pointer
                               {{ $item['aktif'] ? 'bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                        <i class="fas {{ $item['icon'] }} w-4 text-center flex-shrink-0
                                   {{ $item['aktif'] ? 'text-primary' : 'text-primary/60' }}"></i>
                        <span class="flex-1 text-left">{{ $item['label'] }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200
                                  {{ $item['aktif'] ? 'rotate-180' : '' }}"></i>
                    </button>

                    <ul id="sidebar-statistik-sub-{{ $idx }}"
                        class="{{ $item['aktif'] ? '' : 'hidden' }} pl-2 list-none m-0">
                        @foreach ($item['children'] as $child)
                            @php $childAktif = rtrim($child['link_url'], '/') === $currentUrl; @endphp
                            <li>
                                <a href="{{ $child['link_url'] }}"
                                   class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all no-underline
                                          {{ $childAktif
                                              ? 'bg-primary text-white shadow-sm'
                                              : 'text-gray-500 hover:bg-gray-50 hover:text-primary' }}">
                                    <span class="w-1.5 h-1.5 rounded-full flex-shrink-0
                                                 {{ $childAktif ? 'bg-white' : 'bg-gray-300' }}"></span>
                                    {{ $child['nama'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                {{-- Menu biasa --}}
                <a href="{{ $item['url'] }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg mb-1 text-sm font-medium transition-all no-underline
                          {{ $item['aktif']
                              ? 'bg-primary text-white shadow-sm'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <i class="fas {{ $item['icon'] }} w-4 text-center flex-shrink-0
                               {{ $item['aktif'] ? 'text-white/90' : 'text-primary/60' }}"></i>
                    <span>{{ $item['label'] }}</span>
                    @if ($item['aktif'])
                        <i class="fas fa-chevron-right ml-auto text-xs text-white/70"></i>
                    @endif
                </a>
            @endif
        @endforeach
    </nav>
</div>
