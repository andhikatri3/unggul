@if ($paginator->hasPages())
    <nav class="flex flex-col items-center gap-3 mt-6">
        <div class="text-sm text-gray-500">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</div>
        <ul class="flex flex-wrap items-center justify-center gap-1">
            {{-- First Page --}}
            <li>
                <a href="{{ $paginator->url(1) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline" title="Halaman Pertama">
                    <i class="fas fa-angles-left"></i>
                </a>
            </li>

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed">
                        <i class="fas fa-angle-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline" title="Sebelumnya">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-bold bg-primary text-white border border-primary">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline" title="Selanjutnya">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-200 text-gray-300 cursor-not-allowed">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </li>
            @endif

            {{-- Last Page --}}
            <li>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm border border-gray-300 text-gray-600 hover:bg-primary hover:text-white hover:border-primary transition-colors no-underline" title="Halaman Terakhir">
                    <i class="fas fa-angles-right"></i>
                </a>
            </li>
        </ul>
    </nav>
@endif
