@extends('theme::layouts.full-content')
@include('theme::commons.asset_peta')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="{{ site_url() }}" class="hover:text-primary no-underline text-gray-500">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-gray-800">Lapak</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-primary">Lapak Desa</h2>

        <!-- Filter -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary flex-1" id="id_kategori" name="id_kategori">
                <option selected value="">Semua Kategori</option>
            </select>
            <input type="text" id="search" name="search" maxlength="50" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary flex-1" placeholder="Cari Produk...">
            <div class="flex gap-3">
                <button type="button" id="btn-cari" class="flex-1 sm:flex-none bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition-colors text-sm">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                <button type="button" id="btn-semua" class="hidden flex-1 sm:flex-none border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-2 rounded-lg font-semibold transition-colors text-sm">
                    Tampil Semua
                </button>
            </div>
        </div>

        <!-- Product List -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3" id="produk-list">
        </div>

        @include('theme::commons.pagination')
    </div>

    <!-- Modal Detail Produk -->
    <div id="modalDetail" class="fixed inset-0 hidden" style="z-index:1080;">
        <div class="fixed inset-0 bg-black/60" id="modalDetailBackdrop"></div>
        <div class="fixed inset-0 flex items-start md:items-center justify-center pt-14 pb-20 px-4 md:pt-0 md:pb-0 md:p-6">
            <div class="relative w-full max-w-5xl">
                <!-- Tombol close di luar area scroll, selalu terlihat -->
                <button id="modalDetailClose" class="absolute -top-3 -right-3 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 hover:bg-red-500 text-white shadow-lg transition-colors">
                    <i class="fas fa-times"></i>
                </button>
                <div class="bg-white rounded-xl shadow-2xl max-h-[calc(100vh-6rem)] md:max-h-[88vh] overflow-y-auto">
                    <div class="flex flex-col md:flex-row">
                        <!-- Kiri: Detail -->
                        <div class="md:w-1/2 p-6 flex flex-col order-2 md:order-1">
                            <span class="text-xs font-semibold text-primary uppercase tracking-wide mb-1" id="detail-kategori"></span>
                            <h3 class="text-xl font-bold text-gray-800 mb-3" id="detail-nama"></h3>
                            <div class="flex items-baseline gap-2 mb-4">
                                <span class="text-2xl font-bold text-primary" id="detail-harga"></span>
                                <span class="text-sm text-gray-400 line-through hidden" id="detail-harga-asli"></span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-1" id="detail-deskripsi"></p>
                            <div class="flex items-center text-sm text-gray-500 mb-6">
                                <i class="fas fa-user mr-2"></i>
                                <span id="detail-pelapak"></span>
                            </div>
                            <div class="flex gap-2">
                                <a id="detail-beli" href="#" target="_blank" rel="noopener noreferrer"
                                   class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition-colors no-underline">
                                    <i class="fab fa-whatsapp text-lg"></i> Beli via WhatsApp
                                </a>
                                <button id="detail-lokasi"
                                    class="flex items-center justify-center gap-1 bg-primary hover:bg-primary-dark text-white px-4 py-3 rounded-lg font-semibold transition-colors"
                                    title="Lihat Lokasi">
                                    <i class="fas fa-map-marker-alt"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Kanan: Gambar -->
                        <div class="md:w-1/2 p-4 bg-gray-50 rounded-tr-xl rounded-br-xl flex flex-col gap-3 order-1 md:order-2">
                            <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                                <img id="detail-foto-utama" src="" alt="" class="w-full h-full object-contain">
                            </div>
                            <div class="flex gap-2 flex-wrap" id="detail-foto-thumbs"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lokasi -->
    <div id="modalLokasi" class="fixed inset-0 hidden" style="z-index:1090;">
        <div class="fixed inset-0 bg-black/50" id="modalLokasiBackdrop"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg relative">
                <div class="flex items-center justify-between p-4 border-b">
                    <h4 class="font-bold text-gray-800" id="modalLokasiTitle"></h4>
                    <button class="text-gray-400 hover:text-gray-600 modal-lokasi-close">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="modalLokasiBody" class="p-4"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var produkData = {};

        // ── Modal Detail ────────────────────────────────────────────────
        function openDetail(id) {
            var item = produkData[id];
            if (!item) return;

            var fotoList  = item.attributes.foto || [];
            var hargaDiskon = formatRupiah(item.attributes.harga_diskon, 'Rp');
            var hargaAwal   = formatRupiah(item.attributes.harga, 'Rp');

            $('#detail-kategori').text(item.attributes.kategori?.kategori || '');
            $('#detail-nama').text(item.attributes.nama);
            $('#detail-harga').text(hargaDiskon);
            $('#detail-deskripsi').text(item.attributes.deskripsi || '-');
            $('#detail-pelapak').text(item.attributes.pelapak?.penduduk?.nama || 'Admin');
            $('#detail-beli').attr('href', item.attributes.pesan_wa || '#');

            if (hargaAwal !== hargaDiskon) {
                $('#detail-harga-asli').text(hargaAwal).removeClass('hidden');
            } else {
                $('#detail-harga-asli').addClass('hidden');
            }

            var fotoUtama = fotoList.length ? fotoList[0] : '';
            $('#detail-foto-utama').attr('src', fotoUtama).attr('alt', item.attributes.nama);

            var thumbsHtml = '';
            fotoList.forEach(function(f, i) {
                thumbsHtml += '<img src="' + f + '" class="w-14 h-14 object-cover rounded-lg cursor-pointer border-2 transition-colors ' + (i === 0 ? 'border-primary' : 'border-transparent hover:border-primary') + ' detail-thumb" data-src="' + f + '">';
            });
            $('#detail-foto-thumbs').html(thumbsHtml);

            $('#detail-lokasi')
                .data('lat',   item.attributes.pelapak?.lat   || '')
                .data('lng',   item.attributes.pelapak?.lng   || '')
                .data('zoom',  item.attributes.pelapak?.zoom  || 10)
                .data('nama',  item.attributes.nama)
                .data('harga', hargaDiskon)
                .data('pelapak', item.attributes.pelapak?.penduduk?.nama || 'Admin')
                .data('title', 'Lokasi ' + (item.attributes.pelapak?.penduduk?.nama || 'Pelapak'));

            $('#modalDetail').removeClass('hidden');
            $('body').addClass('overflow-hidden');
        }

        function closeDetail() {
            $('#modalDetail').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        }

        $('#modalDetailClose, #modalDetailBackdrop').on('click', closeDetail);

        $(document).on('click', '.detail-thumb', function() {
            var src = $(this).data('src');
            $('#detail-foto-utama').attr('src', src);
            $('.detail-thumb').removeClass('border-primary').addClass('border-transparent');
            $(this).addClass('border-primary').removeClass('border-transparent');
        });

        // ── Modal Lokasi ────────────────────────────────────────────────
        function openLokasi(lat, lng, zoom, title, popupHtml) {
            if (!lat || !lng) { alert('Lokasi pelapak belum tersedia'); return; }

            $('#modalLokasiTitle').text(title);
            $('#modalLokasiBody').html("<div id='map' style='width:100%;height:350px;border-radius:0.5rem;'></div>");
            $('#modalLokasi').removeClass('hidden');

            setTimeout(function() {
                if (window.pelapak) window.pelapak.remove();
                window.pelapak = L.map('map', {
                    maxZoom: setting.max_zoom_peta,
                    minZoom: setting.min_zoom_peta
                }).setView([lat, lng], zoom);
                getBaseLayers(window.pelapak, setting.mapbox_key, setting.jenis_peta);
                var markerIcon = L.icon({ iconUrl: setting.icon_lapak_peta });
                L.marker([lat, lng], { icon: markerIcon }).addTo(window.pelapak)
                    .bindPopup('<div class="text-sm">' + popupHtml + '</div>');
                L.control.scale().addTo(window.pelapak);
                window.pelapak.invalidateSize();
            }, 300);
        }

        $('.modal-lokasi-close, #modalLokasiBackdrop').on('click', function() {
            $('#modalLokasi').addClass('hidden');
        });

        // Tombol lokasi di modal detail
        $(document).on('click', '#detail-lokasi', function() {
            var btn = $(this);
            var popupHtml = '<b>' + btn.data('nama') + '</b><br>' + btn.data('harga') + '<br>' + btn.data('pelapak');
            openLokasi(btn.data('lat'), btn.data('lng'), btn.data('zoom'), btn.data('title'), popupHtml);
        });

        // ── Load Kategori ───────────────────────────────────────────────
        $.get('{{ route('api.lapak.kategori') }}', function(data) {
            data.data.forEach(function(item) {
                $('#id_kategori').append('<option value="' + item.id + '">' + item.attributes.kategori + '</option>');
            });
        });

        // ── Load Produk ─────────────────────────────────────────────────
        function loadProduk(params) {
            params = params || {};
            $('#pagination-container').hide();
            var produkList = $('#produk-list');
            produkList.html('<div class="col-span-5 text-center py-12"><i class="fas fa-spinner fa-pulse text-3xl text-primary"></i><p class="text-gray-500 mt-2">Memuat produk...</p></div>');

            $.get('{{ route('api.lapak.produk') }}', params, function(data) {
                produkData = {};
                produkList.empty();

                if (!data.data.length) {
                    produkList.html('<div class="col-span-5 text-center py-12"><i class="fas fa-store text-gray-300 text-5xl mb-3"></i><p class="text-gray-500">Tidak ada produk yang ditemukan</p></div>');
                    return;
                }

                data.data.forEach(function(item) {
                    produkData[item.id] = item;

                    var fotoList    = item.attributes.foto || [];
                    var fotoSrc     = fotoList.length ? fotoList[0] : '';
                    var hargaDiskon = formatRupiah(item.attributes.harga_diskon, 'Rp');
                    var hargaAwal   = formatRupiah(item.attributes.harga, 'Rp');
                    var showDiskon  = (hargaAwal !== hargaDiskon)
                        ? '<span class="text-xs text-gray-400 line-through">' + hargaAwal + '</span>'
                        : '';

                    var fotoImg = fotoSrc
                        ? '<img src="' + fotoSrc + '" alt="' + item.attributes.nama + '" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">'
                        : '<div class="w-full h-full flex items-center justify-center"><i class="fas fa-image text-gray-300 text-4xl"></i></div>';

                    var produkHTML = `
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="relative aspect-square bg-gray-100 overflow-hidden cursor-pointer buka-detail" data-id="${item.id}">
                            ${fotoImg}
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-300 flex items-center justify-center">
                                <span class="bg-white/90 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-eye mr-1"></i> Lihat Detail
                                </span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h3 class="font-bold text-gray-800 text-sm mb-1 truncate cursor-pointer hover:text-primary transition-colors buka-detail" data-id="${item.id}">${item.attributes.nama}</h3>
                            <div class="flex items-baseline gap-1 mb-3">
                                <span class="text-primary font-bold text-sm">${hargaDiskon}</span>
                                ${showDiskon}
                            </div>
                            <div class="flex gap-1.5">
                                <a class="flex-1 flex items-center justify-center gap-1 bg-green-500 hover:bg-green-600 text-white py-1.5 rounded-lg text-xs font-semibold transition-colors no-underline"
                                   href="${item.attributes.pesan_wa}" rel="noopener noreferrer" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Beli
                                </a>
                                <button class="flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors buka-detail"
                                    data-id="${item.id}" title="Lihat Detail">
                                    <i class="fas fa-info"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;

                    produkList.append(produkHTML);
                });

                initPagination(data);
            });
        }

        // Buka modal detail (klik gambar, nama, atau tombol info)
        $(document).on('click', '.buka-detail', function() {
            openDetail($(this).data('id'));
        });

        // ── Filter & Pagination ─────────────────────────────────────────
        function getParams() {
            var params = {};
            var kategori = $('#id_kategori').val();
            var search   = $('#search').val();
            if (kategori) params['filter[id_produk_kategori]'] = kategori;
            if (search)   params['filter[search]'] = search;
            return params;
        }

        $('#btn-cari').on('click', function() {
            loadProduk(getParams());
            $('#btn-semua').removeClass('hidden');
        });

        $('#btn-semua').on('click', function() {
            loadProduk();
            $(this).addClass('hidden');
            $('#search').val('');
            $('#id_kategori').val('');
        });

        $('#search').keypress(function(e) {
            if (e.which == 13) { e.preventDefault(); $('#btn-cari').trigger('click'); }
        });

        $('.pagination').on('click', '.btn-page', function() {
            var params = getParams();
            params['page[number]'] = $(this).data('page');
            loadProduk(params);
        });

        loadProduk();
    });
</script>
@endpush
