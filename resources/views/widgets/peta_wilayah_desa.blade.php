@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-map text-primary/50 text-xs"></i>
</div>

<div class="p-5">
    <div id="map_wilayah" class="rounded-xl overflow-hidden border border-gray-100" style="height: 200px; isolation: isolate;"></div>

    <a href="https://www.openstreetmap.org/#map=15/{{ $desa['lat'] . '/' . $desa['lng'] }}" rel="noopener noreferrer" target="_blank"
       class="flex items-center justify-center gap-2 w-full mt-3 bg-primary hover:bg-primary-dark text-white py-2.5 rounded-lg text-sm font-semibold transition-colors no-underline">
        <i class="fas fa-external-link-alt text-xs"></i> Buka Peta
    </a>
</div>

<script>
    @if (!empty($desa['lat']) && !empty($desa['lng']))
        var posisi_wil = [{{ $desa['lat'] }}, {{ $desa['lng'] }}];
        var zoom_wil = {{ $desa['zoom'] ?: 10 }};
    @else
        var posisi_wil = [-1.0546279422758742, 116.71875000000001];
        var zoom_wil = 10;
    @endif

    var options_wil = {
        maxZoom: {{ setting('max_zoom_peta') }},
        minZoom: {{ setting('min_zoom_peta') }},
    };

    var style_polygon = {
        stroke: true, color: '#FF0000', opacity: 1, weight: 2,
        fillColor: '#8888dd', fillOpacity: 0.5
    };

    var wilayah_desa = L.map('map_wilayah', options_wil).setView(posisi_wil, zoom_wil);
    var baseLayers_wil = getBaseLayers(wilayah_desa, "{{ setting('mapbox_key') }}", "{{ setting('jenis_peta') }}");
    L.control.layers(baseLayers_wil, null, { position: 'topright', collapsed: true }).addTo(wilayah_desa);

    @if (!empty($desa['path']))
        var polygon_desa = {!! $desa['path'] !!};
        var kantor_desa_wil = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah Desa").addTo(wilayah_desa);
        wilayah_desa.fitBounds(kantor_desa_wil.getBounds());
    @endif
</script>
