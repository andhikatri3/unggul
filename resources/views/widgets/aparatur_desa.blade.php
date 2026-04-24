@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-users text-primary/50 text-xs"></i>
</div>

@if (!empty($aparatur_desa['daftar_perangkat']))
<div class="p-5">
    <div class="swiper officials-swiper pb-8">
        <div class="swiper-wrapper">
            @foreach ($aparatur_desa['daftar_perangkat'] as $data)
            <div class="swiper-slide">
                <div class="text-center">
                    <div class="relative inline-block mb-3">
                        <img src="{{ $data['foto'] }}" alt="{{ $data['nama'] }}"
                             class="w-20 h-24 rounded-2xl mx-auto object-cover border-2 border-primary/20 bg-gray-100">
                        @if (!empty($data['kehadiran']) && $data['kehadiran'] == 1)
                            @if ($data['status_kehadiran'] == 'hadir')
                                <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-green-500 border-2 border-white"></span>
                            @elseif ($data['tanggal'] == date('Y-m-d'))
                                <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-red-500 border-2 border-white"></span>
                            @else
                                <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-gray-400 border-2 border-white"></span>
                            @endif
                        @endif
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm leading-tight mb-0.5">{{ $data['nama'] }}</h4>
                    <p class="text-xs text-primary font-medium">{{ $data['jabatan'] }}</p>
                    @if (!empty($data['kehadiran']) && $data['kehadiran'] == 1)
                        <div class="mt-2">
                            @if ($data['status_kehadiran'] == 'hadir')
                                <span class="inline-block px-2 py-0.5 text-xs rounded-full bg-green-50 text-green-700 font-medium">Hadir</span>
                            @elseif ($data['tanggal'] == date('Y-m-d'))
                                <span class="inline-block px-2 py-0.5 text-xs rounded-full bg-red-50 text-red-600 font-medium">{{ ucwords($data['status_kehadiran']) }}</span>
                            @else
                                <span class="inline-block px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-500 font-medium">Tidak Ada</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination mt-4"></div>
    </div>
</div>
@endif
