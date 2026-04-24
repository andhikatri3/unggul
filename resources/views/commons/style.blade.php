@php $warna_dasar = theme_config('warna_dasar', '#22c55e'); @endphp
@php
    // Calculate darker shade
    $hex = ltrim($warna_dasar, '#');
    $r = max(0, hexdec(substr($hex, 0, 2)) - 30);
    $g = max(0, hexdec(substr($hex, 2, 2)) - 30);
    $b = max(0, hexdec(substr($hex, 4, 2)) - 30);
    $warna_gelap = sprintf('#%02x%02x%02x', $r, $g, $b);
    // Much darker shade (for gradient end)
    $rd = max(0, hexdec(substr($hex, 0, 2)) - 80);
    $gd = max(0, hexdec(substr($hex, 2, 2)) - 80);
    $bd = max(0, hexdec(substr($hex, 4, 2)) - 80);
    $warna_sangat_gelap = sprintf('#%02x%02x%02x', $rd, $gd, $bd);
    // Light shade
    $rl = min(255, hexdec(substr($hex, 0, 2)) + 200);
    $gl = min(255, hexdec(substr($hex, 2, 2)) + 200);
    $bl = min(255, hexdec(substr($hex, 4, 2)) + 200);
    $warna_terang = sprintf('#%02x%02x%02x', $rl, $gl, $bl);
@endphp

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '{{ $warna_dasar }}',
                    'primary-dark': '{{ $warna_gelap }}',
                    'primary-light': '{{ $warna_terang }}',
                }
            }
        }
    }
</script>

<style type="text/css">
    /* CSS Custom Properties */
    :root {
        --color-primary: {{ $warna_dasar }};
        --color-primary-dark: {{ $warna_gelap }};
        --color-primary-darker: {{ $warna_sangat_gelap }};
        --color-primary-light: {{ $warna_terang }};
    }

    /* Dynamic Color Overrides */
    .bg-primary { background-color: {{ $warna_dasar }} !important; }
    .bg-primary-dark { background-color: {{ $warna_gelap }} !important; }
    .text-primary { color: {{ $warna_dasar }} !important; }
    .border-primary { border-color: {{ $warna_dasar }} !important; }

    .hover\:bg-primary:hover { background-color: {{ $warna_dasar }} !important; }
    .hover\:bg-primary-dark:hover { background-color: {{ $warna_gelap }} !important; }
    .hover\:text-primary:hover { color: {{ $warna_dasar }} !important; }
    .hover\:border-primary:hover { border-color: {{ $warna_dasar }} !important; }

    /* Mobile menu */
    .mobile-menu { transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
    .mobile-menu.active { transform: translateX(0); }

    /* Scroll to top */
    #scrollToTop { background-color: {{ $warna_dasar }}; }
    #scrollToTop:hover { background-color: {{ $warna_gelap }}; }

    /* Swiper overrides */
    .swiper-pagination-bullet-active { background-color: {{ $warna_dasar }} !important; }
    .swiper-button-next, .swiper-button-prev { color: #fff !important; }

    /* Links */
    a.text-primary:hover { color: {{ $warna_gelap }} !important; }

    /* DataTables overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: {{ $warna_dasar }} !important; color: #fff !important; border-color: {{ $warna_dasar }} !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: {{ $warna_gelap }} !important; color: #fff !important; border-color: {{ $warna_gelap }} !important; }

    /* Highcharts */
    .highcharts-color-0 { fill: {{ $warna_dasar }}; stroke: {{ $warna_dasar }}; }

    /* Fancybox */
    .fancybox-thumbs__list a::before { border-color: {{ $warna_dasar }}; }

    /* General utility */
    .btn-primary, .bg-theme { background-color: {{ $warna_dasar }} !important; border-color: {{ $warna_dasar }} !important; color: #fff !important; }
    .btn-primary:hover { background-color: {{ $warna_gelap }} !important; border-color: {{ $warna_gelap }} !important; }

    /* Green shades mapped to dynamic color */
    .bg-green-100 { background-color: {{ $warna_terang }} !important; }
    .text-green-200 { color: {{ $warna_terang }} !important; }
    .hover\:text-green-200:hover { color: {{ $warna_terang }} !important; }
    .hover\:bg-green-50:hover { background-color: {{ $warna_terang }} !important; }

    /* Breadcrumb */
    .breadcrumb-item.active { color: {{ $warna_dasar }}; }

    /* Progress bars */
    .progress-bar { background-color: {{ $warna_dasar }}; }
</style>
