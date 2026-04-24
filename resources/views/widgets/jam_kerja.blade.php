@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if ($jam_kerja)
@php
    $namaHariIndo = ['sunday'=>'Minggu','monday'=>'Senin','tuesday'=>'Selasa','wednesday'=>'Rabu','thursday'=>'Kamis','friday'=>'Jumat','saturday'=>'Sabtu'];
    $hariIniIndo  = $namaHariIndo[strtolower(date('l'))] ?? '';
@endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-clock text-primary/50 text-xs"></i>
</div>

<table class="w-full text-sm">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
            <th class="px-5 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Hari</th>
            <th class="py-2.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Mulai</th>
            <th class="px-5 py-2.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">Selesai</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        @foreach ($jam_kerja as $value)
            @php $isToday = strtolower($value->nama_hari) === strtolower($hariIniIndo); @endphp
            <tr class="{{ $isToday ? 'bg-primary/5' : 'hover:bg-gray-50' }} transition-colors">
                <td class="px-5 py-2.5">
                    <span class="flex items-center gap-1.5 {{ $isToday ? 'text-primary font-bold' : 'text-gray-700 font-medium' }}">
                        @if ($isToday)
                            <span class="w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></span>
                        @endif
                        {{ $value->nama_hari }}
                    </span>
                </td>
                @if ($value->status)
                    <td class="py-2.5 text-center text-xs {{ $isToday ? 'text-primary font-semibold' : 'text-gray-500' }}">{{ $value->jam_masuk }}</td>
                    <td class="px-5 py-2.5 text-center text-xs {{ $isToday ? 'text-primary font-semibold' : 'text-gray-500' }}">{{ $value->jam_keluar }}</td>
                @else
                    <td colspan="2" class="px-5 py-2.5 text-center">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500">
                            Libur
                        </span>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endif
