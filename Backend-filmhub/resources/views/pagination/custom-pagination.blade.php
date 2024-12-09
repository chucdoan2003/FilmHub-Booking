<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
                <i class="flaticon-left-arrow"></i>
            </a>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <i class="flaticon-left-arrow"></i>
            </a>
        </li>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @elseif (is_array($element))
            @foreach ($element as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <i class="flaticon-right-arrow"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Next">
                <i class="flaticon-right-arrow"></i>
            </a>
        </li>
    @endif
</ul>
