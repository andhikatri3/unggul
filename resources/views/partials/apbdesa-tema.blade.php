@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if (!empty($widget_keuangan['tahun']) && null !== $widget_keuangan['tahun'])
<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Transparansi Anggaran</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($data_widget as $subdata_name => $subdatas)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary-dark to-primary px-5 py-3">
                    <h3 class="text-white font-bold text-center text-sm md:text-base">
                        {{ \Illuminate\Support\Str::of($subdatas['laporan'])->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
                            return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
                        }) }}
                    </h3>
                </div>

                <!-- Content -->
                <div class="p-5 space-y-5">
                    @foreach ($subdatas as $key => $subdata)
                        @continue(!is_array($subdata))
                        @if ($subdata['judul'] != null and $key != 'laporan' and ($subdata['realisasi'] != 0 or $subdata['anggaran'] != 0))
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">
                                {{ \Illuminate\Support\Str::of($subdata['judul'])->title()->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                                    if (!in_array($string, ['Dana Desa'])) {
                                        return $string->replace('Desa', setting('sebutan_desa'));
                                    }
                                })->title() }}
                            </h4>
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Realisasi | Anggaran</span>
                            </div>
                            <div class="flex justify-between text-xs font-semibold text-gray-700 mb-2">
                                <span>{{ rupiah24($subdata['realisasi'], 'Rp. ') }}</span>
                                <span>{{ rupiah24($subdata['anggaran'], 'Rp. ') }}</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="relative w-full h-5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-green-400 to-primary transition-all duration-500" style="width: {{ min($subdata['persen'], 100) }}%"></div>
                                <span class="absolute inset-0 flex items-center justify-end pr-2 text-xs font-bold {{ $subdata['persen'] > 40 ? 'text-white' : 'text-gray-600' }}">{{ $subdata['persen'] }}%</span>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endif
