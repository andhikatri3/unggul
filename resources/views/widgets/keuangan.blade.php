@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if (!empty($widget_keuangan['tahun']) && null !== $widget_keuangan['tahun'])
    @include('theme::commons.asset_highcharts')

    <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
        <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
        <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
        <div class="relative" id="keuangan-dropdown-wrapper">
            <button onclick="toggleKeuanganDropdown()"
                class="w-7 h-7 flex flex-col items-center justify-center gap-1 rounded-lg border border-gray-200 hover:border-primary hover:bg-primary/5 transition-colors bg-white">
                <span class="block w-3.5 h-0.5 bg-gray-500 rounded"></span>
                <span class="block w-3.5 h-0.5 bg-gray-500 rounded"></span>
                <span class="block w-3.5 h-0.5 bg-gray-500 rounded"></span>
            </button>
            <div id="keuangan-dropdown"
                class="hidden absolute right-0 top-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg z-10 min-w-[190px] py-1 overflow-hidden">
                @foreach ($widget_keuangan['tahun'] as $key)
                    <p class="px-4 pt-2.5 pb-1 text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $key }}</p>
                    <button onclick="gantiTipe('pelaksanaan'); gantiTahun('{{ $key }}'); closeKeuanganDropdown()"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
                        Pelaksanaan APBDes
                    </button>
                    <button onclick="gantiTipe('pendapatan'); gantiTahun('{{ $key }}'); closeKeuanganDropdown()"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
                        Pendapatan APBDes
                    </button>
                    <button onclick="gantiTipe('belanja'); gantiTahun('{{ $key }}'); closeKeuanganDropdown()"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
                        Belanja APBDes
                    </button>
                    @if (!$loop->last)<div class="border-t border-gray-100 my-1"></div>@endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="p-5">
        <div class="mb-3">
            <p id="grafik-judul" class="text-sm font-semibold text-gray-700"></p>
            <p id="grafik-tahun" class="text-xs text-gray-400"></p>
        </div>
        <div id="grafik-container" class="overflow-y-auto overflow-x-auto max-h-96 pb-4"></div>
    </div>

    <style>
        .graph, .graph-sub { padding: 0 4px; padding-top: 4px; }
        .graph-sub { font-family: 'Courier New', monospace; font-size: 10px; color: #374151; font-weight: bold; white-space: nowrap; }
        .graph-not-available { text-align: center; font-size: 11px; color: #9ca3af; }
        .highcharts-container, svg:not(:root) { overflow: visible !important; position: absolute; }
        .highcharts-tooltip > span { background: rgba(255,255,255,.9); border: 1px solid #e5e7eb; border-radius: 4px; padding: 6px 8px; }
    </style>

    <script type="text/javascript">
        var rawData = {!! $widget_keuangan['data'] !!};
        var year    = "{{ $widget_keuangan['tahun_terbaru'] }}";
        var tipe    = "pelaksanaan";

        function toggleKeuanganDropdown() {
            document.getElementById('keuangan-dropdown').classList.toggle('hidden');
        }
        function closeKeuanganDropdown() {
            document.getElementById('keuangan-dropdown').classList.add('hidden');
        }
        document.addEventListener('click', function(e) {
            var wrapper = document.getElementById('keuangan-dropdown-wrapper');
            if (wrapper && !wrapper.contains(e.target)) closeKeuanganDropdown();
        });

        function displayChart(tahun, tipeChart) {
            resetContainer();
            var labels = { pelaksanaan: 'Pelaksanaan APBDes', pendapatan: 'Pendapatan APBDes', belanja: 'Belanja APBDes' };
            var types  = { pelaksanaan: 'res_pelaksanaan', pendapatan: 'res_pendapatan', belanja: 'res_belanja' };
            var chartData = rawData[tahun][types[tipeChart]];
            document.getElementById('grafik-judul').textContent = labels[tipeChart];
            document.getElementById('grafik-tahun').textContent = 'Tahun ' + tahun;

            $('#grafik-container').append("<div id='graph-legend' class='graph'></div>");
            Highcharts.chart('graph-legend', {
                chart: { type:'bar', margin:0, backgroundColor:'rgba(0,0,0,0)', spacing:[0,0,0,0], height:20 },
                title: { text:'' }, subtitle: { text:'' },
                xAxis: { visible:false, categories:[''] },
                tooltip: { valueSuffix:'' },
                plotOptions: { bar:{ dataLabels:{ enabled:true } }, series:{ pointPadding:0, groupPadding:0, dataLabels:{ align:'right', inside:true, shadow:false, color:'#000' }, grouping:false } },
                credits:{ enabled:false }, yAxis:{ visible:false }, exporting:{ enabled:false },
                legend:{ padding:0, margin:0, verticalAlign:'middle', maxHeight:50 },
                series:[{ name:'Anggaran', color:'#34b4eb', data:[] },{ name:'Realisasi', color:'#b4eb34', data:[] }]
            });

            if (chartData) {
                chartData.forEach(function(subData, idx) {
                    if (!subData['nama']) return;
                    if (!subData['realisasi'] && !subData['anggaran']) {
                        $('#grafik-container').append("<div class='graph-sub'>" + subData['nama'] + "</div><div id='graph-" + idx + "' class='graph-not-available'>Data tidak tersedia.</div>");
                        return;
                    }
                    var persentase = Math.round(parseInt(subData['realisasi']) / (parseInt(subData['realisasi']) + parseInt(subData['anggaran'])) * 100) || 0;
                    $('#grafik-container').append("<div class='graph-sub'>" + subData['nama'] + "</div><div id='graph-" + idx + "' class='graph'></div>");
                    Highcharts.chart('graph-' + idx, {
                        chart: { type:'bar', margin:0, height:20, backgroundColor:'rgba(0,0,0,0)', spacingBottom:0 },
                        title:{ text:'' }, subtitle:{ text:'' },
                        xAxis:{ visible:false, categories:[''] },
                        tooltip:{ backgroundColor:'#fff', hideDelay:0, shape:'square', outside:true },
                        plotOptions:{ bar:{ dataLabels:{ enabled:true } }, series:{ pointPadding:0, groupPadding:0, dataLabels:{ align:'right', inside:true, shadow:false, color:'#000' }, grouping:false } },
                        credits:{ enabled:false }, yAxis:{ visible:false }, exporting:{ enabled:false }, legend:{ enabled:false },
                        series:[
                            { name:'Anggaran', color:'#34b4eb', data:[parseInt(subData['anggaran'])],
                              dataLabels:{ formatter:function(){ return parseInt(subData['realisasi']) <= parseInt(subData['anggaran']) ? 'Rp. ' + Highcharts.numberFormat(subData['anggaran'],'.', ',') : ''; }, style:{ textOutline:'1px contrast' } },
                              tooltip:{ pointFormatter:function(){ return 'Anggaran: <b>Rp. ' + Highcharts.numberFormat(this.y,'.', ',') + '</b>'; } } },
                            { name:'Realisasi', color:'#b4eb34', data:[parseInt(subData['realisasi'])],
                              dataLabels:{ formatter:function(){ return parseInt(subData['realisasi']) > parseInt(subData['anggaran']) ? 'Rp. ' + Highcharts.numberFormat(subData['realisasi'],'.', ',') : '(' + persentase + '%)'; }, style:{ textOutline:'1px contrast' } },
                              tooltip:{ pointFormatter:function(){ return 'Realisasi: <b>Rp. ' + Highcharts.numberFormat(this.y,'.', ',') + '</b>'; } } }
                        ]
                    });
                });
            }
        }

        function resetContainer() { $('#grafik-container').html(''); }
        function gantiTahun(newThn) { year = newThn; displayChart(year, tipe); }
        function gantiTipe(newType) { tipe = newType; displayChart(year, tipe); }
        $(document).ready(function() { displayChart(year, tipe); });
    </script>
@endif
