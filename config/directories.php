<?php

return [

    'vats' => [
        'title' => 'НДС',
        'description' => 'Справочник ставок налога на добавленную стоимость',
        'icon' => 'percent',
        'route' => 'vats.index',
        'model' => \App\Models\Vat::class,
        'soft_delete' => false,
    ],

    'contractor_types' => [
        'title' => 'Типы контрагентов',
        'description' => 'Юридическое лицо, ИП, физическое лицо и др.',
        'icon' => 'people',
        'route' => 'contractor-types.index',
        'model' => \App\Models\ContractorType::class,
        'soft_delete' => false,
    ],

    'contractors' => [
        'title' => 'Контрагенты',
        'description' => 'Поставщики, покупатели и прочие контрагенты',
        'icon' => 'briefcase',
        'route' => 'contractors.index',
        'model' => \App\Models\Contractor::class,
        'soft_delete' => true,
    ],

];
