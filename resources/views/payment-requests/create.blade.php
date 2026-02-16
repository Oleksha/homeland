@extends('layouts.app')

@section('title', 'Создание заявки на оплату')

@section('content')
    <div class="container">

        <h3 class="mb-4">Создание заявки</h3>

        <form method="POST" action="{{ route('payment-requests.store') }}">
            @csrf

            <div class="row">

                {{-- Дата --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Дата</label>
                    <input type="date"
                           name="date"
                           class="form-control"
                           value="{{ old('date', now()->format('Y-m-d')) }}"
                           required>
                </div>

                {{-- Номер --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Номер</label>
                    <input type="text"
                           name="number"
                           class="form-control"
                           value="{{ old('number') }}"
                           required>
                </div>

                {{-- Сумма --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Сумма</label>
                    <input type="number"
                           step="0.01"
                           name="amount"
                           class="form-control"
                           value="{{ old('amount') }}"
                           required>
                </div>

                {{-- НДС --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">НДС</label>
                    <select name="vat_id" class="form-select">
                        <option value="">Без НДС</option>
                        @foreach($vats as $vat)
                            <option value="{{ $vat->id }}"
                                @selected(old('vat_id') == $vat->id)>
                                {{ $vat->name }} ({{ $vat->rate }}%)
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row">

                {{-- Контрагент --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Контрагент</label>
                    <select name="contractor_id"
                            class="form-select"
                            required>
                        <option value="">Выберите...</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}"
                                @selected(old('contractor_id') == $contractor->id)>
                                {{ $contractor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Дата оплаты --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Дата оплаты</label>
                    <input type="date"
                           name="date_pay"
                           class="form-control"
                           value="{{ old('date_pay') }}">
                </div>

                {{-- Статус --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Статус</label>
                    <select name="status" class="form-select" required>
                        <option value="unpaid">Не оплачена</option>
                        <option value="partial">Частично</option>
                        <option value="paid">Оплачена</option>
                    </select>
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Сохранить</button>
                <a href="{{ route('payment-requests.index') }}"
                   class="btn btn-secondary">Отмена</a>
            </div>

        </form>

    </div>
@endsection
