@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        @if ($page == 1 || $page == $paginator->lastPage() || $page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() + 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">&nbsp{{ $page }}&nbsp</a>
                            </li>
                        @endif
                        @if (($page == $paginator->currentPage() - 2 && $page != 1 && $page != $paginator->lastPage())) 
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        @if ($page == $paginator->currentPage() + 2 && $page != 1 && $page != $paginator->lastPage())
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
