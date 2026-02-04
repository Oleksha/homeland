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
                class="nav-link"
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
                class="nav-link active"
                id="receipts-tab"
                data-bs-toggle="tab"
                data-bs-target="#receipts"
                type="button"
                role="tab"
            >
                Поступления
                <span class="badge bg-secondary ms-1">
            {{ $receipts->count() }}
        </span>
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                class="nav-link"
                id="pa-tab"
                data-bs-toggle="tab"
                data-bs-target="#payment-authorizations"
                type="button"
                role="tab"
            >
                Разрешения на оплату
                <span class="badge bg-secondary ms-1">
                    {{ $paymentAuthorizations->count() }}
                </span>
            </button>
        </li>
    </ul>

    <div class="tab-content border border-top-0 p-3">

        {{-- Общая информация --}}
        @include('dictionaries.contractors.tabs.main')

        {{-- Реквизиты --}}
        @include('dictionaries.contractors.tabs.details')

        {{-- Поступления --}}
        @include('dictionaries.contractors.tabs.receipts')

        {{-- Разрешения на оплату --}}
        @include('dictionaries.contractors.tabs.payment-authorizations')

    </div>

@endsection
