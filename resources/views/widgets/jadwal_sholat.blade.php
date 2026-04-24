@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-mosque text-primary/50 text-xs"></i>
</div>

<div class="p-5">
    <div class="bg-primary/5 rounded-xl px-4 py-3 mb-4 text-center">
        <div class="text-xs font-medium text-primary flex items-center justify-center gap-1 mb-1">
            <i class="fas fa-map-marker-alt"></i>
            <span id="sholat-lokasi">{{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}, {{ $desa['nama_kabupaten'] }}</span>
        </div>
        <div class="text-xs text-gray-500" id="sholat-tanggal">
            <i class="fas fa-spinner fa-pulse text-xs"></i> Memuat jadwal...
        </div>
    </div>

    <div id="sholat-container" class="space-y-0.5">
        @foreach (['Imsak', 'Subuh', 'Terbit', 'Dhuha', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'] as $label)
        <div class="flex justify-between items-center px-3 py-2 rounded-lg transition-colors sholat-row" data-waktu="{{ strtolower($label) }}">
            <span class="text-sm text-gray-600">{{ $label }}</span>
            <span class="text-sm font-bold text-gray-800" id="sholat-{{ strtolower($label) }}">
                <i class="fas fa-spinner fa-pulse text-xs text-gray-300"></i>
            </span>
        </div>
        @endforeach
    </div>

    <div id="sholat-error" class="hidden text-center py-4">
        <i class="fas fa-exclamation-triangle text-red-400 text-2xl mb-2 block"></i>
        <p class="text-sm text-red-500">Gagal memuat jadwal sholat</p>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var lat = "{{ $desa['lat'] ?? '' }}";
    var lng = "{{ $desa['lng'] ?? '' }}";
    if (!lat || !lng) { lat = "-6.2088"; lng = "106.8456"; }

    var today = new Date();
    var dd    = String(today.getDate()).padStart(2, '0');
    var mm    = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy  = today.getFullYear();
    var h     = today.getHours();
    var dateStr = dd + '-' + mm + '-' + yyyy;
    var urutan  = ['imsak','subuh','terbit','dhuha','dzuhur','ashar','maghrib','isya'];

    $.ajax({
        url: 'https://api.aladhan.com/v1/timings/' + dateStr + '?latitude=' + lat + '&longitude=' + lng + '&method=20',
        type: 'get',
        dataType: 'json',
        success: function(res) {
            if (res.code === 200) {
                var t = res.data.timings;
                var d = res.data.date;
                $('#sholat-tanggal').html(d.hijri.day + ' ' + d.hijri.month.en + ' ' + d.hijri.year + ' H &bull; ' + d.readable);

                var times = {
                    imsak: t.Imsak, subuh: t.Fajr, terbit: t.Sunrise,
                    dhuha: t.Sunrise.replace(/(\d+):(\d+)/, function(m, hr, min) {
                        return String(parseInt(hr)).padStart(2,'0') + ':' + String(parseInt(min) + 15).padStart(2,'0');
                    }),
                    dzuhur: t.Dhuhr, ashar: t.Asr, maghrib: t.Maghrib, isya: t.Isha
                };

                var aktif = null;
                var hm = today.getHours() * 60 + today.getMinutes();
                urutan.forEach(function(w) {
                    var parts = (times[w] || '').split(':');
                    var wm = parseInt(parts[0]) * 60 + parseInt(parts[1]);
                    if (!aktif && wm > hm) aktif = w;
                    $('#sholat-' + w).text(times[w]);
                });
                // Setelah Isya semua waktu sudah lewat — aktifkan Imsak (esok hari)
                if (!aktif) aktif = urutan[0];

                if (aktif) {
                    var row = document.querySelector('.sholat-row[data-waktu="' + aktif + '"]');
                    if (row) {
                        row.classList.add('bg-primary/10');
                        row.querySelector('span:first-child').classList.add('text-primary', 'font-semibold');
                        row.querySelector('span:last-child').classList.add('text-primary');
                    }
                }
            } else {
                $('#sholat-container').addClass('hidden');
                $('#sholat-error').removeClass('hidden');
            }
        },
        error: function() {
            $('#sholat-container').addClass('hidden');
            $('#sholat-tanggal').empty();
            $('#sholat-error').removeClass('hidden');
        }
    });
});
</script>
@endpush
