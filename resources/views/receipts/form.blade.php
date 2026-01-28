@extends('layouts.app')

@section('title', $receipt->id ? 'Редактирование поступления' : 'Создание поступления')

@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ $receipt->id ? route('receipts.update', $receipt) : route('receipts.store') }}">
            @csrf
            @if($receipt->id)
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="date" class="form-label">Дата документа</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', optional($receipt->date)->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="number" class="form-label">Номер внутренний</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{ old('number', $receipt->number) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Тип</label>
                    <select name="type" id="type" class="form-select" required>
                        @foreach(\App\Enums\ReceiptType::options() as $value => $label)
                            <option value="{{ $value }}" @selected(old('type', $receipt->type?->value) == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="contractor_id" class="form-label">Контрагент</label>
                    <select name="contractor_id" id="contractor_id" class="form-select" required>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}" @selected(old('contractor_id', $receipt->contractor_id) == $contractor->id)>{{ $contractor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="document_number" class="form-label">Входящий №</label>
                    <input type="text" name="document_number" id="document_number" class="form-control" value="{{ old('document_number', $receipt->document_number) }}">
                </div>
                <div class="col-md-3">
                    <label for="document_date" class="form-label">Входящая дата</label>
                    <input type="date" name="document_date" id="document_date" class="form-control" value="{{ old('document_date', optional($receipt->document_date)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label for="note" class="form-label">Примечание</label>
                    <input type="text" name="note" id="note" class="form-control" value="{{ old('note', $receipt->note) }}">
                </div>
            </div>

            <h5 class="mt-4">Строки поступления</h5>
            <table class="table table-striped" id="itemsTable">
                <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Ставка НДС</th>
                    <th>Сумма</th>
                    <th>Сумма НДС</th>
                    <th>Итого</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach(old('items', $receipt->items ?? []) as $index => $item)
                    <tr>
                        <td><input type="text" name="items[{{ $index }}][name]" class="form-control" value="{{ $item['name'] ?? '' }}" required></td>
                        <td><input type="number" name="items[{{ $index }}][quantity]" class="form-control item-quantity" value="{{ $item['quantity'] ?? 1 }}" step="0.01" required></td>
                        <td><input type="number" name="items[{{ $index }}][price]" class="form-control item-price" value="{{ $item['price'] ?? 0 }}" step="0.01" required></td>
                        <td>
                            <select name="items[{{ $index }}][vat_id]" class="form-select item-vat" required>
                                @foreach($vats as $vat)
                                    <option value="{{ $vat->id }}" @selected(($item['vat_id'] ?? null) == $vat->id) data-rate="{{ $vat->rate }}"
                                    >{{ $vat->name }} ({{ $vat->rate }}%)</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="item-amount align-middle">{{ $item['amount'] ?? 0 }}</td>
                        <td class="item-vat-amount align-middle">{{ $item['vat_amount'] ?? 0 }}</td>
                        <td class="item-total align-middle">{{ $item['total_amount'] ?? 0 }}</td>
                        <input type="hidden" name="items[{{ $index }}][amount]" class="item-amount-input" value="{{ $item['amount'] ?? 0 }}">
                        <input type="hidden" name="items[{{ $index }}][vat_amount]" class="item-vat-amount-input" value="{{ $item['vat_amount'] ?? 0 }}">
                        <input type="hidden" name="items[{{ $index }}][total_amount]" class="item-total-input" value="{{ $item['total_amount'] ?? 0 }}">
                        <td class="align-middle"><button type="button" class="btn btn-danger btn-sm remove-item">×</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="button" id="addItem" class="btn btn-secondary btn-sm">Добавить строку</button>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Сохранить поступление</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('itemsTable').querySelector('tbody');
            let index = table.rows.length;

            function recalcRow(row) {
                const qty = parseFloat(row.querySelector('.item-quantity').value) || 0;
                const priceWithVat = parseFloat(row.querySelector('.item-price').value) || 0;

                const vatRate = parseFloat(
                    row.querySelector('.item-vat').selectedOptions[0].dataset.rate
                ) || 0;

                // Общая сумма (уже с НДС)
                const total = qty * priceWithVat;

                // НДС "внутри" суммы
                const vatAmount = vatRate > 0
                    ? total - (total / (1 + vatRate / 100))
                    : 0;

                // Сумма без НДС
                const amount = total - vatAmount;

                row.querySelector('.item-amount').textContent = amount.toFixed(2);
                row.querySelector('.item-vat-amount').textContent = vatAmount.toFixed(2);
                row.querySelector('.item-total').textContent = total.toFixed(2);

                // сохраняем в БД
                row.querySelector('.item-amount-input').value = amount.toFixed(2);
                row.querySelector('.item-vat-amount-input').value = vatAmount.toFixed(2);
                row.querySelector('.item-total-input').value = total.toFixed(2);
            }

            function addRow(item = {}) {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td><input type="text" name="items[${index}][name]" class="form-control" value="${item.name || ''}" required></td>
            <td><input type="number" name="items[${index}][quantity]" class="form-control item-quantity" value="${item.quantity || 1}" step="0.01" required></td>
            <td><input type="number" name="items[${index}][price]" class="form-control item-price" value="${item.price || 0}" step="0.01" required></td>
            <td>
                <select name="items[${index}][vat_id]" class="form-select item-vat" required>
                    @foreach($vats as $vat)
                <option value="{{ $vat->id }}" data-rate="{{ $vat->rate }}">{{ $vat->name }} ({{ $vat->rate }}%)</option>
                    @endforeach
                </select>
            </td>
            <td class="item-amount align-middle">0.00</td>
            <td class="item-vat-amount align-middle">0.00</td>
            <td class="item-total align-middle">0.00</td>
            <input type="hidden" name="items[${index}][amount]" class="item-amount-input">
            <input type="hidden" name="items[${index}][vat_amount]" class="item-vat-amount-input">
            <input type="hidden" name="items[${index}][total_amount]" class="item-total-input">
            <td class="align-middle"><button type="button" class="btn btn-danger btn-sm remove-item">×</button></td>
        `;
                table.appendChild(row);
                index++;

                row.querySelectorAll('.item-quantity, .item-price, .item-vat').forEach(input => {
                    input.addEventListener('input', () => recalcRow(row));
                    input.addEventListener('change', () => recalcRow(row));
                });

                row.querySelector('.remove-item').addEventListener('click', () => row.remove());
                recalcRow(row);
            }

            document.getElementById('addItem').addEventListener('click', () => addRow());

            // Инициализация старых строк
            table.querySelectorAll('tr').forEach(row => {
                row.querySelectorAll('.item-quantity, .item-price, .item-vat').forEach(input => {
                    input.addEventListener('input', () => recalcRow(row));
                    input.addEventListener('change', () => recalcRow(row));
                });
                row.querySelector('.remove-item').addEventListener('click', () => row.remove());
                recalcRow(row);
            });
        });
    </script>
@endpush
