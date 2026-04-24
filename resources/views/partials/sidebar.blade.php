@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

{{-- ── Jam & Tanggal ──
@if (theme_config('jam', true))
<div class="bg-primary rounded-lg shadow-md p-5 mb-6 text-white text-center">
    <div id="jam-tanggal" class="text-sm font-medium leading-relaxed opacity-90"></div>
    <div id="jam-waktu" class="text-3xl font-bold tracking-widest mt-1"></div>
</div>
<script>
    (function() {
        var days   = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
        var months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        function renderJam() {
            var d = new Date();
            var year = d.getFullYear();
            var daym = String(d.getDate()).padStart(2, '0');
            var h = String(d.getHours()).padStart(2, '0');
            var m = String(d.getMinutes()).padStart(2, '0');
            var s = String(d.getSeconds()).padStart(2, '0');
            var tanggal = document.getElementById('jam-tanggal');
            var waktu   = document.getElementById('jam-waktu');
            if (tanggal) tanggal.textContent = days[d.getDay()] + ', ' + daym + ' ' + months[d.getMonth()] + ' ' + year;
            if (waktu)   waktu.textContent   = h + ' : ' + m + ' : ' + s;
            setTimeout(renderJam, 1000);
        }
        renderJam();
    })();
</script>
@endif
--}}

{{-- ── Pintasan Masuk ── --}}
@if (theme_config('pintasan_masuk', true))
<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
    <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
        <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
        <h3 class="text-sm font-bold text-gray-800 flex-1">Masuk</h3>
        <i class="fas fa-sign-in-alt text-primary/50 text-xs"></i>
    </div>
    <div class="p-5 space-y-2">
        <a href="{{ site_url('siteman') }}" target="_blank" rel="noopener noreferrer"
           class="flex items-center justify-center gap-2 w-full bg-primary hover:bg-primary-dark text-white text-sm font-semibold py-2.5 rounded-lg transition-colors no-underline">
            <i class="fas fa-user-shield"></i> Admin
        </a>
        @if ((bool) setting('layanan_mandiri'))
            <a href="{{ site_url('layanan-mandiri') }}" target="_blank" rel="noopener noreferrer"
               class="flex items-center justify-center gap-2 w-full border border-primary text-primary hover:bg-primary hover:text-white text-sm font-semibold py-2.5 rounded-lg transition-colors no-underline">
                <i class="fas fa-id-card"></i> Layanan Mandiri
            </a>
        @endif
    </div>
</div>
@endif

{{-- ── Widgets dari Admin ── --}}
@if ($widgetAktif)
    @foreach ($widgetAktif as $widget)
        @php
            $judul_widget = [
                'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul'])),
            ];
        @endphp
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            @includeIf("theme::widgets.{$widget['isi']}", $judul_widget)
        </div>
    @endforeach
@endif
