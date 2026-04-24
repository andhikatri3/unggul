@extends('theme::layouts.' . $layout)

@push('styles')
<style>
    /* ── TinyMCE content styling ── */
    .article-content { line-height: 1.8; color: #374151; }

    /* Headings */
    .article-content h1,.article-content h2,.article-content h3,
    .article-content h4,.article-content h5,.article-content h6 {
        font-weight: 700; color: #111827; margin-top: 1.5em; margin-bottom: 0.5em; line-height: 1.3;
    }
    .article-content h1 { font-size: 1.75rem; }
    .article-content h2 { font-size: 1.5rem; }
    .article-content h3 { font-size: 1.25rem; }
    .article-content h4 { font-size: 1.1rem; }
    .article-content h5,.article-content h6 { font-size: 1rem; }

    /* Paragraphs & inline */
    .article-content p   { margin-bottom: 1em; }
    .article-content b, .article-content strong { font-weight: 700; }
    .article-content i, .article-content em     { font-style: italic; }
    .article-content u   { text-decoration: underline; }
    .article-content s   { text-decoration: line-through; }
    .article-content a   { color: var(--color-primary); text-decoration: underline; }
    .article-content a:hover { opacity: 0.8; }
    .article-content hr  { border: 0; border-top: 1px solid #e5e7eb; margin: 1.5em 0; }
    .article-content sub { vertical-align: sub; font-size: smaller; }
    .article-content sup { vertical-align: super; font-size: smaller; }

    /* Lists */
    .article-content ul { list-style: disc; padding-left: 1.5em; margin-bottom: 1em; }
    .article-content ol { list-style: decimal; padding-left: 1.5em; margin-bottom: 1em; }
    .article-content li { margin-bottom: 0.25em; }
    .article-content ul ul, .article-content ol ol,
    .article-content ul ol, .article-content ol ul { margin-top: 0.25em; margin-bottom: 0.25em; }

    /* Blockquote */
    .article-content blockquote {
        border-left: 4px solid var(--color-primary);
        background: #f9fafb; margin: 1.5em 0;
        padding: 0.75em 1.25em; border-radius: 0 0.5rem 0.5rem 0;
        color: #6b7280; font-style: italic;
    }

    /* Code */
    .article-content pre {
        background: #1f2937; color: #f3f4f6; padding: 1em 1.25em;
        border-radius: 0.5rem; overflow-x: auto; margin-bottom: 1em; font-size: 0.9em;
    }
    .article-content code {
        background: #f3f4f6; color: #dc2626; padding: 0.15em 0.4em;
        border-radius: 0.25rem; font-size: 0.875em; font-family: monospace;
    }
    .article-content pre code { background: none; color: inherit; padding: 0; }

    /* Images */
    .article-content img { max-width: 100%; height: auto; border-radius: 0.5rem; }
    .article-content img[style*="float:left"],  .article-content img[style*="float: left"]  { float: left;  margin: 0 1.25rem 1rem 0; }
    .article-content img[style*="float:right"], .article-content img[style*="float: right"] { float: right; margin: 0 0 1rem 1.25rem; }
    .article-content figure { margin: 1.5em 0; text-align: center; }
    .article-content figcaption { font-size: 0.85em; color: #9ca3af; margin-top: 0.4em; }
    .article-content::after { content: ""; display: table; clear: both; }

    /* Tables — native & Bootstrap classes dari TinyMCE */
    .article-content table { width: 100%; border-collapse: collapse; margin: 1.25em 0; font-size: 0.9em; }
    .article-content th { background: #f3f4f6; font-weight: 600; text-align: left; }
    .article-content td, .article-content th { padding: 0.6em 0.8em; vertical-align: top; }
    .article-content .table td, .article-content .table th { padding: 0.6em 0.8em; }
    .article-content .table-bordered,
    .article-content .table-bordered td,
    .article-content .table-bordered th { border: 1px solid #d1d5db; }
    .article-content table:not(.table-borderless) td,
    .article-content table:not(.table-borderless) th { border: 1px solid #e5e7eb; }
    .article-content .table-striped tbody tr:nth-child(odd) { background: #f9fafb; }
    .article-content .table-hover tbody tr:hover  { background: #f0fdf4; }
    .article-content .table-responsive { overflow-x: auto; }

    /* Text alignment (TinyMCE output) */
    .article-content .text-left   { text-align: left; }
    .article-content .text-center { text-align: center; }
    .article-content .text-right  { text-align: right; }
    .article-content .text-justify{ text-align: justify; }

    /* Responsive iframe/video embed */
    .article-content iframe, .article-content video {
        max-width: 100%; border-radius: 0.5rem; margin: 0.75em 0;
    }

    @media (max-width: 640px) {
        .article-content img[style*="float"] { float: none !important; margin: 0 0 1rem 0 !important; width: 100% !important; }
        .article-content table { display: block; overflow-x: auto; }
    }
</style>
@endpush

@section('content')
    @if ($single_artikel['id'])
        @include('theme::commons.asset_highcharts')
        <div class="bg-white rounded-lg shadow-md p-6 mb-6" id="{{ 'artikel-' . $single_artikel['judul'] }}">
            <!-- Breadcrumb -->
            <div class="text-sm text-gray-500 mb-4">
                <a href="{{ site_url() }}" class="hover:text-primary">Beranda</a>
                <span class="mx-1">/</span>
                <span>Artikel</span>
            </div>

            <div id="printableArea">
                <!-- Title -->
                <h1 class="text-2xl font-bold text-gray-800 mb-3">{{ $single_artikel['judul'] }}</h1>

                <!-- Meta -->
                <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4 gap-x-4 gap-y-1 pb-4 border-b">
                    <span><i class="fas fa-calendar mr-1"></i>{{ $single_artikel['tgl_upload_local'] }}</span>
                    <span><i class="fas fa-user mr-1"></i>{{ $single_artikel['owner'] }}</span>
                    <span><i class="fas fa-eye mr-1"></i>{{ hit($single_artikel['hit']) }} Dibaca</span>
                    @if (trim($single_artikel['kategori']) != '')
                        <a href="{{ ci_route('artikel/kategori/' . $single_artikel['kat_slug']) }}" class="text-primary hover:text-primary-dark no-underline">
                            <i class="fas fa-tag mr-1"></i>{{ $single_artikel['kategori'] }}
                        </a>
                    @endif
                </div>

                <!-- FB Like -->
                <div class="mb-4">
                    <div class="fb-like" data-href="{{ $single_artikel['url_slug'] }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                </div>

                <!-- Agenda Info -->
                @if ($single_artikel['tipe'] == 'agenda')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-lg p-4 flex items-center space-x-3">
                        <i class="fas fa-calendar text-blue-500 text-xl"></i>
                        <div>
                            <p class="text-xs text-gray-500">Tanggal & Jam</p>
                            <p class="font-semibold text-gray-800 text-sm">{{ tgl_indo2($detail_agenda['tgl_agenda']) }}</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 flex items-center space-x-3">
                        <i class="fas fa-map-marker-alt text-green-500 text-xl"></i>
                        <div>
                            <p class="text-xs text-gray-500">Lokasi</p>
                            <p class="font-semibold text-gray-800 text-sm">{{ $detail_agenda['lokasi_kegiatan'] }}</p>
                        </div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 flex items-center space-x-3">
                        <i class="fas fa-bullhorn text-red-500 text-xl"></i>
                        <div>
                            <p class="text-xs text-gray-500">Koordinator</p>
                            <p class="font-semibold text-gray-800 text-sm">{{ $detail_agenda['koordinator_kegiatan'] }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Featured Image -->
                @if ($single_artikel['gambar'] != '' && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel['gambar']))
                    <div class="mb-4">
                        <a data-fancybox="gallery" href="{{ AmbilFotoArtikel($single_artikel['gambar'], 'sedang') }}">
                            <img src="{{ AmbilFotoArtikel($single_artikel['gambar'], 'sedang') }}" class="w-full rounded-lg" alt="{{ $single_artikel['judul'] }}" />
                        </a>
                    </div>
                @endif

                <!-- Content -->
                <div class="article-content">
                    {!! $single_artikel['isi'] !!}
                </div>

                <!-- Attachment -->
                @if ($single_artikel['dokumen'] != '' && is_file(LOKASI_DOKUMEN . $single_artikel['dokumen']))
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="font-semibold text-gray-700">Unduh Lampiran:</p>
                        <a href='{{ ci_route("first.unduh_dokumen_artikel", $single_artikel["id"]) }}' class="text-primary hover:text-primary-dark">
                            <i class="fas fa-download mr-1"></i>{{ $single_artikel['link_dokumen'] }}
                        </a>
                    </div>
                @endif

                <!-- Additional Images -->
                @php
                    $extra_imgs = array_filter(['gambar1','gambar2','gambar3'], fn($k) =>
                        !empty($single_artikel[$k]) && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $single_artikel[$k])
                    );
                    $jml = count($extra_imgs);
                @endphp
                @if ($jml > 0)
                <div class="{{ $jml === 3 ? 'grid grid-cols-3 gap-2' : 'flex justify-center gap-3' }} mt-5" style="clear: both;">
                    @foreach ($extra_imgs as $img)
                        <a data-fancybox="gallery" href="{{ AmbilFotoArtikel($single_artikel[$img], 'sedang') }}"
                           class="{{ $jml === 3 ? 'block' : '' }}">
                            <img src="{{ AmbilFotoArtikel($single_artikel[$img], 'sedang') }}"
                                 class="w-full aspect-video object-cover rounded-lg hover:opacity-90 transition-opacity" alt="" />
                        </a>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Share Buttons -->
            @php
                $share = [
                    'link' => $single_artikel['url_slug'],
                    'judul' => htmlspecialchars($single_artikel['judul']),
                ];
            @endphp
            <div class="mt-6 pt-4 border-t">
                @include('theme::commons.share', $share)
            </div>
        </div>

        <!-- Custom Comments -->
        @if (!empty($komentar))
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Komentar</h3>
            <div class="space-y-4">
                @foreach ($komentar as $data)
                    <div class="border rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-800"><i class="fas fa-comment text-primary mr-1"></i>{{ $data['pengguna']['nama'] }}</span>
                            <span class="text-xs text-gray-500">{{ tgl_indo2($data['tgl_upload']) }}</span>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $data['komentar'] }}</p>

                        @if (count($data['children']) > 0)
                            <div class="ml-6 mt-3 space-y-3">
                                @foreach ($data['children'] as $children)
                                    <div class="border-l-2 border-primary pl-4 py-2">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="font-semibold text-gray-800 text-sm">
                                                <i class="fas fa-reply text-primary mr-1"></i>{{ $children['pengguna']['nama'] }}
                                                <code class="text-xs text-gray-500 ml-1">({{ $children['pengguna']['level'] }})</code>
                                            </span>
                                            <span class="text-xs text-gray-500">{{ tgl_indo2($children['tgl_upload']) }}</span>
                                        </div>
                                        <p class="text-gray-700 text-sm">{{ $children['komentar'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Comment Form -->
        @include('theme::partials.artikel.comment')
    @else
        @include('theme::commons.not_found')
    @endif
@endsection
