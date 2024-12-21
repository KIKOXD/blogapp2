@if ($paginator->hasPages())
    <nav>
        <div class="flex flex-row items-center justify-center bg-white px-1 py-0.5 rounded-lg shadow">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-1 py-0.5 text-xs text-gray-500 cursor-not-allowed">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-1 py-0.5 text-xs text-[#003f7f] hover:bg-gray-100 rounded">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-1 py-0.5 text-xs text-gray-500">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-1 py-0.5 text-xs text-white bg-[#003f7f] rounded min-w-[15px] text-center">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-1 py-0.5 text-xs text-[#003f7f] hover:bg-gray-100 rounded min-w-[15px] text-center">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-1 py-0.5 text-xs text-[#003f7f] hover:bg-gray-100 rounded">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span class="px-1 py-0.5 text-xs text-gray-500 cursor-not-allowed">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif 