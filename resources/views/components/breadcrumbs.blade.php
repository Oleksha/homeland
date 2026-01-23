@if(!empty($items))
    <nav aria-label="breadcrumb" class="mb-3">
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
