@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@php
    $laki = 0; $perempuan = 0;
    foreach ($stat_widget as $data) {
        if ($data['jumlah'] != '-' && $data['nama'] != 'JUMLAH') {
            $laki = $data['laki'];
            $perempuan = $data['perempuan'];
        }
    }
    $total = $laki + $perempuan;
    $pct_laki = $total > 0 ? round(($laki / $total) * 100) : 50;
    $pct_perempuan = $total > 0 ? round(($perempuan / $total) * 100) : 50;
@endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-chart-pie text-primary/50 text-xs"></i>
</div>

<div class="p-5 space-y-4">
    <div>
        <div class="flex justify-between items-center mb-1.5">
            <span class="text-sm text-gray-600 flex items-center gap-1.5">
                <i class="fas fa-male text-blue-500"></i> Laki-laki
            </span>
            <span class="text-sm font-bold text-gray-800">{{ number_format($laki, 0, ',', '.') }}</span>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-2">
            <div class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $pct_laki }}%"></div>
        </div>
    </div>

    <div>
        <div class="flex justify-between items-center mb-1.5">
            <span class="text-sm text-gray-600 flex items-center gap-1.5">
                <i class="fas fa-female text-pink-500"></i> Perempuan
            </span>
            <span class="text-sm font-bold text-gray-800">{{ number_format($perempuan, 0, ',', '.') }}</span>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-2">
            <div class="bg-pink-500 h-2 rounded-full transition-all duration-500" style="width: {{ $pct_perempuan }}%"></div>
        </div>
    </div>

    <div class="flex items-center justify-between bg-primary/5 rounded-xl px-4 py-3">
        <span class="text-sm text-gray-600 flex items-center gap-1.5">
            <i class="fas fa-users text-primary/70"></i> Total Penduduk
        </span>
        <span class="text-xl font-bold text-primary">{{ number_format($total, 0, ',', '.') }}</span>
    </div>

    <a href="{{ site_url('data-statistik/jenis-kelamin') }}"
       class="flex items-center justify-center gap-2 w-full bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-semibold transition-colors no-underline">
        <i class="fas fa-chart-bar text-xs"></i> Lihat Detail Statistik
    </a>
</div>
