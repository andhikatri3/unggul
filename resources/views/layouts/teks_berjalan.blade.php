@foreach ($teks_berjalan as $teks)
    <span style="padding-right: 50px;">
        {{ $teks['teks'] }}
        @if ($teks['tautan'])
            <a href="{{ $teks['tautan'] }}" rel="noopener noreferrer" title="Baca Selengkapnya" class="text-primary font-semibold">{{ $teks['judul_tautan'] }}</a>
        @endif
    </span>
@endforeach
