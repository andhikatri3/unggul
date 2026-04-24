@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

{{-- galeri pindah ke bawah, jadi sementara ini di nonaktifkan
<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget ?? 'Galeri' }}</h3>
    <i class="fas fa-images text-primary/50 text-xs"></i>
</div>

@if (!empty($w_gal))
<div class="p-5">
    <div class="swiper widget-galeri-swiper">
        <div class="swiper-wrapper">
            @foreach ($w_gal as $data)
                @if (is_file(LOKASI_GALERI . 'sedang_' . $data['gambar']))
                <div class="swiper-slide">
                    <a href="{{ site_url("galeri/$data[id]") }}" class="block no-underline group">
                        <div class="relative overflow-hidden rounded-xl">
                            <img src="{{ AmbilGaleri($data['gambar'], 'kecil') }}" alt="{{ $data['nama'] }}"
                                 class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                        <h4 class="mt-2 text-xs font-semibold text-gray-700 group-hover:text-primary transition-colors truncate">{{ $data['nama'] }}</h4>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
        <div class="swiper-button-prev widget-galeri-prev"></div>
        <div class="swiper-button-next widget-galeri-next"></div>
    </div>
</div>
@else
<div class="p-6 text-center">
    <i class="fas fa-images text-gray-200 text-3xl mb-2 block"></i>
    <p class="text-sm text-gray-400">Galeri belum tersedia</p>
</div>
@endif

<style>
    .widget-galeri-prev, .widget-galeri-next {
        width: 28px; height: 28px;
        background: rgba(0,0,0,0.4);
        border-radius: 50%;
    }
    .widget-galeri-prev:after, .widget-galeri-next:after { font-size: 10px; color: #fff; }
    .widget-galeri-prev:hover, .widget-galeri-next:hover { background: rgba(0,0,0,0.65); }
</style>
--}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper !== 'undefined' && document.querySelector('.widget-galeri-swiper')) {
        new Swiper('.widget-galeri-swiper', {
            slidesPerView: 1.2,
            spaceBetween: 12,
            loop: true,
            navigation: {
                nextEl: '.widget-galeri-next',
                prevEl: '.widget-galeri-prev',
            },
            breakpoints: {
                640:  { slidesPerView: 2 },
                1024: { slidesPerView: 1 },
            }
        });
    }
});
</script>
@endpush
