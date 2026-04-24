@php $abstrak = potong_teks(strip_tags($post['isi']), 120) @endphp

<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col group">
    <div class="relative overflow-hidden flex-shrink-0">
        <a href="{{ $post->url_slug }}" class="block" title="{{ $post['judul'] }}">
            @if ($post['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'kecil_' . $post['gambar']))
                <img src="{{ AmbilFotoArtikel($post['gambar'], 'kecil') }}"
                     alt="{{ $post['judul'] }}"
                     class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-56 bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-newspaper text-gray-300 text-3xl"></i>
                </div>
            @endif
        </a>
        @php
            $nama_kat = $post->category?->kategori ?? null;
            $kat_slug = $post->category?->slug ?? null;
            if ($nama_kat) {
                $kat_palettes = [
                    ['bg'=>'#EEF2FF','text'=>'#4338CA'],
                    ['bg'=>'#FDF4FF','text'=>'#7E22CE'],
                    ['bg'=>'#FFF7ED','text'=>'#C2410C'],
                    ['bg'=>'#ECFDF5','text'=>'#065F46'],
                    ['bg'=>'#EFF6FF','text'=>'#1D4ED8'],
                    ['bg'=>'#FEF2F2','text'=>'#B91C1C'],
                    ['bg'=>'#FEFCE8','text'=>'#92400E'],
                    ['bg'=>'#F0FDF4','text'=>'#15803D'],
                ];
                $kat_color = $kat_palettes[($post->category->id ?? 0) % count($kat_palettes)];
            }
        @endphp
        @if ($nama_kat)
            @if ($kat_slug)
                <a href="{{ ci_route('artikel/kategori/' . $kat_slug) }}"
                   class="absolute top-2.5 left-2.5 text-xs font-semibold px-2.5 py-1 rounded-full no-underline hover:opacity-90 transition-opacity shadow-sm"
                   style="background:{{ $kat_color['bg'] }};color:{{ $kat_color['text'] }}">
                    {{ $nama_kat }}
                </a>
            @else
                <span class="absolute top-2.5 left-2.5 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm"
                      style="background:{{ $kat_color['bg'] }};color:{{ $kat_color['text'] }}">
                    {{ $nama_kat }}
                </span>
            @endif
        @endif
    </div>
    <div class="p-4 flex flex-col flex-1">
        <h3 class="font-bold text-gray-800 mb-2 leading-snug line-clamp-2 flex-1">
            <a href="{{ $post->url_slug }}"
               class="hover:text-primary no-underline text-gray-800 transition-colors"
               title="{{ $post['judul'] }}">{{ $post['judul'] }}</a>
        </h3>
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-2 mb-3">{{ $abstrak }}...</p>
        <div class="flex flex-wrap items-center text-xs text-gray-400 gap-x-3 gap-y-1 mt-auto pt-3 border-t border-gray-100">
            <span><i class="fas fa-calendar mr-1"></i>{{ tgl_indo($post['tgl_upload']) }}</span>
            @if (!empty($post['owner']))
                <span><i class="fas fa-user mr-1"></i>{{ $post['owner'] }}</span>
            @endif
            <span class="ml-auto"><i class="fas fa-eye mr-1"></i>{{ hit($post['hit']) }}</span>
        </div>
    </div>
</article>
