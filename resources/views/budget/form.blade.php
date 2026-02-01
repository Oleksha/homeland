@php
    /** @var \App\Domains\Budget\Models\Budget|null $budget */
    $isEdit = isset($budget);
@endphp

<form
    method="post"
    action="{{ $isEdit ? route('budgets.update', $budget) : route('budgets.store') }}"
>
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="row g-3">

        {{-- Сценарий --}}
        <div class="col-md-3">
            <label class="form-label">Сценарий</label>
            <input
                type="month"
                name="budget_period"
                class="form-control @error('budget_period') is-invalid @enderror"
                value="{{ old('budget_period', optional($budget->budget_period ?? null)->format('Y-m')) }}"
                required
            >
            @error('budget_period') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Месяц расхода --}}
        <div class="col-md-3">
            <label class="form-label">Месяц расхода</label>
            <input
                type="month"
                name="expense_month"
                class="form-control @error('expense_month') is-invalid @enderror"
                value="{{ old('expense_month', optional($budget->expense_month ?? null)->format('Y-m')) }}"
                required
            >
            @error('expense_month') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Месяц оплаты --}}
        <div class="col-md-3">
            <label class="form-label">Месяц оплаты</label>
            <input
                type="month"
                name="payment_month"
                class="form-control @error('payment_month') is-invalid @enderror"
                value="{{ old('payment_month', optional($budget->payment_month ?? null)->format('Y-m')) }}"
                required
            >
            @error('payment_month') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Номер --}}
        <div class="col-md-3">
            <label class="form-label">Номер операции</label>
            <input
                type="text"
                name="budget_number"
                class="form-control @error('budget_number') is-invalid @enderror"
                value="{{ old('budget_number', $budget->budget_number ?? '') }}"
            >
            @error('budget_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Статья расхода --}}
        <div class="col-md-6">
            <label class="form-label">Статья расхода</label>
            <select
                name="expense_item_id"
                class="form-select @error('expense_item_id') is-invalid @enderror"
                required
            >
                <option value="">— выберите —</option>
                @foreach($expenseItems as $item)
                    <option
                        value="{{ $item->id }}"
                        @selected(old('expense_item_id', $budget->expense_item_id ?? null) == $item->id)
                    >
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            @error('expense_item_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- НДС --}}
        <div class="col-md-3">
            <label class="form-label">НДС</label>
            <select
                name="vat_id"
                class="form-select @error('vat_id') is-invalid @enderror"
            >
                <option value="">Без НДС</option>
                @foreach($vats as $vat)
                    <option
                        value="{{ $vat->id }}"
                        @selected(old('vat_id', $budget->vat_id ?? null) == $vat->id)
                    >
                        {{ $vat->name }}
                    </option>
                @endforeach
            </select>
            @error('vat_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Сумма --}}
        <div class="col-md-3">
            <label class="form-label">Сумма</label>
            <input
                type="number"
                step="0.01"
                name="amount"
                class="form-control @error('amount') is-invalid @enderror"
                value="{{ old('amount', $budget->amount ?? '') }}"
                required
            >
            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Статус --}}
        <div class="col-md-3">
            <label class="form-label">Статус</label>
            <select
                name="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >
                @foreach(\App\Domains\Budget\Enums\BudgetStatus::cases() as $status)
                    <option
                        value="{{ $status->value }}"
                        @selected(old('status', $budget->status->value ?? null) === $status->value)
                    >
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Описание --}}
        <div class="col-md-12">
            <label class="form-label">Описание</label>
            <textarea
                name="description"
                rows="3"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $budget->description ?? '') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

    </div>

    {{-- Кнопки --}}
    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-primary">
            {{ $isEdit ? 'Сохранить изменения' : 'Создать' }}
        </button>

        <a href="{{ route('budgets.index') }}" class="btn btn-outline-secondary">
            Отмена
        </a>
    </div>
</form>
