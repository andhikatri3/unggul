@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">
        <a href="{{ site_url('arsip') }}" class="no-underline text-gray-800 hover:text-primary transition-colors">{{ $judul_widget }}</a>
    </h3>
    <i class="fas fa-archive text-primary/50 text-xs"></i>
</div>

<div class="flex border-b border-gray-100 bg-gray-50/50">
    <button onclick="switchArsipTab('terkini')" id="tab-terkini"
        class="arsip-tab flex-1 px-3 py-2.5 text-xs font-semibold transition-colors border-b-2 border-primary text-primary bg-white">
        Terbaru
    </button>
    <button onclick="switchArsipTab('populer')" id="tab-populer"
        class="arsip-tab flex-1 px-3 py-2.5 text-xs font-semibold transition-colors border-b-2 border-transparent text-gray-500 hover:text-primary">
        Populer
    </button>
</div>

@foreach (['terkini' => 'arsip_terkini', 'populer' => 'arsip_populer'] as $jenis => $jenis_arsip)
<div id="arsip-{{ $jenis }}" class="arsip-panel divide-y divide-gray-50 {{ $jenis !== 'terkini' ? 'hidden' : '' }}">
    @foreach ($$jenis_arsip as $arsip)
    <a href="{{ site_url('artikel/' . buat_slug($arsip)) }}" class="flex gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors no-underline group">
        <div class="flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden bg-gray-100">
            @if (is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip['gambar']))
                <img src="{{ base_url(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip['gambar']) }}"
                     alt="{{ $arsip['judul'] }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-gray-300"></i>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-800 group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-1">{{ $arsip['judul'] }}</p>
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span><i class="fas fa-calendar mr-1"></i>{{ tgl_indo($arsip['tgl_upload']) }}</span>
                <span><i class="fas fa-eye mr-1"></i>{{ hit($arsip['hit']) }}</span>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endforeach

<script>
function switchArsipTab(tab) {
    document.querySelectorAll('.arsip-panel').forEach(function(el) { el.classList.add('hidden'); });
    document.querySelectorAll('.arsip-tab').forEach(function(el) {
        el.classList.remove('border-primary', 'text-primary', 'bg-white');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    document.getElementById('arsip-' + tab).classList.remove('hidden');
    var activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-primary', 'text-primary', 'bg-white');
}
</script>
