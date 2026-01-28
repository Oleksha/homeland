{{-- Общая информация --}}
<div class="tab-pane fade" id="main" role="tabpanel">
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
