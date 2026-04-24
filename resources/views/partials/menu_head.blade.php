@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<!-- Sticky Navigation Menu -->
<nav class="bg-primary-dark text-white sticky top-0 shadow-lg" style="z-index: 1050;">
    <div class="container mx-auto px-4">
        <!-- Desktop Menu -->
        <ul class="hidden md:flex space-x-6 py-3">
            <li class="relative group">
                <a href="{{ site_url() }}" class="flex items-center space-x-1 hover:text-green-200 transition-colors">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            {!! createDropdownMenu(menu_tema()) !!}
        </ul>

        <!-- Mobile App Bar -->
        <div class="md:hidden flex items-center justify-between py-2.5">
            <div class="flex items-center space-x-2">
                <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="font-semibold text-base leading-tight">{{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}</span>
            </div>
            <button onclick="openMobileSearch()" class="text-white hover:text-green-200 bg-transparent border-0 p-1">
                <i class="fas fa-search text-lg"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-80 h-full bg-white shadow-2xl md:hidden overflow-y-auto" style="z-index: 1070;">
    <div class="p-4 bg-primary text-white flex justify-between items-center">
        <h3 class="font-bold text-lg">Menu</h3>
        <button id="close-menu-btn" class="text-white hover:text-green-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    @php
    $menuIconMap = [
        'profil'       => 'fa-landmark',
        'sejarah'      => 'fa-scroll',
        'visi'         => 'fa-eye',
        'misi'         => 'fa-bullseye',
        'geografis'    => 'fa-map',
        'peta'         => 'fa-map-marked-alt',
        'statistik'    => 'fa-chart-bar',
        'penduduk'     => 'fa-users',
        'pemerintah'   => 'fa-user-tie',
        'aparatur'     => 'fa-id-badge',
        'lembaga'      => 'fa-sitemap',
        'bpd'          => 'fa-gavel',
        'layanan'      => 'fa-hands-helping',
        'surat'        => 'fa-envelope-open-text',
        'pengaduan'    => 'fa-comment-dots',
        'berita'       => 'fa-newspaper',
        'artikel'      => 'fa-newspaper',
        'agenda'       => 'fa-calendar-alt',
        'galeri'       => 'fa-images',
        'foto'         => 'fa-camera',
        'video'        => 'fa-video',
        'lapak'        => 'fa-store',
        'produk'       => 'fa-box',
        'pembangunan'  => 'fa-hard-hat',
        'infrastruktur'=> 'fa-road',
        'apbdes'       => 'fa-money-bill-wave',
        'keuangan'     => 'fa-coins',
        'anggaran'     => 'fa-file-invoice-dollar',
        'idm'          => 'fa-chart-line',
        'sdgs'         => 'fa-leaf',
        'stunting'     => 'fa-child',
        'kesehatan'    => 'fa-heartbeat',
        'dokumen'      => 'fa-file-alt',
        'hukum'        => 'fa-balance-scale',
        'peraturan'    => 'fa-book',
        'inventaris'   => 'fa-clipboard-list',
        'kontak'       => 'fa-phone-alt',
        'hubungi'      => 'fa-phone-alt',
        'wilayah'      => 'fa-map-pin',
        'potensi'      => 'fa-seedling',
        'wisata'       => 'fa-umbrella-beach',
        'umkm'         => 'fa-briefcase',
        'sinergi'      => 'fa-handshake',
        'pendidikan'   => 'fa-graduation-cap',
        'kartu'        => 'fa-id-card',
        'keluarga'     => 'fa-id-card',
        'pekerjaan'    => 'fa-briefcase',
        'agama'        => 'fa-place-of-worship',
        'kelamin'      => 'fa-venus-mars',
        'negara'       => 'fa-flag',
        'kewarganegaraan' => 'fa-flag',
    ];
    $getMenuIcon = function(string $nama) use ($menuIconMap): string {
        $lower = strtolower($nama);
        foreach ($menuIconMap as $keyword => $icon) {
            if (str_contains($lower, $keyword)) return $icon;
        }
        return 'fa-circle-dot';
    };
    @endphp
    <ul class="py-2">
        <li>
            <a href="{{ site_url() }}" class="flex items-center gap-3 px-6 py-3 text-gray-700 hover:bg-green-50 hover:text-primary border-b no-underline">
                <i class="fas fa-home w-4 text-center text-primary/60"></i>
                <span>Beranda</span>
            </a>
        </li>
        @foreach (menu_tema() as $idx => $data)
        @php $icon = $getMenuIcon($data['nama']); @endphp
        <li>
            @if (!empty($data['childrens']))
                <div class="flex items-center border-b">
                    <a href="{{ $data['link_url'] }}" class="flex-1 flex items-center gap-3 px-6 py-3 text-gray-700 hover:bg-green-50 hover:text-primary no-underline">
                        <i class="fas {{ $icon }} w-4 text-center text-primary/60"></i>
                        <span>{{ $data['nama'] }}</span>
                    </a>
                    <button type="button" class="px-4 py-3 text-gray-400 hover:text-primary bg-transparent border-0 border-l border-gray-200" onclick="toggleSubmenu('mobile-submenu-{{ $idx }}', this)">
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                </div>
                <ul id="mobile-submenu-{{ $idx }}" class="hidden bg-gray-50 border-b">
                    @foreach ($data['childrens'] as $child)
                    @php $childIcon = $getMenuIcon($child['nama']); @endphp
                    <li>
                        <a href="{{ $child['link_url'] }}" class="flex items-center gap-3 pl-10 pr-6 py-2.5 text-sm text-gray-600 hover:bg-green-50 hover:text-primary border-b border-gray-100 no-underline">
                            <i class="fas {{ $childIcon }} w-3 text-center text-gray-400 text-xs"></i>
                            <span>{{ $child['nama'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @else
                <a href="{{ $data['link_url'] }}" class="flex items-center gap-3 px-6 py-3 text-gray-700 hover:bg-green-50 hover:text-primary border-b no-underline">
                    <i class="fas {{ $icon }} w-4 text-center text-primary/60"></i>
                    <span>{{ $data['nama'] }}</span>
                </a>
            @endif
        </li>
        @endforeach
    </ul>

    <!-- Mobile Search -->
    <div class="px-6 py-4 border-t">
        <form method="get" action="{{ site_url() }}" class="flex">
            <input type="text" name="cari" placeholder="Cari artikel..." class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-lg hover:bg-primary-dark transition-colors">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Backdrop -->
<div id="mobile-menu-backdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden" style="z-index: 1060;"></div>

<!-- Mobile Search Overlay -->
<div id="mobile-search-overlay" class="fixed inset-0 bg-black/60 hidden md:hidden" style="z-index: 1080;" onclick="closeMobileSearch()"></div>
<div id="mobile-search-panel" class="fixed top-0 inset-x-0 bg-primary-dark p-3 hidden md:hidden" style="z-index: 1090;">
    <form method="get" action="{{ site_url() }}" class="flex items-center gap-2">
        <button type="button" onclick="closeMobileSearch()" class="text-white bg-transparent border-0 p-1 flex-shrink-0">
            <i class="fas fa-arrow-left text-lg"></i>
        </button>
        <input id="mobile-search-input" type="text" name="cari" placeholder="Cari artikel..." autocomplete="off"
            class="flex-1 rounded-lg px-4 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
        <button type="submit" class="text-white bg-transparent border-0 p-1 flex-shrink-0">
            <i class="fas fa-search text-lg"></i>
        </button>
    </form>
</div>
<script>
    function openMobileSearch() {
        document.getElementById('mobile-search-overlay').classList.remove('hidden');
        document.getElementById('mobile-search-panel').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('mobile-search-input').focus(), 50);
    }
    function closeMobileSearch() {
        document.getElementById('mobile-search-overlay').classList.add('hidden');
        document.getElementById('mobile-search-panel').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>

<style>
    /* Desktop dropdown - since createDropdownMenu may generate Bootstrap markup, override with Tailwind-compatible styles */
    nav .dropdown { position: relative; }
    nav .dropdown > a { display: flex; align-items: center; gap: 0.25rem; color: #fff; text-decoration: none; transition: color 0.2s; }
    nav .dropdown > a:hover { color: #bbf7d0; }
    nav .dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background: #fff; box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); border-radius: 0.375rem; padding: 0.5rem 0; min-width: 12rem; z-index: 50; }
    nav .dropdown:hover > .dropdown-menu { display: block; }
    nav .dropdown-menu > li > a, nav .dropdown-menu .dropdown > a { display: block; padding: 0.5rem 1rem; color: #374151; text-decoration: none; font-size: 0.875rem; }
    nav .dropdown-menu > li > a:hover, nav .dropdown-menu .dropdown > a:hover { background: #f0fdf4; color: var(--tw-text-primary, #22c55e); }
    nav .dropdown-menu .dropdown > .dropdown-menu { left: 100%; top: 0; }
    nav .navbar-nav { display: flex; list-style: none; gap: 1.5rem; margin: 0; padding: 0; }
    nav .navbar-nav > li { position: relative; }
    nav .navbar-nav > li > a { color: #fff; text-decoration: none; transition: color 0.2s; }
    nav .navbar-nav > li > a:hover { color: #bbf7d0; }
    nav .caret { display: inline-block; width: 0; height: 0; margin-left: 4px; vertical-align: middle; border-top: 4px solid; border-right: 4px solid transparent; border-left: 4px solid transparent; }
</style>
