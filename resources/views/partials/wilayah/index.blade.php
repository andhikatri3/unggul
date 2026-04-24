@extends('theme::layouts.statistik-sidebar')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="{{ site_url() }}" class="hover:text-primary no-underline text-gray-500">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-gray-800">Data Wilayah</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-primary">{{ $heading }}</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="tabelData">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-3 py-2 text-center border border-gray-200">No</th>
                        <th colspan="8" class="px-3 py-2 text-left border border-gray-200">Wilayah / Ketua</th>
                        <th class="px-3 py-2 text-center border border-gray-200">KK</th>
                        <th class="px-3 py-2 text-center border border-gray-200">L+P</th>
                        <th class="px-3 py-2 text-center border border-gray-200">L</th>
                        <th class="px-3 py-2 text-center border border-gray-200">P</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var tabelData = $('#tabelData');
        var wilayahHTML = '';

        function loadWilayah() {
            var apiWilayah = '{{ route('api.wilayah.administratif') }}';

            tabelData.find('tbody').html('<tr><td colspan="13" class="text-center py-8 text-gray-500"><i class="fas fa-spinner fa-pulse text-2xl text-primary"></i><br>Memuat data...</td></tr>');

            $.get(apiWilayah, function(response) {
                var wilayah = response.data;
                tabelData.find('tbody').empty();
                tabelData.find('tfoot').empty();

                if (!wilayah.length) {
                    tabelData.find('tbody').append('<tr><td colspan="13" class="text-center py-8 text-gray-500">Tidak ada data wilayah yang tersedia</td></tr>');
                    return;
                }

                loadDusun(wilayah);
            });
        }

        function loadDusun(data) {
            let no = 1;
            let totalKK = 0, totalPriaWanita = 0, totalPria = 0, totalWanita = 0;

            data.forEach(function(item) {
                var cls = (no % 2 === 0) ? 'bg-gray-50' : 'bg-white';
                var row = `<tr class="${cls} font-semibold">
                    <td class="px-3 py-2 text-center border border-gray-200">${no}</td>
                    <td colspan="8" class="px-3 py-2 border border-gray-200">${item.attributes.sebutan_dusun + ' ' + item.attributes.dusun + item.attributes.kepala_nama}</td>
                    <td class="px-3 py-2 text-right border border-gray-200">${item.attributes.keluarga_aktif_count}</td>
                    <td class="px-3 py-2 text-right border border-gray-200">${item.attributes.penduduk_pria_wanita_count}</td>
                    <td class="px-3 py-2 text-right border border-gray-200">${item.attributes.penduduk_pria_count}</td>
                    <td class="px-3 py-2 text-right border border-gray-200">${item.attributes.penduduk_wanita_count}</td>
                </tr>`;

                wilayahHTML += row;
                totalKK += item.attributes.keluarga_aktif_count;
                totalPriaWanita += item.attributes.penduduk_pria_wanita_count;
                totalPria += item.attributes.penduduk_pria_count;
                totalWanita += item.attributes.penduduk_wanita_count;
                no++;

                loadRW(item.attributes.rws);
            });

            tabelData.find('tbody').append(wilayahHTML);

            var tfoot = `<tr class="bg-primary text-white font-bold">
                <td class="px-3 py-2 text-center border border-gray-200" colspan="9">TOTAL</td>
                <td class="px-3 py-2 text-right border border-gray-200">${totalKK}</td>
                <td class="px-3 py-2 text-right border border-gray-200">${totalPria + totalWanita}</td>
                <td class="px-3 py-2 text-right border border-gray-200">${totalPria}</td>
                <td class="px-3 py-2 text-right border border-gray-200">${totalWanita}</td>
            </tr>`;
            tabelData.find('tbody').after(tfoot);
        }

        function loadRW(data) {
            let no = 1;
            data.forEach(function(item) {
                if (item.rw !== '-') {
                    var row = `<tr class="bg-blue-50/50">
                        <td class="px-3 py-1.5 border border-gray-200"></td>
                        <td class="px-3 py-1.5 text-center border border-gray-200 text-gray-600">${no}</td>
                        <td colspan="7" class="px-3 py-1.5 border border-gray-200 text-gray-700">${item.sebutan_rw + ' ' + item.rw + item.kepala_nama}</td>
                        <td class="px-3 py-1.5 text-right border border-gray-200 text-gray-600">${item.keluarga_aktif_count}</td>
                        <td class="px-3 py-1.5 text-right border border-gray-200 text-gray-600">${item.penduduk_pria_wanita_count}</td>
                        <td class="px-3 py-1.5 text-right border border-gray-200 text-gray-600">${item.penduduk_pria_count}</td>
                        <td class="px-3 py-1.5 text-right border border-gray-200 text-gray-600">${item.penduduk_wanita_count}</td>
                    </tr>`;
                    wilayahHTML += row;
                    no++;
                }
                loadRT(item.rw, item.rts);
            });
        }

        function loadRT(rw, data) {
            let no = 1;
            data.forEach(function(item) {
                if (rw == item.rw && item.rt !== '-') {
                    var row = `<tr>
                        <td class="px-3 py-1 border border-gray-200"></td>
                        <td class="px-3 py-1 border border-gray-200"></td>
                        <td class="px-3 py-1 text-center border border-gray-200 text-gray-500">${no}</td>
                        <td colspan="6" class="px-3 py-1 border border-gray-200 text-gray-600 text-sm">${item.sebutan_rt + ' ' + item.rt + item.kepala_nama}</td>
                        <td class="px-3 py-1 text-right border border-gray-200 text-gray-500">${item.keluarga_aktif_count}</td>
                        <td class="px-3 py-1 text-right border border-gray-200 text-gray-500">${item.penduduk_pria_wanita_count}</td>
                        <td class="px-3 py-1 text-right border border-gray-200 text-gray-500">${item.penduduk_pria_count}</td>
                        <td class="px-3 py-1 text-right border border-gray-200 text-gray-500">${item.penduduk_wanita_count}</td>
                    </tr>`;
                    wilayahHTML += row;
                    no++;
                }
            });
        }

        loadWilayah();
    });
</script>
@endpush
