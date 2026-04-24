@if (!empty($transparansi['data_widget']))
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($transparansi['data_widget'] as $subdatas)
    <div>
        <h4 class="text-sm font-bold text-gray-800 text-center mb-1">{{ $subdatas['laporan'] }}</h4>
        <hr class="border-gray-100 mb-3">
        <p class="text-xs text-center text-gray-400 mb-3">Realisasi | Anggaran</p>
        <hr class="border-gray-100 mb-3">
        <div class="space-y-4">
            @foreach ($subdatas as $key => $subdata)
                @if ($key != 'laporan' && !empty($subdata['judul']))
                <div>
                    <p class="text-xs text-gray-700 mb-0.5">{{ $subdata['judul'] }}</p>
                    <p class="text-xs font-semibold text-gray-800 mb-1.5">
                        Rp {{ number_format($subdata['realisasi']) }}
                        <span class="text-gray-400 font-normal">|</span>
                        Rp {{ number_format($subdata['anggaran']) }}
                    </p>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full transition-all"
                             style="width: {{ min((int)$subdata['persen'], 100) }}%"></div>
                    </div>
                    <p class="text-right text-xs text-gray-400 mt-0.5">{{ $subdata['persen'] }}%</p>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@else
<p class="text-sm text-gray-400 text-center py-4">Data tidak tersedia</p>
@endif
