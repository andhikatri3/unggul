@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@php $aktif = array_filter($sosmed, fn($s) => !empty($s['link'])); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-share-alt text-primary/50 text-xs"></i>
</div>

@if (count($aktif) > 0)
    <div class="p-5">
        <div class="flex flex-wrap gap-2.5">
            @foreach ($aktif as $data)
                @php
                    $namaLower = strtolower($data['nama']);
                    $iconMap = [
                        'facebook'  => 'fab fa-facebook',
                        'twitter'   => 'fab fa-twitter',
                        'x'         => 'fab fa-x-twitter',
                        'instagram' => 'fab fa-instagram',
                        'youtube'   => 'fab fa-youtube',
                        'whatsapp'  => 'fab fa-whatsapp',
                        'telegram'  => 'fab fa-telegram-plane',
                        'tiktok'    => 'fab fa-tiktok',
                        'linkedin'  => 'fab fa-linkedin-in',
                    ];
                    $faIcon = $iconMap[$namaLower] ?? 'fab fa-' . $namaLower;
                @endphp
                <a href="{{ $data['link'] }}" rel="noopener noreferrer" target="_blank"
                   title="{{ $data['nama'] }}"
                   class="w-11 h-11 rounded-xl border border-gray-100 hover:border-primary/30 hover:bg-primary hover:text-white hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center text-gray-500 bg-white">
                    <i class="{{ $faIcon }} text-base"></i>
                </a>
            @endforeach
        </div>
    </div>
@else
    <div class="p-6 text-center">
        <i class="fas fa-share-alt text-gray-200 text-3xl mb-2 block"></i>
        <p class="text-sm text-gray-400">Belum ada media sosial</p>
    </div>
@endif
