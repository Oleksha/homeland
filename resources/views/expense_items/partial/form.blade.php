@csrf

@if(isset($item))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label">Наименование</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $item->name ?? '') }}"
           required autofocus>
</div>

<div class="form-check mb-3">
    <input type="hidden" name="is_report_selection" value="0">
    <input type="checkbox"
           name="is_report_selection"
           class="form-check-input"
           id="is_report_selection"
           value="1"
        @checked(old(
           'is_report_selection',
           $item->is_report_selection ?? false
       ))>

    <label for="is_report_selection" class="form-check-label">
        Использовать в отчетах
    </label>
</div>

<button class="btn btn-primary">
    Сохранить
</button>
