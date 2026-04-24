@php $isHomepage = empty($cari ?? '') && empty($judul_kategori ?? ''); @endphp
@extends($isHomepage ? 'theme::layouts.homepage' : 'theme::layouts.right-sidebar')

@section('hero')
    @include('theme::partials.slider')
@endsection

@section('content')
@if ($isHomepage)

    {{-- ═══ HOMEPAGE: Berita Terkini ═══ --}}
    <div class="mb-12">
        <div class="flex flex-col items-center mb-8">
            <p class="text-primary text-xs font-semibold uppercase tracking-[0.25em] mb-2">Terbaru</p>
            <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-3">Berita Terkini</h2>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-px bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                <div class="w-16 h-0.5 bg-primary rounded-full"></div>
                <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                <div class="w-8 h-px bg-gray-300"></div>
            </div>
            <a href="{{ site_url('arsip') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-dark no-underline transition-colors group">
                Lihat Semua <i class="fas fa-arrow-right text-xs group-hover:translate-x-0.5 transition-transform"></i>
            </a>
        </div>

        @if ($artikel->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($artikel->take(6) as $post)
                    @include('theme::partials.artikel.list', ['post' => $post])
                @endforeach
            </div>
        @else
            @include('theme::partials.artikel.empty', ['title' => 'Berita Terkini'])
        @endif
    </div>

    {{-- ═══ HOMEPAGE: Shortcut Layanan ═══ --}}
    @php
        $menuLayanan = menu_tema();
        $shortcutIconMap = [
            'profil'        => 'fa-landmark',
            'sejarah'       => 'fa-scroll',
            'visi'          => 'fa-eye',
            'misi'          => 'fa-bullseye',
            'geografis'     => 'fa-map',
            'peta'          => 'fa-map-marked-alt',
            'statistik'     => 'fa-chart-bar',
            'penduduk'      => 'fa-users',
            'pemerintah'    => 'fa-user-tie',
            'aparatur'      => 'fa-id-badge',
            'lembaga'       => 'fa-sitemap',
            'bpd'           => 'fa-gavel',
            'layanan'       => 'fa-hands-helping',
            'surat'         => 'fa-envelope-open-text',
            'pengaduan'     => 'fa-comment-dots',
            'berita'        => 'fa-newspaper',
            'artikel'       => 'fa-newspaper',
            'agenda'        => 'fa-calendar-alt',
            'galeri'        => 'fa-images',
            'foto'          => 'fa-camera',
            'video'         => 'fa-video',
            'lapak'         => 'fa-store',
            'produk'        => 'fa-box',
            'pembangunan'   => 'fa-hard-hat',
            'infrastruktur' => 'fa-road',
            'apbdes'        => 'fa-money-bill-wave',
            'keuangan'      => 'fa-coins',
            'anggaran'      => 'fa-file-invoice-dollar',
            'idm'           => 'fa-chart-line',
            'sdgs'          => 'fa-leaf',
            'stunting'      => 'fa-child',
            'kesehatan'     => 'fa-heartbeat',
            'dokumen'       => 'fa-file-alt',
            'hukum'         => 'fa-balance-scale',
            'peraturan'     => 'fa-book',
            'inventaris'    => 'fa-clipboard-list',
            'kontak'        => 'fa-phone-alt',
            'hubungi'       => 'fa-phone-alt',
            'wilayah'       => 'fa-map-pin',
            'potensi'       => 'fa-seedling',
            'wisata'        => 'fa-umbrella-beach',
            'umkm'          => 'fa-briefcase',
        ];
        $getShortcutIcon = function(string $nama) use ($shortcutIconMap): string {
            $lower = strtolower($nama);
            foreach ($shortcutIconMap as $keyword => $icon) {
                if (str_contains($lower, $keyword)) return $icon;
            }
            return 'fa-circle-dot';
        };
    @endphp

    {{-- ═══ layanan
    @if (!empty($menuLayanan))
    <div>
        <div class="flex items-center gap-3 mb-6">
            <span class="w-1 h-6 bg-primary rounded-full inline-block flex-shrink-0"></span>
            <h2 class="text-xl font-bold text-gray-800">Layanan</h2>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 gap-3">
            @foreach ($menuLayanan as $item)
                @php $shortcutIcon = $getShortcutIcon($item['nama']); @endphp
                <a href="{{ $item['link_url'] }}"
                   class="group flex flex-col items-center gap-2.5 px-2 py-4 bg-white rounded-xl shadow-sm border border-gray-100
                          hover:shadow-md hover:border-primary/20 hover:-translate-y-0.5 transition-all duration-200 no-underline">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center
                                group-hover:bg-primary transition-colors duration-200 flex-shrink-0">
                        <i class="fas {{ $shortcutIcon }} text-primary group-hover:text-white text-base transition-colors duration-200"></i>
                    </div>
                    <span class="text-xs font-semibold text-gray-600 group-hover:text-primary text-center leading-snug
                                 transition-colors duration-200 line-clamp-2 w-full">
                        {{ $item['nama'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
    @endif
    ═══ --}}
@else

    {{-- ═══ KATEGORI / PENCARIAN: layout existing ═══ --}}
    <div class="mb-8">
        @if (setting('covid_data'))
            @include('theme::partials.corona-widget')
        @endif
        @if (setting('covid_desa'))
            @include('theme::partials.corona-local')
        @endif

        @if ($headline)
            @include('theme::partials.artikel.headline')
        @endif

        @php
            $title = (!empty($judul_kategori)) ? $judul_kategori : 'Artikel Terkini';
            if (is_array($title)) {
                foreach ($title as $item) { $title = $item; }
            }
        @endphp

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="px-5 pt-5 pb-2 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                    <span class="inline-block w-1 h-5 bg-primary rounded-full"></span>
                    {{ $title }}
                </h2>
            </div>
            <div class="p-5">
                @if ($artikel->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach ($artikel as $post)
                            @include('theme::partials.artikel.list', ['post' => $post])
                        @endforeach
                    </div>
                    <div class="mt-8 border-t border-gray-100">
                        @include('theme::commons.page')
                    </div>
                @else
                    @include('theme::partials.artikel.empty', ['title' => $title])
                @endif
            </div>
        </div>
    </div>

@endif
@endsection
