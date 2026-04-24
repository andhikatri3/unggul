@php $abstrak_headline = potong_teks(strip_tags($headline['isi']), 300) @endphp

<div class="bg-white rounded-2xl shadow-sm overflow-hidden mt-6">
    <div class="px-5 pt-5 pb-2 border-b border-gray-100">
        <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
            <span class="inline-block w-1 h-5 bg-primary rounded-full"></span>
            Berita Utama
        </h2>
    </div>

    <div class="p-5">
        <a href="{{ $headline->url_slug }}" class="block no-underline group">
            <div class="relative overflow-hidden rounded-xl mb-4 bg-gray-100">
                @if ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $headline['gambar']))
                    <img src="{{ AmbilFotoArtikel($headline['gambar'], 'sedang') }}"
                         alt="{{ $headline['judul'] }}"
                         class="w-full h-64 md:h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-newspaper text-gray-300 text-5xl"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                @php $kat_headline = $headline->category?->kategori ?? null; @endphp
                @if ($kat_headline)
                    <span class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                        {{ $kat_headline }}
                    </span>
                @endif
            </div>
        </a>
        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 leading-snug">
            <a href="{{ $headline->url_slug }}"
               class="hover:text-primary no-underline text-gray-900 transition-colors">{{ $headline['judul'] }}</a>
        </h3>
        <div class="flex flex-wrap items-center text-xs text-gray-400 mb-3 gap-x-3 gap-y-1">
            <span><i class="fas fa-calendar mr-1"></i>{{ tgl_indo($headline['tgl_upload']) }}</span>
            @if ($headline->author?->nama)
                <span><i class="fas fa-user mr-1"></i>{{ $headline->author->nama }}</span>
            @endif
            <span><i class="fas fa-eye mr-1"></i>{{ hit($headline['hit']) }}</span>
        </div>
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3">{{ $abstrak_headline }}...</p>
        <a href="{{ $headline->url_slug }}"
           class="inline-flex items-center gap-1.5 mt-4 text-sm font-semibold text-primary hover:underline no-underline transition-colors">
            Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>
</div>
