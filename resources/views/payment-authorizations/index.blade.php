@extends('layouts.app')

@section('title', 'Разрешения на оплату')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h4>Разрешения на оплату</h4>
            <div>
                <a href="{{ route('payment-authorizations.archive') }}"
                   class="btn btn-outline-secondary">
                    Архив
                </a>

                <a href="{{ route('payment-authorizations.create') }}"
                   class="btn btn-primary">
                    + Добавить
                </a>
            </div>
        </div>

        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Контрагент</th>
                <th>Статья расхода</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Отсрочка</th>
                <th class="text-end">Сумма</th>
                <th width="150"></th>
            </tr>
            </thead>

            <tbody>
            @forelse($authorizations as $auth)
                <tr>
                    <td>{{ $auth->number }}</td>

                    <td>
                        <a href="{{ route('contractors.show', $auth->contractor->id) }}">
                            {{ $auth->contractor->name ?? '-' }}
                        </a>
                    </td>

                    <td>{{ $auth->expenseItem->name ?? '-' }}</td>

                    <td>{{ optional($auth->date_start)->format('d.m.Y') }}</td>

                    <td>
                        {{ optional($auth->date_end)->format('d.m.Y') ?? 'Бессрочно' }}
                    </td>

                    <td>{{ $auth->delay }} дн.</td>

                    <td class="text-end">
                        {{ number_format($auth->amount, 2, ',', ' ') }}
                    </td>

                    <td class="text-end">

                        <a href="{{ route('payment-authorizations.edit', $auth) }}"
                           class="btn btn-sm btn-outline-primary">
                            ✏️
                        </a>

                        <form action="{{ route('payment-authorizations.destroy', $auth) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Удалить запись?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-warning">
                                🗑
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-3">
                        Нет данных
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $authorizations->links() }}
        </div>

    </div>

@endsection
