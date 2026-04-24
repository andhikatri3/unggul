@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-map-marked-alt text-primary/50 text-xs"></i>
</div>

<div class="p-5">
    <div id="map_canvas" class="rounded-xl overflow-hidden border border-gray-100" style="height: 200px; isolation: isolate;"></div>

    <div class="flex gap-2 mt-3">
        <a href="https://www.openstreetmap.org/#map=15/{{ $desa['lat'] }}/{{ $desa['lng'] }}" rel="noopener noreferrer" target="_blank"
           class="flex-1 flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-semibold transition-colors no-underline">
            <i class="fas fa-external-link-alt text-xs"></i> Buka Peta
        </a>
        <button onclick="document.getElementById('map-detail').classList.toggle('hidden')"
            class="flex items-center justify-center gap-1.5 px-4 py-2.5 border border-gray-200 hover:border-primary hover:text-primary text-gray-600 rounded-lg text-sm font-semibold transition-colors">
            <i class="fas fa-info-circle text-xs"></i> Detail
        </button>
    </div>

    <div id="map-detail" class="hidden mt-4 pt-4 border-t border-gray-100">
        @if (is_file(FCPATH . LOKASI_LOGO_DESA . $desa['kantor_desa']))
            <img class="w-full rounded-xl mb-4 object-cover h-32" src="{{ gambar_desa($desa['kantor_desa'], true) }}" alt="Kantor Desa">
        @endif
        <div class="space-y-2">
            @foreach ([
                ['label' => 'Alamat',                                       'value' => $desa['alamat_kantor']],
                ['label' => ucwords(setting('sebutan_desa')),               'value' => $desa['nama_desa']],
                ['label' => ucwords(setting('sebutan_kecamatan')),          'value' => $desa['nama_kecamatan']],
                ['label' => ucwords(setting('sebutan_kabupaten')),          'value' => $desa['nama_kabupaten']],
                ['label' => 'Kodepos',                                      'value' => $desa['kode_pos']],
                ['label' => 'Telepon',                                      'value' => $desa['telepon']],
                ['label' => 'Email',                                        'value' => $desa['email_desa']],
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

<script>
    @if (!empty($desa['lat']) && !empty($desa['lng']))
        var posisi = [{{ $desa['lat'] }}, {{ $desa['lng'] }}];
        var zoom = {{ $desa['zoom'] ?: 10 }};
    @else
        var posisi = [-1.0546279422758742, 116.71875000000001];
        var zoom = 10;
    @endif

    var options = {
        maxZoom: {{ setting('max_zoom_peta') }},
        minZoom: {{ setting('min_zoom_peta') }},
    };

    var lokasi_kantor = L.map('map_canvas', options).setView(posisi, zoom);
    var baseLayers = getBaseLayers(lokasi_kantor, "{{ setting('mapbox_key') }}", "{{ setting('jenis_peta') }}");
    L.control.layers(baseLayers, null, { position: 'topright', collapsed: true }).addTo(lokasi_kantor);

    @if (!empty($desa['lat']) && !empty($desa['lng']))
        var kantor_desa = L.marker(posisi).addTo(lokasi_kantor);
    @endif
</script>
