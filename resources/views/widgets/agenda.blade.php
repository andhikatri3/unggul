@php
    $semua = array_merge($hari_ini ?? [], $yad ?? [], $lama ?? []);
    $tab = count($hari_ini ?? []) > 0 ? 'hari_ini' : (count($yad ?? []) > 0 ? 'yad' : 'lama');
@endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-calendar-alt text-primary/50 text-xs"></i>
</div>

@if (count($semua) > 0)
    <div class="flex border-b border-gray-100 bg-gray-50/50">
        @if (count($hari_ini ?? []) > 0)
            <button onclick="switchAgendaTab('hari_ini', this)"
                class="agenda-tab flex-1 px-3 py-2.5 text-xs font-semibold transition-colors border-b-2
                       {{ $tab === 'hari_ini' ? 'border-primary text-primary bg-white' : 'border-transparent text-gray-500 hover:text-primary' }}">
                Hari ini
            </button>
        @endif
        @if (count($yad ?? []) > 0)
            <button onclick="switchAgendaTab('yad', this)"
                class="agenda-tab flex-1 px-3 py-2.5 text-xs font-semibold transition-colors border-b-2
                       {{ $tab === 'yad' ? 'border-primary text-primary bg-white' : 'border-transparent text-gray-500 hover:text-primary' }}">
                Mendatang
            </button>
        @endif
        @if (count($lama ?? []) > 0)
            <button onclick="switchAgendaTab('lama', this)"
                class="agenda-tab flex-1 px-3 py-2.5 text-xs font-semibold transition-colors border-b-2
                       {{ $tab === 'lama' ? 'border-primary text-primary bg-white' : 'border-transparent text-gray-500 hover:text-primary' }}">
                Lewat
            </button>
        @endif
    </div>

    @foreach (['hari_ini' => $hari_ini ?? [], 'yad' => $yad ?? [], 'lama' => $lama ?? []] as $key => $list)
        @if (count($list) > 0)
            <div id="agenda-tab-{{ $key }}" class="agenda-panel divide-y divide-gray-50 {{ $tab !== $key ? 'hidden' : '' }}">
                @foreach ($list as $item)
                    <a href="{{ site_url('artikel/' . buat_slug($item)) }}" class="block px-5 py-3.5 hover:bg-gray-50 transition-colors no-underline group">
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-primary transition-colors leading-snug line-clamp-2 mb-2">
                            {{ $item['judul'] }}
                        </p>
                        <div class="space-y-1">
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <i class="fas fa-clock text-primary/50 w-3.5 flex-shrink-0"></i>
                                <span>{{ tgl_indo2($item['tgl_agenda']) }}</span>
                            </div>
                            @if (!empty($item['lokasi_kegiatan']))
                                <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                    <i class="fas fa-map-marker-alt text-primary/50 w-3.5 flex-shrink-0"></i>
                                    <span class="truncate">{{ $item['lokasi_kegiatan'] }}</span>
                                </div>
                            @endif
                            @if (!empty($item['koordinator_kegiatan']))
                                <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                    <i class="fas fa-user text-primary/50 w-3.5 flex-shrink-0"></i>
                                    <span class="truncate">{{ $item['koordinator_kegiatan'] }}</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @endforeach

    <script>
        function switchAgendaTab(key, btn) {
            document.querySelectorAll('.agenda-panel').forEach(function(el) { el.classList.add('hidden'); });
            document.querySelectorAll('.agenda-tab').forEach(function(el) {
                el.classList.remove('border-primary', 'text-primary', 'bg-white');
                el.classList.add('border-transparent', 'text-gray-500');
            });
            document.getElementById('agenda-tab-' + key).classList.remove('hidden');
            btn.classList.add('border-primary', 'text-primary', 'bg-white');
            btn.classList.remove('border-transparent', 'text-gray-500');
        }
    </script>
@else
    <div class="p-6 text-center">
        <i class="fas fa-calendar-times text-gray-200 text-3xl mb-2 block"></i>
        <p class="text-sm text-gray-400">Belum ada agenda</p>
    </div>
@endif
