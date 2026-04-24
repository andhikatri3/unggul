@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
    <span class="w-1 h-4 bg-primary rounded-full flex-shrink-0"></span>
    <h3 class="text-sm font-bold text-gray-800 flex-1">{{ $judul_widget }}</h3>
    <i class="fas fa-tags text-primary/50 text-xs"></i>
</div>

@if (!empty($menu_kiri))
    <ul class="py-1">
        @foreach ($menu_kiri as $data)
            <li>
                <a href="{{ ci_route('artikel/kategori/' . $data['slug']) }}"
                   class="flex items-center gap-2 px-5 py-2.5 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors no-underline group border-b border-gray-50 last:border-0">
                    <i class="fas fa-chevron-right text-primary/30 group-hover:text-primary text-xs transition-colors flex-shrink-0"></i>
                    <span class="flex-1 leading-tight">{{ $data['kategori'] }}</span>
                    @if (count($data['submenu'] ?? []) > 0)
                        <span class="text-xs bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary rounded-full px-2 py-0.5 transition-colors flex-shrink-0">
                            {{ count($data['submenu']) }}
                        </span>
                    @endif
                </a>
                @if (count($data['submenu'] ?? []) > 0)
                    <ul class="bg-gray-50/70">
                        @foreach ($data['submenu'] as $submenu)
                            <li>
                                <a href="{{ ci_route('artikel/kategori/' . $submenu['slug']) }}"
                                   class="flex items-center gap-2 pl-10 pr-5 py-2 text-xs text-gray-500 hover:text-primary hover:bg-primary/5 transition-colors no-underline border-b border-gray-100 last:border-0">
                                    <i class="fas fa-angle-right text-gray-300 flex-shrink-0"></i>
                                    {{ $submenu['kategori'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@else
    <div class="p-6 text-center">
        <i class="fas fa-folder-open text-gray-200 text-3xl mb-2 block"></i>
        <p class="text-sm text-gray-400">Belum ada kategori</p>
    </div>
@endif
