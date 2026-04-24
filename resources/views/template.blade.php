<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    @include('theme::commons.meta')
</head>
<body class="bg-gray-50">
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 flex flex-col items-center justify-center" style="z-index:9999;background:linear-gradient(160deg,#ffffff 0%,#f0fdf4 60%,#ffffff 100%);">

        {{-- Logo + Arc Spinner --}}
        <div class="relative w-24 h-24 flex items-center justify-center mb-6">
            {{-- Track ring --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 96 96" fill="none">
                <circle cx="48" cy="48" r="44" stroke="#e5e7eb" stroke-width="3"/>
            </svg>
            {{-- Spinning arc --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 96 96" fill="none" style="animation:loader-spin .85s linear infinite;">
                <circle cx="48" cy="48" r="44" stroke="var(--color-primary)" stroke-width="3.5" stroke-linecap="round" stroke-dasharray="277" stroke-dashoffset="208"/>
            </svg>
            {{-- Logo --}}
            <img src="{{ gambar_desa($desa['logo']) }}" alt="{{ $desa['nama_desa'] }}"
                 class="w-14 h-14 object-contain relative z-10 drop-shadow-sm">
        </div>

        {{-- Nama desa --}}
        <p class="text-sm font-bold text-gray-700 tracking-wider uppercase mb-3">
            {{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}
        </p>

        {{-- Teks + dots animasi --}}
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-400 font-medium tracking-wide">Sedang Memuat</span>
            <span class="flex gap-1 items-center">
                <span class="w-1 h-1 rounded-full bg-primary" style="animation:loader-dot .9s ease-in-out infinite 0s;"></span>
                <span class="w-1 h-1 rounded-full bg-primary" style="animation:loader-dot .9s ease-in-out infinite .2s;"></span>
                <span class="w-1 h-1 rounded-full bg-primary" style="animation:loader-dot .9s ease-in-out infinite .4s;"></span>
            </span>
        </div>
    </div>
    <style>
        /* Reservasi ruang scrollbar agar layout tidak bergeser saat scrollbar muncul/hilang */
        html { overflow-y: scroll; }
        @keyframes loader-spin { to { transform: rotate(360deg); } }
        @keyframes loader-dot  { 0%,60%,100%{opacity:.2;transform:scale(.8)} 30%{opacity:1;transform:scale(1)} }
        #page-loader.hide { opacity:0; visibility:hidden; pointer-events:none; }
    </style>

    <!-- Scroll to Top -->
    <a id="scrollToTop" class="fixed bottom-6 right-6 z-50 hidden w-12 h-12 rounded-full shadow-lg text-white flex items-center justify-center cursor-pointer transition-all hover:opacity-80" href="#">
        <i class="fas fa-angle-up text-xl"></i>
    </a>

    @include('theme::partials.header')
    @include('theme::partials.menu_head')

    <div>
        @yield('layout')
    </div>

    @include('theme::partials.footer_top')
    <!-- Footer Bottom (Desktop only) -->
    <div class="hidden md:block">
        @include('theme::partials.footer_bottom')
    </div>

    <!-- Fixed Bottom Navigation (Mobile) -->
    @php
        $rawUri   = ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
        $basePath = ltrim(rtrim(parse_url(site_url(), PHP_URL_PATH) ?? '/', '/'), '/');
        if ($basePath && strpos($rawUri, $basePath) === 0) {
            $rawUri = ltrim(substr($rawUri, strlen($basePath)), '/');
        }
        $seg1 = strtolower(explode('/', $rawUri)[0] ?? '');
        $navActive = [
            'beranda' => $seg1 === '' || $seg1 === 'index.php',
            'berita'  => in_array($seg1, ['arsip', 'artikel']),
            'lapak'   => $seg1 === 'lapak',
            'galeri'  => $seg1 === 'galeri',
            'menu'    => !in_array($seg1, ['', 'index.php', 'arsip', 'artikel', 'lapak', 'galeri']),
        ];
        $navCls = function($key) use ($navActive) {
            return $navActive[$key]
                ? 'text-primary'
                : 'text-gray-400 hover:text-primary';
        };
    @endphp
    <nav class="fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 md:hidden pb-safe" style="z-index: 1050;">
        <div class="flex justify-around items-end h-14">
            <a href="{{ site_url() }}" class="flex flex-col items-center justify-center {{ $navCls('beranda') }} transition-colors no-underline flex-1 py-1 relative">
                @if($navActive['beranda'])<span class="absolute top-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-primary rounded-full"></span>@endif
                <i class="fas fa-home text-lg"></i>
                <span class="text-[10px] mt-0.5 {{ $navActive['beranda'] ? 'font-semibold' : '' }}">Beranda</span>
            </a>
            <a href="{{ site_url('arsip') }}" class="flex flex-col items-center justify-center {{ $navCls('berita') }} transition-colors no-underline flex-1 py-1 relative">
                @if($navActive['berita'])<span class="absolute top-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-primary rounded-full"></span>@endif
                <i class="fas fa-newspaper text-lg"></i>
                <span class="text-[10px] mt-0.5 {{ $navActive['berita'] ? 'font-semibold' : '' }}">Berita</span>
            </a>
            <!-- Lapak — center, menonjol -->
            <a href="{{ site_url('lapak') }}" class="flex flex-col items-center justify-center no-underline flex-1 -mt-5 relative">
                <span class="w-14 h-14 rounded-full {{ $navActive['lapak'] ? 'bg-primary-dark' : 'bg-primary' }} text-white flex flex-col items-center justify-center shadow-lg border-4 border-white transition-colors">
                    <i class="fas fa-store text-xl"></i>
                </span>
                <span class="text-[10px] mt-1 text-primary {{ $navActive['lapak'] ? 'font-bold' : 'font-semibold' }}">Lapak</span>
            </a>
            <a href="{{ site_url('galeri') }}" class="flex flex-col items-center justify-center {{ $navCls('galeri') }} transition-colors no-underline flex-1 py-1 relative">
                @if($navActive['galeri'])<span class="absolute top-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-primary rounded-full"></span>@endif
                <i class="fas fa-images text-lg"></i>
                <span class="text-[10px] mt-0.5 {{ $navActive['galeri'] ? 'font-semibold' : '' }}">Galeri</span>
            </a>
            <button onclick="document.getElementById('mobile-menu').classList.add('active'); document.getElementById('mobile-menu-backdrop').classList.remove('hidden'); document.body.style.overflow='hidden';" class="flex flex-col items-center justify-center {{ $navCls('menu') }} transition-colors flex-1 py-1 bg-transparent border-0 relative">
                @if($navActive['menu'])<span class="absolute top-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-primary rounded-full"></span>@endif
                <i class="fas fa-bars text-lg"></i>
                <span class="text-[10px] mt-0.5 {{ $navActive['menu'] ? 'font-semibold' : '' }}">Menu</span>
            </button>
        </div>
    </nav>
    <style>
        @media (max-width: 767px) {
            body { padding-bottom: 3.5rem; }
            #scrollToTop { bottom: 4.5rem; }
            .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0); }
        }
    </style>

    @include('theme::commons.meta_footer')

    <script type="text/javascript">
        function formatRupiah(angka, prefix = 'Rp') {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    @stack('scripts')
    <script>
        (function () {
            var loader = document.getElementById('page-loader');

            // Fade-out smooth saat halaman siap
            function hideLoader() {
                loader.style.transition = 'opacity .4s ease, visibility .4s ease';
                loader.classList.add('hide');
            }

            // Muncul INSTAN saat navigasi (tanpa transisi agar tidak tembus)
            function showLoaderInstant() {
                loader.style.transition = 'none';
                loader.classList.remove('hide');
                // Paksa reflow agar perubahan langsung diterapkan browser
                void loader.offsetWidth;
                // Kembalikan transisi untuk animasi hide berikutnya
                loader.style.transition = '';
            }

            if (document.readyState === 'complete') {
                hideLoader();
            } else {
                window.addEventListener('load', hideLoader);
                setTimeout(hideLoader, 8000);
            }

            document.addEventListener('click', function (e) {
                var a = e.target.closest('a');
                if (!a || e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
                var href = a.getAttribute('href');
                if (!href || href === '#' || href.startsWith('javascript') || href.startsWith('mailto') || href.startsWith('tel')) return;
                if (a.target === '_blank' || a.hasAttribute('download')) return;
                try {
                    var url = new URL(href, location.href);
                    if (url.origin === location.origin && url.pathname !== location.pathname) {
                        showLoaderInstant();
                    }
                } catch (err) {}
            });
        })();
    </script>
</body>
</html>
