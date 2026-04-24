@extends('theme::template')

@section('layout')
    @hasSection('hero')
    <div class="container mx-auto px-4 pt-8">
        @yield('hero')
    </div>
    @endif

    <section class="py-10 bg-white">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </section>

    {{-- Aparatur Desa --}}
    @if (!empty($aparatur_desa['daftar_perangkat']))
    <section class="py-16 overflow-hidden relative" style="background: linear-gradient(135deg, var(--color-primary-darker) 0%, var(--color-primary-dark) 45%, var(--color-primary) 100%);">

        {{-- Dekorasi lingkaran blur --}}
        <div class="absolute top-0 left-0 w-72 h-72 rounded-full opacity-10" style="background:white;filter:blur(80px);transform:translate(-30%,-30%)"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full opacity-10" style="background:white;filter:blur(100px);transform:translate(30%,30%)"></div>

        <div class="container mx-auto px-4 relative">

            {{-- Header section --}}
            <div class="text-center mb-10">
                <p class="text-white/60 text-xs font-semibold uppercase tracking-[0.25em] mb-2">Kenali</p>
                <h2 class="text-3xl font-black text-white tracking-wide mb-3">
                    {{ ucwords(setting('sebutan_pemerintah_desa') ?? 'Aparatur Desa') }}
                </h2>
                <div class="flex items-center justify-center gap-2">
                    <div class="w-8 h-px bg-white/30"></div>
                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                    <div class="w-16 h-0.5 bg-white rounded-full"></div>
                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                    <div class="w-8 h-px bg-white/30"></div>
                </div>
            </div>

            {{-- Swiper --}}
            @php
                // Duplikasi slide otomatis agar loop Swiper bekerja di semua breakpoint.
                // Butuh minimal 12 slide (ceil(5.2) × 2) untuk slidesPerView terbesar.
                $aparaturList = $aparatur_desa['daftar_perangkat'];
                while (count($aparaturList) < 12) {
                    $aparaturList = array_merge($aparaturList, $aparatur_desa['daftar_perangkat']);
                }
            @endphp
            <div class="swiper aparatur-swiper">
                <div class="swiper-wrapper items-end pb-4">
                    @foreach ($aparaturList as $data)
                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden bg-gray-900 shadow-2xl group" style="aspect-ratio:3/4;">

                            {{-- Foto --}}
                            <img src="{{ $data['foto'] }}"
                                 alt="{{ $data['nama'] }}"
                                 class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">

                            {{-- Overlay gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/10 to-transparent"></div>

                            {{-- Badge jabatan — glassmorphism atas --}}
                            <div class="absolute top-3 inset-x-3">
                                <span class="inline-flex items-center gap-1.5 text-white text-[11px] font-semibold px-3 py-1.5 rounded-full w-full justify-center truncate"
                                      style="background:rgba(255,255,255,0.15);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.2);">
                                    <i class="fas fa-user-tie text-[10px] opacity-80"></i>
                                    {{ $data['jabatan'] }}
                                </span>
                            </div>

                            {{-- Info bawah --}}
                            <div class="absolute inset-x-0 bottom-0 px-4 pb-4 pt-10">
                                <h3 class="text-white text-sm font-bold text-center leading-snug drop-shadow-lg line-clamp-2">
                                    {{ $data['nama'] }}
                                </h3>

                                @if (!empty($data['kehadiran']) && $data['kehadiran'] == 1)
                                <div class="flex justify-center mt-2">
                                    @if ($data['status_kehadiran'] == 'hadir')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-green-500 text-white shadow">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full" style="animation:aparatur-pulse 1.5s ease-in-out infinite"></span>
                                            Hadir
                                        </span>
                                    @elseif ($data['tanggal'] == date('Y-m-d'))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-red-500 text-white shadow">
                                            <i class="fas fa-times-circle text-[10px]"></i>
                                            {{ ucwords($data['status_kehadiran']) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[11px] font-bold rounded-full text-white shadow"
                                              style="background:rgba(255,255,255,0.2)">
                                            <i class="fas fa-clock text-[10px]"></i>
                                            Tidak di Kantor
                                        </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination aparatur-pagination mt-6"></div>
            </div>
        </div>

        <style>
            .aparatur-swiper .swiper-slide {
                opacity: 0.5;
                transform: scale(0.88);
                transition: opacity 0.5s ease, transform 0.5s ease;
                filter: brightness(0.7);
            }
            .aparatur-swiper .swiper-slide-active {
                opacity: 1;
                transform: scale(1);
                filter: brightness(1);
            }
            .aparatur-swiper .swiper-slide-prev,
            .aparatur-swiper .swiper-slide-next {
                opacity: 0.75;
                transform: scale(0.94);
                filter: brightness(0.85);
            }
            .aparatur-pagination .swiper-pagination-bullet {
                width: 6px; height: 6px;
                background: rgba(255,255,255,0.4);
                transition: width 0.3s ease, background 0.3s ease;
                border-radius: 3px;
            }
            .aparatur-pagination .swiper-pagination-bullet-active {
                width: 24px;
                background: #ffffff;
            }
            @keyframes aparatur-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: 0.4; transform: scale(0.8); }
            }
        </style>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.aparatur-swiper')) {
                new Swiper('.aparatur-swiper', {
                    loop: true,
                    loopAdditionalSlides: 4,
                    centeredSlides: true,
                    initialSlide: 0,
                    speed: 700,
                    autoplay: { delay: 3500, disableOnInteraction: false, pauseOnMouseEnter: true },
                    pagination: { el: '.aparatur-pagination', clickable: true },
                    slidesPerView: 1.6,
                    spaceBetween: 16,
                    breakpoints: {
                        480:  { slidesPerView: 2.2, spaceBetween: 16 },
                        768:  { slidesPerView: 3.2, spaceBetween: 20 },
                        1024: { slidesPerView: 4.2, spaceBetween: 24 },
                        1280: { slidesPerView: 5.2, spaceBetween: 24 }
                    }
                });
            }
        });
    </script>
    @endpush
    @endif

    {{-- ═══ Peta Desa ═══ --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">

            <div class="flex flex-col items-center mb-8">
                <p class="text-primary text-xs font-semibold uppercase tracking-[0.25em] mb-2">Temukan Kami</p>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-3">
                    Peta {{ ucwords(setting('sebutan_desa')) }}
                </h2>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-px bg-gray-300"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-16 h-0.5 bg-primary rounded-full"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-8 h-px bg-gray-300"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Lokasi Kantor --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
                        <h3 class="text-sm font-bold text-gray-800 flex-1">Lokasi Kantor</h3>
                        <i class="fas fa-map-marked-alt text-primary/40 text-sm"></i>
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <div id="hp_map_kantor" class="rounded-xl overflow-hidden border border-gray-100 flex-1" style="min-height:280px;isolation:isolate;"></div>
                        <div class="flex gap-2 mt-3">
                            <a href="https://www.openstreetmap.org/#map=15/{{ $desa['lat'] }}/{{ $desa['lng'] }}"
                               rel="noopener noreferrer" target="_blank"
                               class="flex-1 flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-semibold transition-colors no-underline">
                                <i class="fas fa-external-link-alt text-xs"></i> Buka Peta
                            </a>
                            <button onclick="document.getElementById('hp-map-detail').classList.toggle('hidden')"
                                class="flex items-center justify-center gap-1.5 px-4 py-2.5 border border-gray-200 hover:border-primary hover:text-primary text-gray-600 rounded-lg text-sm font-semibold transition-colors bg-transparent">
                                <i class="fas fa-info-circle text-xs"></i> Detail
                            </button>
                        </div>
                        <div id="hp-map-detail" class="hidden mt-4 pt-4 border-t border-gray-100 space-y-2">
                            @if (is_file(FCPATH . LOKASI_LOGO_DESA . ($desa['kantor_desa'] ?? '')))
                                <img class="w-full rounded-xl mb-3 object-cover h-32"
                                     src="{{ gambar_desa($desa['kantor_desa'], true) }}"
                                     alt="Kantor {{ ucwords(setting('sebutan_desa')) }}">
                            @endif
                            @foreach ([
                                ['label' => 'Alamat',                                  'value' => $desa['alamat_kantor'] ?? ''],
                                ['label' => ucwords(setting('sebutan_desa')),          'value' => $desa['nama_desa'] ?? ''],
                                ['label' => ucwords(setting('sebutan_kecamatan')),     'value' => $desa['nama_kecamatan'] ?? ''],
                                ['label' => ucwords(setting('sebutan_kabupaten')),     'value' => $desa['nama_kabupaten'] ?? ''],
                                ['label' => 'Kodepos',                                 'value' => $desa['kode_pos'] ?? ''],
                                ['label' => 'Telepon',                                 'value' => $desa['telepon'] ?? ''],
                                ['label' => 'Email',                                   'value' => $desa['email_desa'] ?? ''],
                            ] as $row)
                                @if (!empty($row['value']))
                                <div class="flex gap-2 text-xs">
                                    <span class="text-gray-500 w-20 flex-shrink-0">{{ $row['label'] }}</span>
                                    <span class="text-gray-400">:</span>
                                    <span class="text-gray-700 flex-1">{{ $row['value'] }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Peta Wilayah --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
                        <h3 class="text-sm font-bold text-gray-800 flex-1">Peta Wilayah</h3>
                        <i class="fas fa-map text-primary/40 text-sm"></i>
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <div id="hp_map_wilayah" class="rounded-xl overflow-hidden border border-gray-100 flex-1" style="min-height:280px;isolation:isolate;"></div>
                        <a href="https://www.openstreetmap.org/#map=15/{{ $desa['lat'] }}/{{ $desa['lng'] }}"
                           rel="noopener noreferrer" target="_blank"
                           class="flex items-center justify-center gap-2 w-full mt-3 bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-semibold transition-colors no-underline">
                            <i class="fas fa-external-link-alt text-xs"></i> Buka Peta
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
    <script>
    (function () {
        @php
            $hp_sebutan     = ucwords(setting('sebutan_desa') ?? 'desa');
            $hp_nama_desa   = ucwords($desa['nama_desa'] ?? '');
            $hp_alamat      = $desa['alamat_kantor'] ?? '';
        @endphp

        @if (!empty($desa['lat']) && !empty($desa['lng']))
            var _lat = {{ $desa['lat'] }};
            var _lng = {{ $desa['lng'] }};
            var _zm  = {{ $desa['zoom'] ?: 13 }};
        @else
            var _lat = -1.0546279422758742;
            var _lng = 116.71875000000001;
            var _zm  = 10;
        @endif

        var _opts     = { maxZoom: {{ setting('max_zoom_peta') }}, minZoom: {{ setting('min_zoom_peta') }} };
        var _mbKey    = {!! json_encode(setting('mapbox_key') ?? '') !!};
        var _jenis    = {!! json_encode(setting('jenis_peta') ?? '') !!};
        var _namaDesa = {!! json_encode($hp_nama_desa) !!};
        var _alamat   = {!! json_encode($hp_alamat) !!};
        var _sebutan  = {!! json_encode($hp_sebutan) !!};
        var _primary  = getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim() || '#16a34a';

        // Custom pin icon warna primary
        var _pinIcon = L.divIcon({
            html: '<div style="position:relative;width:28px;height:36px;">'
                + '<svg viewBox="0 0 28 36" width="28" height="36" xmlns="http://www.w3.org/2000/svg">'
                + '<path d="M14 0C6.268 0 0 6.268 0 14c0 8.732 14 22 14 22S28 22.732 28 14C28 6.268 21.732 0 14 0z" fill="' + _primary + '" filter="drop-shadow(0 2px 4px rgba(0,0,0,0.3))"/>'
                + '<circle cx="14" cy="14" r="6" fill="rgba(255,255,255,0.95)"/>'
                + '</svg>'
                + '</div>',
            className: '',
            iconSize:   [28, 36],
            iconAnchor: [14, 36],
            popupAnchor:[0, -40]
        });

        // Helper buat legend control
        function makeLegend(position, innerHtml) {
            var ctrl = L.control({ position: position });
            ctrl.onAdd = function() {
                var d = L.DomUtil.create('div');
                d.innerHTML = innerHtml;
                L.DomEvent.disableClickPropagation(d);
                return d;
            };
            return ctrl;
        }

        // ── Peta Lokasi Kantor ─────────────────────────────────
        var mapKantor = L.map('hp_map_kantor', _opts).setView([_lat, _lng], _zm);
        var blKantor  = getBaseLayers(mapKantor, _mbKey, _jenis);
        L.control.layers(blKantor, null, { position: 'topright', collapsed: true }).addTo(mapKantor);

        @if (!empty($desa['lat']) && !empty($desa['lng']))
        L.marker([_lat, _lng], { icon: _pinIcon }).addTo(mapKantor);
        @endif

        makeLegend('bottomleft',
            '<div style="background:white;border-radius:10px;padding:10px 14px;'
            + 'box-shadow:0 4px 20px rgba(0,0,0,0.12);max-width:220px;'
            + 'border-left:4px solid ' + _primary + ';margin:0 0 8px 8px;">'
            + '<div style="display:flex;align-items:center;gap:6px;margin-bottom:5px;">'
            + '<i class="fas fa-building" style="color:' + _primary + ';font-size:11px;flex-shrink:0;"></i>'
            + '<span style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.05em;">Kantor ' + _sebutan + '</span>'
            + '</div>'
            + '<div style="font-size:13px;font-weight:700;color:#111827;margin-bottom:3px;">' + _namaDesa + '</div>'
            + '<div style="font-size:10px;color:#9ca3af;line-height:1.5;">' + _alamat + '</div>'
            + '</div>'
        ).addTo(mapKantor);

        // ── Peta Wilayah Desa ──────────────────────────────────
        var mapWil = L.map('hp_map_wilayah', _opts).setView([_lat, _lng], _zm);
        var blWil  = getBaseLayers(mapWil, _mbKey, _jenis);
        L.control.layers(blWil, null, { position: 'topright', collapsed: true }).addTo(mapWil);

        @if (!empty($desa['path']))
        var poly = L.polygon({!! $desa['path'] !!}, {
            stroke: true, color: _primary, opacity: 0.85, weight: 2.5,
            fillColor: _primary, fillOpacity: 0.15
        }).addTo(mapWil);
        mapWil.fitBounds(poly.getBounds(), { padding: [20, 20] });
        @endif

        makeLegend('bottomleft',
            '<div style="background:white;border-radius:10px;padding:10px 14px;'
            + 'box-shadow:0 4px 20px rgba(0,0,0,0.12);max-width:200px;margin:0 0 8px 8px;">'
            + '<div style="font-size:10px;font-weight:700;color:#9ca3af;text-transform:uppercase;'
            + 'letter-spacing:0.07em;margin-bottom:8px;">Lokasi</div>'
            + '<div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">'
            + '<div style="width:18px;height:10px;border-radius:2px;flex-shrink:0;'
            + 'background:' + _primary + ';opacity:0.25;border:2px solid ' + _primary + ';"></div>'
            + '<span style="font-size:11px;font-weight:600;color:#374151;">Wilayah ' + _sebutan + '</span>'
            + '</div>'
            + '<div style="font-size:11px;color:#6b7280;padding-left:26px;font-weight:500;">' + _namaDesa + '</div>'
            + '</div>'
        ).addTo(mapWil);

    })();
    </script>
    @endpush

    <!-- Galeri Kegiatan -->
    @if (!empty($w_gal))
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center mb-8">
                <p class="text-primary text-xs font-semibold uppercase tracking-[0.25em] mb-2">Dokumentasi</p>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-3">Galeri Kegiatan</h2>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-px bg-gray-300"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-16 h-0.5 bg-primary rounded-full"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-8 h-px bg-gray-300"></div>
                </div>
            </div>

            <div class="swiper galeri-bottom-swiper">
                <div class="swiper-wrapper">
                    @foreach ($w_gal as $data)
                        @if (is_file(LOKASI_GALERI . 'sedang_' . $data['gambar']))
                        <div class="swiper-slide">
                            <a href="{{ site_url("galeri/$data[id]") }}" class="block no-underline group">
                                <div class="relative overflow-hidden rounded-lg">
                                    <img src="{{ AmbilGaleri($data['gambar'], 'kecil') }}" alt="{{ $data['nama'] }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                    </div>
                                </div>
                                <h4 class="mt-2 font-semibold text-gray-800 text-sm group-hover:text-primary transition-colors text-center truncate">{{ $data['nama'] }}</h4>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-pagination mt-6"></div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ site_url('galeri') }}" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-lg font-semibold transition-colors no-underline">
                    Lihat Semua Foto
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.galeri-bottom-swiper')) {
                new Swiper('.galeri-bottom-swiper', {
                    loop: true,
                    autoplay: { delay: 3000, disableOnInteraction: false },
                    pagination: { el: '.galeri-bottom-swiper .swiper-pagination', clickable: true },
                    slidesPerView: 2,
                    spaceBetween: 16,
                    breakpoints: {
                        640: { slidesPerView: 3 },
                        1024: { slidesPerView: 4 }
                    }
                });
            }
        });
    </script>
    @endpush
    @endif
    
    @if (!empty($stat_widget) || theme_config('statistik_desa'))
    @php
        $sw_laki = 0; $sw_perempuan = 0;
        if (!empty($stat_widget)) {
            foreach ($stat_widget as $sw) {
                if ($sw['jumlah'] != '-' && $sw['nama'] != 'JUMLAH') {
                    $sw_laki = $sw['laki'];
                    $sw_perempuan = $sw['perempuan'];
                }
            }
        }
        $sw_total = $sw_laki + $sw_perempuan;
        $sw_pct_laki = $sw_total > 0 ? round(($sw_laki / $sw_total) * 100) : 50;
        $sw_pct_perempuan = $sw_total > 0 ? round(($sw_perempuan / $sw_total) * 100) : 50;
    @endphp
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center mb-8">
                <p class="text-primary text-xs font-semibold uppercase tracking-[0.25em] mb-2">Data</p>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-3">Statistik {{ ucwords(setting('sebutan_desa')) }}</h2>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-px bg-gray-300"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-16 h-0.5 bg-primary rounded-full"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/50"></div>
                    <div class="w-8 h-px bg-gray-300"></div>
                </div>
            </div>

            {{-- Statistik Penduduk --}}
            @if (!empty($stat_widget))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-male text-blue-500 text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-3xl font-bold text-blue-700">{{ number_format($sw_laki, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">Laki-laki <span class="text-blue-500 font-semibold">{{ $sw_pct_laki }}%</span></p>
                        <div class="w-full bg-blue-100 rounded-full h-1.5 mt-2">
                            <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $sw_pct_laki }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-pink-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-female text-pink-500 text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-3xl font-bold text-pink-700">{{ number_format($sw_perempuan, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">Perempuan <span class="text-pink-500 font-semibold">{{ $sw_pct_perempuan }}%</span></p>
                        <div class="w-full bg-pink-100 rounded-full h-1.5 mt-2">
                            <div class="bg-pink-500 h-1.5 rounded-full" style="width: {{ $sw_pct_perempuan }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users text-primary text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-primary">{{ number_format($sw_total, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">Total Penduduk</p>
                        <a href="{{ site_url('data-statistik/jenis-kelamin') }}"
                        class="text-xs text-primary hover:text-primary-dark font-medium mt-1 inline-flex items-center gap-1 no-underline">
                            Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Kategori Statistik --}}
            @if (theme_config('statistik_desa'))
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="{{ site_url('data-wilayah') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-map-marked-alt text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Wilayah</p>
                    </div>
                </a>
                <a href="{{ site_url('data-statistik/pendidikan-dalam-kk') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-graduation-cap text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Pendidikan</p>
                    </div>
                </a>
                <a href="{{ site_url('data-statistik/pekerjaan') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-briefcase text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Pekerjaan</p>
                    </div>
                </a>
                <a href="{{ site_url('data-statistik/agama') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-mosque text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Agama</p>
                    </div>
                </a>
                <a href="{{ site_url('data-statistik/jenis-kelamin') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-venus-mars text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Jenis Kelamin</p>
                    </div>
                </a>
                <a href="{{ site_url('data-statistik/rentang-umur') }}" class="group text-center no-underline">
                    <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow group-hover:border-primary border-2 border-transparent">
                        <i class="fas fa-users text-3xl text-primary mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-primary">Umur</p>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </section>
    @endif

@endsection
