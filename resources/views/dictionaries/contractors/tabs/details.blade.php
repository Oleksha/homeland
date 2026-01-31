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
