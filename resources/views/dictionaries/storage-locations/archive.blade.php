@extends('layouts.app')

@section('title','Архив мест хранения')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Архив мест хранения</h4>

        <a href="{{ route('storage-locations.index') }}"
           class="btn btn-outline-primary">
            Назад
        </a>
    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Наименование</th>
            <th style="width: 150px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @forelse($locations as $location)
            <tr>
                <td>{{ $location->name }}</td>
                <td class="text-end text-nowrap">
                    {{-- Restore --}}
                    <form method="post" class="d-inline"
                          action="{{ route('storage-locations.restore', $location->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-success">
                            ♻
                        </button>
                    </form>

                    {{-- Force delete --}}
                    <form method="POST"
                          action="{{ route('storage-locations.force-delete',$location->id) }}"
                          class="d-inline"
                          onsubmit="return confirm('Удалить навсегда?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            🗑
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">
                    Архив пуст
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
