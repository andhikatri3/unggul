@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp
@php defined('THEME_VERSION') or define('THEME_VERSION', 'v26.4') @endphp
@php defined('FOTO_TIDAK_TERSEDIA') or define('FOTO_TIDAK_TERSEDIA', theme_config('foto_tidak_tersedia') ? base_url(theme_config('foto_tidak_tersedia')) : asset('images/404-image-not-found.jpg')) @endphp
@php
    $desa_title = ucwords(setting('sebutan_desa')) . ' ' . $desa['nama_desa']
                . ' ' . ucwords(setting('sebutan_kecamatan')) . ' ' . $desa['nama_kecamatan']
                . ' ' . ucwords(setting('sebutan_kabupaten')) . ' ' . $desa['nama_kabupaten'];
    $site_name  = setting('website_title') . ' ' . $desa_title;
    $org_name   = ucwords(setting('sebutan_desa')) . ' ' . $desa['nama_desa'];
    $is_artikel = !empty($single_artikel['judul']);

    if ($is_artikel) {
        $seo_title       = $single_artikel['judul'] . ' - ' . $org_name;
        $seo_desc        = potong_teks(strip_tags($single_artikel['isi']), 160);
        $seo_url         = site_url('artikel/' . buat_slug($single_artikel));
        $seo_image       = (!empty($single_artikel['gambar']) && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar']))
                           ? base_url(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar'])
                           : FOTO_TIDAK_TERSEDIA;
        $seo_type        = 'article';
        $seo_keywords    = trim(($single_artikel['kategori'] ?? '') . ', ' . $desa_title . ', ' . setting('website_title'), ', ');
        $seo_published   = !empty($single_artikel['tgl_upload']) ? date('c', strtotime($single_artikel['tgl_upload'])) : '';
    } else {
        $seo_title       = $site_name;
        $seo_desc        = 'Portal resmi ' . $org_name . ', ' . ucwords(setting('sebutan_kecamatan')) . ' ' . $desa['nama_kecamatan'] . ', ' . ucwords(setting('sebutan_kabupaten')) . ' ' . $desa['nama_kabupaten'] . ', Provinsi ' . $desa['nama_propinsi'] . '.';
        $seo_url         = site_url();
        $seo_image       = gambar_desa($desa['logo'], true);
        $seo_type        = 'website';
        $seo_keywords    = $site_name . ', portal desa, website desa, ' . $desa['nama_kecamatan'] . ', ' . $desa['nama_kabupaten'];
        $seo_published   = '';
    }
@endphp

<!-- Charset & Viewport -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- SEO Essentials -->
<title>{{ $seo_title }}</title>
<meta name="description" content="{{ $seo_desc }}">
<meta name="keywords" content="{{ $seo_keywords }}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="author" content="{{ $org_name }}">
<link rel="canonical" href="{{ $seo_url }}">

<!-- Open Graph -->
<meta property="og:type" content="{{ $seo_type }}">
<meta property="og:site_name" content="{{ $org_name }}">
<meta property="og:title" content="{{ $seo_title }}">
<meta property="og:description" content="{{ $seo_desc }}">
<meta property="og:url" content="{{ $seo_url }}">
<meta property="og:image" content="{{ $seo_image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $seo_title }}">
<meta property="og:locale" content="id_ID">
<meta property="fb:app_id" content="147912828718">
@if ($is_artikel && $seo_published)
<meta property="article:published_time" content="{{ $seo_published }}">
<meta property="article:author" content="{{ $single_artikel['owner'] ?? $org_name }}">
@if (!empty($single_artikel['kategori']))
<meta property="article:section" content="{{ $single_artikel['kategori'] }}">
@endif
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo_title }}">
<meta name="twitter:description" content="{{ $seo_desc }}">
<meta name="twitter:image" content="{{ $seo_image }}">
<meta name="twitter:image:alt" content="{{ $seo_title }}">

<!-- Theme -->
<meta name="theme-color" content="{{ theme_config('warna_dasar', '#22c55e') }}">
<meta name="google" content="notranslate">
<meta name="theme" content="Unggul">
<meta name="designer" content="Andhika Tri">
<meta name="theme:version" content="{{ THEME_VERSION }}">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ favico_desa() }}">

<!-- PWA -->
<link rel="manifest" href="/manifest.php">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="{{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}">
<link rel="apple-touch-icon" href="{{ gambar_desa($desa['logo']) }}">

<!-- Structured Data: Article -->
@if ($is_artikel)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": {{ json_encode($single_artikel['judul']) }},
  "description": {{ json_encode($seo_desc) }},
  "image": ["{{ $seo_image }}"],
  @if ($seo_published)
  "datePublished": "{{ $seo_published }}",
  "dateModified": "{{ $seo_published }}",
  @endif
  "author": {
    "@type": "Organization",
    "name": {{ json_encode($org_name) }},
    "url": "{{ site_url() }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": {{ json_encode($org_name) }},
    "logo": {
      "@type": "ImageObject",
      "url": "{{ gambar_desa($desa['logo'], true) }}"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ $seo_url }}"
  }
  @if (!empty($single_artikel['kategori']))
  ,"articleSection": {{ json_encode($single_artikel['kategori']) }}
  @endif
}
</script>

<!-- Structured Data: BreadcrumbList -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ site_url() }}" },
    { "@type": "ListItem", "position": 2, "name": "Artikel",  "item": "{{ site_url('arsip') }}" },
    { "@type": "ListItem", "position": 3, "name": {{ json_encode($single_artikel['judul']) }}, "item": "{{ $seo_url }}" }
  ]
}
</script>

@else

<!-- Structured Data: Organization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "GovernmentOrganization",
  "name": {{ json_encode($org_name) }},
  "url": "{{ site_url() }}",
  "logo": "{{ gambar_desa($desa['logo'], true) }}",
  "description": {{ json_encode($seo_desc) }},
  "address": {
    "@type": "PostalAddress",
    "streetAddress": {{ json_encode($desa['alamat_kantor'] ?? '') }},
    "addressLocality": {{ json_encode($desa['nama_kecamatan'] ?? '') }},
    "addressRegion": {{ json_encode($desa['nama_kabupaten'] ?? '') }},
    "postalCode": {{ json_encode($desa['kode_pos'] ?? '') }},
    "addressCountry": "ID"
  }
  @if (!empty($desa['telepon']))
  ,"telephone": {{ json_encode($desa['telepon']) }}
  @endif
  @if (!empty($desa['email_desa']))
  ,"email": {{ json_encode($desa['email_desa']) }}
  @endif
  @if (!empty($desa['lat']) && !empty($desa['lng']))
  ,"geo": {
    "@type": "GeoCoordinates",
    "latitude": {{ $desa['lat'] }},
    "longitude": {{ $desa['lng'] }}
  }
  @endif
}
</script>

<!-- Structured Data: WebSite with SearchAction -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": {{ json_encode($site_name) }},
  "url": "{{ site_url() }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "{{ site_url() }}?cari={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
@endif

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- FontAwesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

<!-- OpenSID Assets -->
<link rel='stylesheet' href="{{ asset('css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="{{ asset('css/mapbox-gl.css') }}" />
<link rel="stylesheet" href="{{ asset('css/peta.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/css/dataTables.bootstrap.min.css') }}">

@stack('styles')

<script language='javascript' src="{{ asset('front/js/jquery.min.js') }}"></script>
<script language='javascript' src="{{ asset('front/js/jquery.cycle2.min.js') }}"></script>
<script language='javascript' src="{{ asset('front/js/jquery.cycle2.carousel.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('front/js/layout.js') }}"></script>
<script src="{{ asset('front/js/jquery.colorbox.js') }}"></script>
<script src="{{ asset('js/leaflet-providers.js') }}"></script>
<script src="{{ asset('js/mapbox-gl.js') }}"></script>
<script src="{{ asset('js/leaflet-mapbox-gl.js') }}"></script>
<script src="{{ asset('js/peta.js') }}"></script>
<script src="{{ asset('bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/dataTables.bootstrap.min.js') }}"></script>
@include('core::admin.layouts.components.validasi_form', ['web_ui' => true])
<script>
    var BASE_URL = '{{ base_url() }}';
    var SITE_URL = '{{ site_url() }}';
    var setting = @json(setting());
    var config = @json(identitas());
</script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

@include('theme::commons.style')

@if (theme_config('jam', true))
<script type="text/javascript">
    window.setTimeout("renderDate()", 1);
    days = new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
    months = new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    function renderDate() {
        var mydate = new Date();
        var year = mydate.getFullYear();
        var day = mydate.getDay();
        var month = mydate.getMonth();
        var daym = mydate.getDate();
        if (daym < 10) daym = "0" + daym;
        var hours = mydate.getHours();
        var minutes = mydate.getMinutes();
        var seconds = mydate.getSeconds();
        if (hours <= 9) hours = "0" + hours;
        if (minutes <= 9) minutes = "0" + minutes;
        if (seconds <= 9) seconds = "0" + seconds;
        var el = document.getElementById('digital-clock');
        if (el) el.innerHTML = days[day] + ", " + daym + " " + months[month] + " " + year + " &nbsp; " + hours + ":" + minutes + ":" + seconds;
        var elDate = document.getElementById('digital-clock-date');
        if (elDate) elDate.innerHTML = days[day] + ", " + daym + " " + months[month] + " " + year;
        var elTime = document.getElementById('digital-clock-time');
        if (elTime) elTime.innerHTML = hours + ":" + minutes + ":" + seconds;
        var el2 = document.getElementById('jam');
        if (el2) el2.innerHTML = '<b>' + days[day] + ", " + daym + " " + months[month] + " " + year + " " + hours + ":" + minutes + ":" + seconds + '</b>';
        setTimeout("renderDate()", 1000);
    }
</script>
@endif

<!-- PWA Service Worker -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .catch(function () {});
        });
    }
</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v20.0&appId=147912828718"></script>
{!! view('admin.layouts.components.token') !!}
