@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@php
    $sinergi_program = sinergi_program();
    $perbaris = (int) (setting('gambar_sinergi_program_perbaris') ?: 3);
@endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-handshake text-primary/50 text-xs"></i>
</div>

@if (!empty($sinergi_program))
    <div class="p-5">
        <div class="grid gap-3" style="grid-template-columns: repeat({{ $perbaris }}, minmax(0, 1fr));">
            @foreach ($sinergi_program as $item)
                <a href="{{ $item['tautan'] }}" target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-primary/40 hover:shadow-md transition-all duration-200 bg-white group"
                   title="{{ $item['judul'] }}">
                    <img src="{{ $item['gambar_url'] }}" alt="{{ $item['judul'] }}"
                         class="max-w-full max-h-10 object-contain grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300">
                </a>
            @endforeach
        </div>
    </div>
@else
    <div class="p-6 text-center">
        <i class="fas fa-handshake text-gray-200 text-3xl mb-2 block"></i>
        <p class="text-sm text-gray-400">Belum ada program sinergi</p>
    </div>
@endif
