@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if (!empty($slider_gambar['gambar']))
<section class="mb-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Slider (2/3) --}}
        <div class="lg:col-span-2">
            <div class="swiper hero-swiper rounded-xl overflow-hidden h-full" style="min-height: 380px;">
                <div class="swiper-wrapper h-full">
                    @foreach ($slider_gambar['gambar'] as $gambar)
                        @php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; @endphp
                        @if (is_file($file_gambar))
                        <div class="swiper-slide h-full">
                            <div class="relative bg-gray-900 h-full">
                                <img src="{{ base_url($file_gambar) }}"
                                     alt="{{ $gambar['judul'] ?? '' }}"
                                     class="w-full h-full object-cover" style="min-height: 380px; max-height: 460px;">
                                @if (!empty($gambar['judul']))
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent p-3 md:p-5">
                                    <h2 class="text-white text-sm sm:text-base md:text-xl lg:text-2xl font-bold drop-shadow-lg mb-1 md:mb-2 line-clamp-2">{{ $gambar['judul'] }}</h2>
                                    @if ($slider_gambar['sumber'] != 3)
                                        <a href="{{ site_url('artikel/' . buat_slug($gambar)) }}"
                                           class="inline-block bg-primary hover:bg-primary-dark text-white px-2.5 py-1 md:px-4 md:py-1.5 rounded-md md:rounded-lg font-semibold transition-colors no-underline text-xs md:text-sm">
                                            Baca <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next hero-nav"></div>
                <div class="swiper-button-prev hero-nav"></div>
            </div>
        </div>

        {{-- Artikel Terpopuler (1/3) --}}
        @if (!empty($arsip_populer))
        <div class="lg:col-span-1 flex flex-col gap-0 bg-white rounded-xl shadow-sm overflow-hidden hidden lg:block xl:block">
            <div class="px-4 py-3 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <span class="inline-block w-1 h-4 bg-primary rounded-full"></span>
                    Artikel Terpopuler
                </h3>
            </div>
            @foreach ($arsip_populer as $arsip)
                @if ($loop->iteration > 5) @break @endif
                <a href="{{ site_url('artikel/' . buat_slug($arsip)) }}"
                   class="flex gap-3 items-start px-4 py-3 {{ !$loop->first ? 'border-t border-gray-100' : '' }} hover:bg-gray-50 transition-colors no-underline group">
                    <div class="flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden bg-gray-100">
                        @if (!empty($arsip['gambar']) && is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $arsip['gambar']))
                            <img src="{{ base_url(LOKASI_FOTO_ARTIKEL . 'kecil_' . $arsip['gambar']) }}"
                                 alt="{{ $arsip['judul'] }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-300 text-sm"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-gray-800 group-hover:text-primary transition-colors leading-snug line-clamp-2 mb-1">
                            {{ $arsip['judul'] }}
                        </h4>
                        <div class="flex items-center gap-3 text-xs text-gray-400">
                            <span><i class="fas fa-eye mr-1"></i>{{ hit($arsip['hit']) }}</span>
                            <span><i class="fas fa-calendar mr-1"></i>{{ tgl_indo($arsip['tgl_upload']) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @endif

    </div>

    <style>
        .hero-nav { width: 32px; height: 32px; background: rgba(0,0,0,0.45); border-radius: 50%; }
        .hero-nav:after { font-size: 12px; color: #fff; }
        .hero-nav:hover { background: rgba(0,0,0,0.7); }

        /* Mobile: gunakan aspect ratio landscape agar gambar tidak crop di kiri-kanan */
        @media (max-width: 1023px) {
            .hero-swiper { min-height: unset !important; height: auto !important; }
            .hero-swiper .swiper-wrapper { height: auto !important; }
            .hero-swiper .swiper-slide { height: auto !important; aspect-ratio: 16/9; }
            .hero-swiper .swiper-slide > div { height: 100%; position: relative; }
            .hero-swiper .swiper-slide > div > img {
                min-height: unset !important;
                max-height: unset !important;
                height: 100% !important;
                object-fit: cover !important;
            }
        }
    </style>
</section>
@endif
