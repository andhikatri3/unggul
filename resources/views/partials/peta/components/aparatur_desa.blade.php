@if (!empty($aparatur_desa['daftar_perangkat']))
<div class="grid grid-cols-2 gap-3">
    @foreach ($aparatur_desa['daftar_perangkat'] as $data)
    <div class="text-center">
        <img src="{{ $data['foto'] }}" alt="{{ $data['nama'] }}"
             class="w-20 h-24 rounded-xl mx-auto object-cover bg-gray-100 border border-gray-100">
        <p class="text-xs font-semibold text-gray-800 mt-2 leading-tight">{{ $data['nama'] }}</p>
        <p class="text-xs text-primary mt-0.5">{{ $data['jabatan'] }}</p>
    </div>
    @endforeach
</div>
@else
<p class="text-sm text-gray-400 text-center py-4">Data tidak tersedia</p>
@endif
