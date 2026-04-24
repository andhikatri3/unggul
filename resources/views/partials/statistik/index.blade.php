@extends('theme::layouts.statistik-sidebar')
@include('theme::commons.asset_highcharts')

@push('styles')
<style>
    tr.lebih { display: none; }
    .angka { text-align: right; }
    #container { min-height: 350px; }
</style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="{{ site_url() }}" class="hover:text-primary no-underline text-gray-500">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-gray-800">Statistik</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-primary">{{ $judul }}</h2>

        <!-- Filter Tahun -->
        @if (isset($list_tahun))
        <div class="flex items-center gap-3 mb-6">
            <label class="text-sm font-medium text-gray-700">Tahun:</label>
            <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary" id="tahun" name="tahun">
                <option selected value="">Semua</option>
                @foreach ($list_tahun as $item_tahun)
                    <option @selected($item_tahun == ($selected_tahun ?? null)) value="{{ $item_tahun }}">{{ $item_tahun }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <!-- Toolbar -->
        <div class="grid grid-cols-2 md:flex md:flex-wrap gap-2 mb-6">
            <button class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold transition-colors {{ ($default_chart_type ?? 'pie') == 'pie' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700' }}" onclick="switchType(this);">
                <i class="fas fa-chart-bar"></i> Bar
            </button>
            <button class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold transition-colors {{ ($default_chart_type ?? 'pie') == 'column' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700' }}" onclick="switchType(this);">
                <i class="fas fa-chart-pie"></i> Pie
            </button>
            <a href="{{ ci_route("data-statistik.{$slug_aktif}.cetak.cetak") }}?tahun={{ $selected_tahun }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold bg-primary text-white hover:bg-primary-dark transition-colors no-underline" target="_blank">
                <i class="fas fa-print"></i> Cetak
            </a>
            <a href="{{ ci_route("data-statistik.{$slug_aktif}.cetak.unduh") }}?tahun={{ $selected_tahun }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold bg-green-500 text-white hover:bg-green-600 transition-colors no-underline" target="_blank">
                <i class="fas fa-download"></i> Unduh
            </a>
        </div>

        <!-- Chart -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div id="container"></div>
            <div id="contentpane"><div class="ui-layout-north panel top"></div></div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b-2 border-primary">Tabel {{ $heading }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="table-statistik">
                <thead>
                    <tr class="bg-gray-100">
                        <th rowspan="2" class="px-3 py-2 text-center border border-gray-200 align-middle">Kode</th>
                        <th rowspan="2" class="px-3 py-2 text-left border border-gray-200 align-middle">Kelompok</th>
                        <th colspan="2" class="px-3 py-2 text-center border border-gray-200">Jumlah</th>
                        <th colspan="2" class="px-3 py-2 text-center border border-gray-200">Laki-laki</th>
                        <th colspan="2" class="px-3 py-2 text-center border border-gray-200">Perempuan</th>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="px-3 py-2 text-center border border-gray-200">Jiwa</th>
                        <th class="px-3 py-2 text-center border border-gray-200">%</th>
                        <th class="px-3 py-2 text-center border border-gray-200">Jiwa</th>
                        <th class="px-3 py-2 text-center border border-gray-200">%</th>
                        <th class="px-3 py-2 text-center border border-gray-200">Jiwa</th>
                        <th class="px-3 py-2 text-center border border-gray-200">%</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <p class="text-xs text-red-500 mt-3">Diperbarui pada : {{ tgl_indo($last_update) }}</p>
        <div class="grid grid-cols-2 md:flex md:justify-between gap-2 mt-3">
            <button class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold bg-gray-100 hover:bg-gray-200 text-primary transition-colors" id="showData">
                <i class="fas fa-chevron-down text-xs"></i> Selengkapnya
            </button>
            <button id="tampilkan" onclick="toggle_tampilkan();" class="flex items-center justify-center gap-1.5 px-4 py-2 text-sm rounded-lg font-semibold bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-primary transition-colors">
                <i class="fas fa-eye text-xs"></i> Tampilkan Nol
            </button>
        </div>
    </div>

    <!-- Daftar Penerima Bantuan -->
    @if (setting('daftar_penerima_bantuan') && $bantuan)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <input id="stat" type="hidden" value="{{ $key }}">
        <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b-2 border-primary">Daftar {{ $heading }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="peserta_program">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-3 py-2 border border-gray-200">No</th>
                        <th class="px-3 py-2 border border-gray-200">Program</th>
                        <th class="px-3 py-2 border border-gray-200">Nama Peserta</th>
                        <th class="px-3 py-2 border border-gray-200">Alamat</th>
                    </tr>
                </thead>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tahun').change(function() {
                const current_url = window.location.href.split('?')[0];
                window.location.href = `${current_url}?tahun=${$(this).val()}`;
            });
            const bantuanUrl = '{{ ci_route('internal_api.peserta_bantuan', $key) }}?filter[tahun]={{ $selected_tahun ?? '' }}';
            let pesertaDatatable = $('#peserta_program').DataTable({
                processing: true, serverSide: true, order: [],
                ajax: {
                    url: bantuanUrl, type: 'GET',
                    data: function(row) {
                        return { "page[size]": row.length, "page[number]": (row.start / row.length) + 1, "filter[search]": row.search.value, "sort": (row.order[0]?.dir === "asc" ? "" : "-") + row.columns[row.order[0]?.column]?.name };
                    },
                    dataSrc: function(json) { json.recordsTotal = json.meta.pagination.total; json.recordsFiltered = json.meta.pagination.total; return json.data; },
                },
                columns: [{ data: null }, { data: 'attributes.nama', name: 'nama' }, { data: 'attributes.kartu_nama', name: 'kartu_nama' }, { data: 'attributes.kartu_alamat', name: 'kartu_alamat', orderable: false, searchable: false }],
                order: [1, 'asc'],
                language: { url: "".concat(BASE_URL, "/assets/bootstrap/js/dataTables.indonesian.lang") },
                drawCallback: function() { $('.dataTables_paginate > .pagination').addClass('pagination-sm no-margin'); }
            });
            pesertaDatatable.on('draw.dt', function() {
                var PageInfo = $('#peserta_program').DataTable().page.info();
                pesertaDatatable.column(0, { page: 'current' }).nodes().each(function(cell, i) { cell.innerHTML = i + 1 + PageInfo.start; });
            });
        });
    </script>
    @endpush
    @endif

    @push('scripts')
    <script type="text/javascript">
        let chart;
        const type = '{{ $default_chart_type ?? 'pie' }}';
        const legend = Boolean({{ (bool) $tipe }});
        let i = 1;
        let status_tampilkan = true;

        function tampilkan_nol(tampilkan = false) { if (tampilkan) { $(".nol").parent().show(); } else { $(".nol").parent().hide(); } }
        function toggle_tampilkan() { $('#showData').click(); tampilkan_nol(status_tampilkan); status_tampilkan = !status_tampilkan; if (status_tampilkan) $('#tampilkan').text('Tampilkan Nol'); else $('#tampilkan').text('Sembunyikan Nol'); }

        function switchType(obj) {
            var chartType = chart_penduduk.series[0].type;
            chart_penduduk.series[0].update({ type: (chartType === 'pie') ? 'column' : 'pie' });
            $(obj).toggleClass('bg-primary text-white bg-gray-200 text-gray-700');
            $(obj).siblings('button').each(function() { $(this).toggleClass('bg-primary text-white bg-gray-200 text-gray-700'); });
        }

        $(document).ready(function() {
            var chartOpts = {
                chart: { renderTo: 'container' },
                title: 0,
                yAxis: { showEmpty: false },
                xAxis: { categories: [] },
                plotOptions: {
                    series: { colorByPoint: true },
                    column: { pointPadding: -0.1, borderWidth: 0, showInLegend: false },
                    pie: { allowPointSelect: true, cursor: 'pointer', showInLegend: true }
                },
                legend: { enabled: legend },
                series: [{ type: type, name: 'Jumlah Populasi', shadow: 1, border: 1, data: [] }]
            };

            if ({{ setting('statistik_chart_3d') }}) {
                chartOpts.chart.options3d = { enabled: true, alpha: 45 };
                chartOpts.plotOptions.column.depth = 45;
                chartOpts.plotOptions.pie.depth = 45;
                chartOpts.plotOptions.pie.innerSize = 70;
            }

            chart_penduduk = new Highcharts.Chart(chartOpts);

            $('#showData').click(function() { $('tr.lebih').show(); $('#showData').hide(); tampilkan_nol(false); });

            $.ajax({
                url: `{{ ci_route('internal_api.statistik', $key) }}?tahun={{ $selected_tahun ?? '' }}`,
                method: 'get',
                beforeSend: function() { $('#showData').hide(); },
                success: function(json) {
                    var dataStats = json.data.map(function(item) {
                        return { id: item.id, nama: item.attributes.nama, jumlah: item.attributes.jumlah, persen: item.attributes.persen, laki: item.attributes.laki, persen1: item.attributes.persen1, perempuan: item.attributes.perempuan, persen2: item.attributes.persen2 };
                    });

                    var tbody = document.querySelector('#table-statistik tbody');
                    var _showBtn = false;
                    var categories = [], data = [];

                    dataStats.forEach(function(item, index) {
                        var row = document.createElement('tr');
                        row.className = (index % 2 === 0) ? 'bg-white' : 'bg-gray-50';
                        if (index > 11 && !['666','777','888'].includes(item.id)) { row.className += ' lebih'; _showBtn = true; }

                        for (var key in item) {
                            var cell = document.createElement('td');
                            cell.className = 'px-3 py-2 border border-gray-200';
                            var text = item[key];
                            if (key == 'id') { text = ['666','777','888'].includes(item[key]) ? '' : (index + 1); }
                            else if (key != 'nama') { cell.className += ' text-right'; }
                            if (key == 'jumlah' && item[key] <= 0 && !['666','777','888'].includes(item.id)) { cell.className += ' nol'; }
                            cell.textContent = text;
                            row.appendChild(cell);
                        }
                        tbody.appendChild(row);
                    });

                    tampilkan_nol(false);
                    if (_showBtn) $('#showData').show();

                    dataStats.forEach(function(stat) {
                        if (stat.nama !== 'TOTAL' && stat.nama !== 'JUMLAH' && stat.nama != 'PENERIMA') {
                            categories.push(i);
                            data.push([stat.nama, parseInt(stat.jumlah)]);
                            i++;
                        }
                    });

                    chart_penduduk.xAxis[0].update({ categories: categories });
                    chart_penduduk.series[0].setData(data);
                }
            });
        });
    </script>
    @endpush
@endsection
