@extends('layouts.app')

@section('title', $contractor->name)

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ $contractor->name }}</h4>

        <div class="btn-group">
            <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-outline-primary">
                Редактировать
            </a>
            <a href="{{ route('contractors.index') }}" class="btn btn-outline-secondary">
                Назад
            </a>
        </div>
    </div>

    {{-- Tabs --}}
    <ul class="nav nav-tabs" id="contractorTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link active"
                id="main-tab"
                data-bs-toggle="tab"
                data-bs-target="#main"
                type="button"
                role="tab"
            >
                Общая информация
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                id="details-tab"
                data-bs-toggle="tab"
                data-bs-target="#details"
                type="button"
                role="tab"
            >
                Реквизиты
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                id="relations-tab"
                data-bs-toggle="tab"
                data-bs-target="#relations"
                type="button"
                role="tab"
            >
                Связанные данные
            </button>
        </li>
    </ul>

    <div class="tab-content border border-top-0 p-3">

        {{-- Общая информация --}}
        <div class="tab-pane fade show active" id="main" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Тип</dt>
                        <dd class="col-sm-8">{{ $contractor->type->name }}</dd>

                        <dt class="col-sm-4">Поставщик</dt>
                        <dd class="col-sm-8">
                            @if($contractor->is_supplier)
                                <span class="badge bg-success">Да</span>
                            @else
                                <span class="text-muted">Нет</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Код</dt>
                        <dd class="col-sm-8">{{ $contractor->code ?? '—' }}</dd>

                        <dt class="col-sm-4">НДС</dt>
                        <dd class="col-sm-8">{{ $contractor->vat?->name ?? 'Без НДС' }}</dd>

                        <dt class="col-sm-4">Отсрочка</dt>
                        <dd class="col-sm-8">{{ $contractor->delay }} дн.</dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Реквизиты --}}
        <div class="tab-pane fade" id="details" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ИНН</dt>
                        <dd class="col-sm-8">{{ $contractor->inn ?? '—' }}</dd>

                        <dt class="col-sm-4">КПП</dt>
                        <dd class="col-sm-8">{{ $contractor->kpp ?? '—' }}</dd>

                        <dt class="col-sm-4">Адрес</dt>
                        <dd class="col-sm-8">{{ $contractor->address ?? '—' }}</dd>

                        <dt class="col-sm-4">Телефон</dt>
                        <dd class="col-sm-8">{{ $contractor->phone ?? '—' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">
                            @if($contractor->email)
                                <a href="mailto:{{ $contractor->email }}">
                                    {{ $contractor->email }}
                                </a>
                            @else
                                —
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Связанные данные --}}
        <div class="tab-pane fade" id="relations" role="tabpanel">
            <div class="text-muted">
                Здесь будут договоры, счета, платежи и документы контрагента.
            </div>
        </div>

    </div>

@endsection
