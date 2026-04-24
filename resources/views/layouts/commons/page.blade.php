@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if ($items->total() > $items->perPage())
    <nav class="flex flex-col items-center gap-3 mt-6">
        <div class="text-sm text-gray-500">Halaman {{ $items->currentPage() }} dari {{ $items->lastPage() }}</div>
        <ul class="flex flex-wrap items-center justify-center gap-1">
            {{-- First & Previous --}}
            @if ($items->onFirstPage())
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i class="fas fa-angles-left"></i></span>
                </li>
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i class="fas fa-angle-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $items->url(1) }}" title="Halaman Pertama" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline"><i class="fas fa-angles-left"></i></a>
                </li>
                <li>
                    <a href="{{ $items->previousPageUrl() }}" title="Halaman Sebelumnya" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline"><i class="fas fa-angle-left"></i></a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                @if ($items->currentPage() == $page)
                    <li>
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-bold bg-primary text-white border border-primary">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}" title="Halaman {{ $page }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next & Last --}}
            @if ($items->hasMorePages())
                <li>
                    <a href="{{ $items->nextPageUrl() }}" title="Halaman Selanjutnya" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline"><i class="fas fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="{{ $items->url($items->lastPage()) }}" title="Halaman Terakhir" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline"><i class="fas fa-angles-right"></i></a>
                </li>
            @else
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i class="fas fa-angle-right"></i></span>
                </li>
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i class="fas fa-angles-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
