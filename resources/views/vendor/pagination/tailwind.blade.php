@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center mt-10">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 mx-1 text-sm font-medium bg-gray-200 rounded-md cursor-not-allowed">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 mx-1 text-sm font-medium bg-gray-200 rounded-md">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 mx-1 text-sm font-medium bg-gray-200 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 mx-1 text-sm font-medium text-black bg-white rounded-md hover:bg-gray-100">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                <i class="fa-solid fa-chevron-right"></i>
                
            </a>
        @else
            <span class="px-4 py-2 mx-1 text-sm font-medium bg-gray-200 rounded-md cursor-not-allowed">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
