@if(!empty($items))
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb"
        class="mb-3"
    >
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Главная</a>
            </li>

            @foreach($items as $item)
                @if($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $item['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
