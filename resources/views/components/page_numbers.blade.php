@if ($paginator->hasPages())

    <div class="pagination flex-box">
        {{--        <div class=" refrence">--}}
{{--            صفحه {{ fa_number($paginator->currentPage()) }} از {{ fa_number(ceil($paginator->total() / $paginator->perPage())) }}--}}
{{--        </div>--}}
    @foreach ($elements as $element)

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                        <a class="flex-box active">
                        {{ $page }}
                    </a>
                @else
                        <a class="flex-box" href="{{ $url }}">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    </div>
@endif

