@if($paginator->hasPages())
<div class="table-pagination">
    <p>{{ __('Showing') }} {{ $paginator->firstItem() }} {{ __('to') }} {{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }} {{ __('entries') }}</p>
    <nav class="pagination-wrap">
        <ul class="pagination style-two d-flex justify-content-center gap-md-3 gap-2">
            @if($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">{{ __('Prev') }}</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">{{ __('Prev') }}</a>
            </li>
            @endif
            @foreach($elements as $element)
            @if(is_string($element))
            <li class="page-item disabled">
                <a class="page-link" href="#">{{ $element }}</a>
            </li>
            @endif
            @if(is_array($element))
            @foreach($element as $page => $url)
            @if($page == $paginator->currentPage())
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">{{ $page }}</a>
            </li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach
            @if($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">{{ __('Next') }}</a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="#">{{ __('Next') }}</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif