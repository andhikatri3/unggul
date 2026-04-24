@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-comments text-primary/50 text-xs"></i>
</div>

@if (!empty($komen))
    <div class="divide-y divide-gray-50 max-h-80 overflow-y-auto">
        @foreach ($komen as $data)
            <a href="{{ site_url('artikel/' . buat_slug($data)) }}" class="flex gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors no-underline group">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <span class="text-xs font-bold text-primary">{{ strtoupper(substr($data['pengguna']['nama'], 0, 1)) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-baseline justify-between gap-2 mb-0.5">
                        <span class="text-xs font-semibold text-gray-800 truncate group-hover:text-primary transition-colors">{{ $data['pengguna']['nama'] }}</span>
                        <span class="text-xs text-gray-400 flex-shrink-0">{{ tgl_indo2($data['tgl_upload']) }}</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $data['komentar'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
@else
    <div class="p-6 text-center">
        <i class="fas fa-comment-slash text-gray-200 text-3xl mb-2 block"></i>
        <p class="text-sm text-gray-400">Belum ada komentar</p>
    </div>
@endif
