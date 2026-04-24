@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
    <i class="fas fa-archive text-primary mr-2"></i>
    {{ $judul_widget }}
</h3>

@php
    $tabs = [
        'ekologi'     => ['label' => 'Ekologi',  'data' => $profil_ekologi  ?? []],
        'internet'    => ['label' => 'Jaringan', 'data' => $profil_internet ?? []],
        'status_adat' => ['label' => 'Status ' . ucwords(setting('sebutan_desa')), 'data' => $profil_status ?? []],
    ];
    $firstTab = array_key_first($tabs);
@endphp

{{-- Tab buttons --}}
<div class="flex border-b border-gray-200 mb-3 gap-1">
    @foreach ($tabs as $key => $tab)
        <button onclick="switchProfilTab('{{ $key }}', this)"
            class="profil-tab px-2 py-1.5 text-xs font-semibold rounded-t border-b-2 transition-colors whitespace-nowrap
                   {{ $key === $firstTab ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-primary' }}">
            {{ $tab['label'] }}
        </button>
    @endforeach
</div>

{{-- Tab panels --}}
@foreach ($tabs as $key => $tab)
    <div id="profil-tab-{{ $key }}" class="profil-panel {{ $key !== $firstTab ? 'hidden' : '' }}">
        @if (!empty($tab['data']))
            <div class="space-y-0 divide-y divide-gray-100 text-sm">
                @foreach ($tab['data'] as $profil)
                    @php
                        $isFile     = in_array($profil->key, ['struktur_adat', 'dokumen_regulasi_penetapan_kampung_adat']);
                        $filePath   = LOKASI_DOKUMEN . $profil['value'];
                        $hasFile    = !empty($profil['value']) && file_exists($filePath) && $isFile;
                    @endphp
                    <div class="flex items-start py-2 gap-2">
                        <span class="text-gray-500 w-28 flex-shrink-0 leading-snug">{{ $profil->judul }}</span>
                        <span class="text-gray-400 flex-shrink-0">:</span>
                        <span class="text-gray-700 flex-1 leading-snug">
                            @if ($hasFile)
                                <a href="{{ base_url($filePath) }}" target="_blank"
                                   class="inline-flex items-center gap-1 text-primary hover:underline text-xs font-medium no-underline">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            @else
                                {{ $isFile ? '-' : $profil['value'] }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 text-center py-3">Tidak ada data</p>
        @endif
    </div>
@endforeach

<script>
    function switchProfilTab(key, btn) {
        document.querySelectorAll('.profil-panel').forEach(function(el) { el.classList.add('hidden'); });
        document.querySelectorAll('.profil-tab').forEach(function(el) {
            el.classList.remove('border-primary', 'text-primary');
            el.classList.add('border-transparent', 'text-gray-500');
        });
        document.getElementById('profil-tab-' + key).classList.remove('hidden');
        btn.classList.add('border-primary', 'text-primary');
        btn.classList.remove('border-transparent', 'text-gray-500');
    }
</script>
