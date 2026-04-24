@extends('theme::layouts.full-content')

@php $is_detail = isset($parent) && $parent; @endphp

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="{{ site_url() }}" class="hover:text-primary no-underline text-gray-500">Beranda</a>
            <span class="mx-1">/</span>
            @if ($is_detail)
                <a href="{{ ci_route('galeri') }}" class="hover:text-primary no-underline text-gray-500">Album Galeri</a>
                <span class="mx-1">/</span>
                <span class="text-gray-800">{{ $title ?? '' }}</span>
            @else
                <span class="text-gray-800">Album Galeri</span>
            @endif
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-primary">
            {{ $is_detail ? ($title ?? 'Album') : 'Album Galeri' }}
        </h2>

        <div id="galeri-list"></div>
        @include('theme::commons.pagination')
    </div>

    @if ($is_detail)
    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center" style="z-index: 2000;">
        <button id="lb-close" class="absolute top-4 right-4 text-white text-3xl w-10 h-10 flex items-center justify-center hover:text-gray-300 transition-colors bg-black bg-opacity-40 rounded-full">&times;</button>
        <button id="lb-prev" class="absolute left-3 top-1/2 -translate-y-1/2 text-white text-3xl w-12 h-12 flex items-center justify-center hover:text-gray-300 transition-colors bg-black bg-opacity-40 rounded-full">&#8249;</button>
        <button id="lb-next" class="absolute right-3 top-1/2 -translate-y-1/2 text-white text-3xl w-12 h-12 flex items-center justify-center hover:text-gray-300 transition-colors bg-black bg-opacity-40 rounded-full">&#8250;</button>
        <div class="flex flex-col items-center max-w-4xl w-full px-16">
            <img id="lb-img" src="" alt="" class="max-h-[80vh] max-w-full object-contain rounded-lg shadow-2xl">
            <p id="lb-caption" class="text-white text-sm mt-3 text-center opacity-80"></p>
            <p id="lb-counter" class="text-gray-400 text-xs mt-1"></p>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var parent = `{{ $parent ?? '' }}`;
        var isDetail = {{ $is_detail ? 'true' : 'false' }};
        var routeGaleri = `{{ ci_route('internal_api.galeri') }}`;
        var pageSizes = isDetail ? 12 : 8;

        if (isDetail) {
            routeGaleri += '/' + parent;
        }

        // ── Lightbox ──
        var lbImages = [];
        var lbIndex  = 0;

        function openLightbox(index) {
            lbIndex = index;
            updateLightbox();
            var lb = document.getElementById('lightbox');
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            var lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function updateLightbox() {
            document.getElementById('lb-img').src     = lbImages[lbIndex].src;
            document.getElementById('lb-img').alt     = lbImages[lbIndex].caption;
            document.getElementById('lb-caption').textContent = lbImages[lbIndex].caption;
            document.getElementById('lb-counter').textContent = (lbIndex + 1) + ' / ' + lbImages.length;
            document.getElementById('lb-prev').style.display = lbImages.length > 1 ? 'flex' : 'none';
            document.getElementById('lb-next').style.display = lbImages.length > 1 ? 'flex' : 'none';
        }

        if (isDetail) {
            document.getElementById('lb-close').addEventListener('click', closeLightbox);
            document.getElementById('lightbox').addEventListener('click', function(e) {
                if (e.target === this) closeLightbox();
            });
            document.getElementById('lb-prev').addEventListener('click', function() {
                lbIndex = (lbIndex - 1 + lbImages.length) % lbImages.length;
                updateLightbox();
            });
            document.getElementById('lb-next').addEventListener('click', function() {
                lbIndex = (lbIndex + 1) % lbImages.length;
                updateLightbox();
            });
            document.addEventListener('keydown', function(e) {
                if (document.getElementById('lightbox').classList.contains('hidden')) return;
                if (e.key === 'Escape')      closeLightbox();
                if (e.key === 'ArrowLeft')  { lbIndex = (lbIndex - 1 + lbImages.length) % lbImages.length; updateLightbox(); }
                if (e.key === 'ArrowRight') { lbIndex = (lbIndex + 1) % lbImages.length; updateLightbox(); }
            });
        }

        // ── Load & Display ──
        const loadGaleri = function(pageNumber) {
            $.ajax({
                url: routeGaleri + '?sort=-tgl_upload&page[number]=' + pageNumber + '&page[size]=' + pageSizes,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    document.getElementById('galeri-list').innerHTML =
                        '<div class="text-center py-12"><i class="fas fa-spinner fa-pulse text-3xl text-primary"></i><p class="text-gray-500 mt-2">Memuat galeri...</p></div>';
                },
                success: function(data) {
                    displayGaleri(data);
                    initPagination(data);
                }
            });
        };

        const displayGaleri = function(dataGaleri) {
            var galeriList = document.getElementById('galeri-list');
            galeriList.innerHTML = '';
            lbImages = [];

            if (!dataGaleri.data || !dataGaleri.data.length) {
                galeriList.innerHTML =
                    '<div class="text-center py-12"><i class="fas fa-images text-gray-300 text-5xl mb-3"></i><p class="text-gray-500">Belum ada galeri foto</p></div>';
                return;
            }

            var grid = document.createElement('div');
            grid.className = 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4';

            dataGaleri.data.forEach(function(item, index) {
                var card = document.createElement('a');
                card.className = 'group block no-underline cursor-pointer';

                if (isDetail) {
                    // Foto dalam album → buka lightbox
                    if (item.attributes.src_gambar) {
                        lbImages.push({ src: item.attributes.src_gambar, caption: item.attributes.nama });
                    }
                    var imgIndex = lbImages.length - 1;
                    card.href = '#';
                    card.addEventListener('click', (function(i) {
                        return function(e) { e.preventDefault(); openLightbox(i); };
                    })(imgIndex));
                } else {
                    // Daftar album → navigasi ke halaman album
                    card.href = item.attributes.url_detail;
                }

                var image = item.attributes.src_gambar
                    ? '<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" src="' + item.attributes.src_gambar + '" alt="' + item.attributes.nama + '">'
                    : '<div class="w-full h-full bg-gray-200 flex items-center justify-center"><i class="fas fa-images text-gray-400 text-3xl"></i></div>';

                var icon = isDetail ? 'fa-search-plus' : 'fa-folder-open';
                card.innerHTML =
                    '<div class="relative overflow-hidden rounded-lg aspect-square">' +
                        image +
                        '<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">' +
                            '<i class="fas ' + icon + ' text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>' +
                        '</div>' +
                    '</div>' +
                    '<h4 class="mt-2 font-semibold text-gray-800 text-sm group-hover:text-primary transition-colors text-center truncate">' + item.attributes.nama + '</h4>';

                grid.appendChild(card);
            });

            galeriList.appendChild(grid);
        };

        $('.pagination').on('click', '.btn-page', function() {
            loadGaleri($(this).data('page'));
        });

        loadGaleri(1);
    });
</script>
@endpush
