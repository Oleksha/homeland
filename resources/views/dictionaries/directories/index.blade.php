@extends('layouts.app')

@section('title', 'Справочники')

@section('content')
    <div class="container">
        <h1 class="mb-4">Справочники</h1>

        <div class="row g-4">
            @foreach($directories as $directory)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <x-icon name="{{ $directory['icon'] }}" width="32" height="32" class="me-2"/>
                                <h5 class="card-title mb-0">{{ $directory['title'] }}</h5>
                            </div>

                            <p class="card-text text-muted mb-3">
                                {{ $directory['description'] }}
                            </p>

                            <div class="mb-3">
                                <span class="badge bg-success">
                                    Активные: {{ $directory['count'] }}
                                </span>

                                @if(!is_null($directory['archived']))
                                    <span class="badge bg-secondary">
                                        Архив: {{ $directory['archived'] }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ $directory['route'] }}" class="btn btn-primary mt-auto">
                                Открыть
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
