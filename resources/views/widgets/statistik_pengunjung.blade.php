@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-chart-bar text-primary/50 text-xs"></i>
</div>

<div class="p-5">
    <div class="grid grid-cols-2 gap-3 mb-4">
        <div class="bg-primary rounded-xl p-3 text-center text-white">
            <p class="text-2xl font-bold leading-none mb-1">{{ number_format($statistik_pengunjung['hari_ini']) }}</p>
            <p class="text-xs opacity-75">Hari ini</p>
        </div>
        <div class="bg-gray-100 rounded-xl p-3 text-center">
            <p class="text-2xl font-bold leading-none mb-1 text-gray-700">{{ number_format($statistik_pengunjung['kemarin']) }}</p>
            <p class="text-xs text-gray-500">Kemarin</p>
        </div>
    </div>

    <div class="flex items-center justify-between bg-primary/5 rounded-lg px-4 py-2.5 mb-4">
        <span class="text-xs text-gray-600 flex items-center gap-1.5">
            <i class="fas fa-users text-primary/70"></i> Total Pengunjung
        </span>
        <span class="text-sm font-bold text-primary">{{ number_format($statistik_pengunjung['total']) }}</span>
    </div>

    <div class="space-y-2">
        @foreach ([
            ['icon' => 'fa-desktop',       'label' => 'Sistem Operasi', 'value' => $statistik_pengunjung['os']],
            ['icon' => 'fa-network-wired', 'label' => 'IP Address',     'value' => $statistik_pengunjung['ip_address']],
            ['icon' => 'fa-globe',         'label' => 'Browser',        'value' => $statistik_pengunjung['browser']],
        ] as $row)
            <div class="flex items-center justify-between py-1.5 border-b border-gray-50 last:border-0">
                <span class="text-xs text-gray-500 flex items-center gap-1.5 flex-shrink-0">
                    <i class="fas {{ $row['icon'] }} text-primary/50 w-3.5"></i>
                    {{ $row['label'] }}
                </span>
                <span class="text-xs font-medium text-gray-700 text-right ml-2 truncate max-w-[55%]" title="{{ $row['value'] }}">
                    {{ $row['value'] }}
                </span>
            </div>
        @endforeach
    </div>
</div>
