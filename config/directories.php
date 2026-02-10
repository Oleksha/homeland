<?php

return [

    'vats' => [
        'title' => 'НДС',
        'description' => 'Справочник ставок налога на добавленную стоимость',
        'icon' => 'percent',
        'route' => 'vats.index',
        'model' => \App\Domains\Vat\Models\Vat::class,
        'soft_delete' => false,
    ],

    'contractor_types' => [
        'title' => 'Типы контрагентов',
        'description' => 'Юридическое лицо, ИП, физическое лицо и др.',
        'icon' => 'people',
        'route' => 'contractor-types.index',
        'model' => \App\Domains\ContractorType\Models\ContractorType::class,
        'soft_delete' => false,
    ],

    'contractors' => [
        'title' => 'Контрагенты',
        'description' => 'Поставщики, покупатели и прочие контрагенты',
        'icon' => 'briefcase',
        'route' => 'contractors.index',
        'model' => \App\Domains\Contractor\Models\Contractor::class,
        'soft_delete' => true,
    ],

    'expense-items' => [
        'title' => 'Статьи расхода',
        'description' => 'Справочник статей для учета затрат и формирования отчетов.',
        'route' => 'expense-items.index',
        'model' => \App\Domains\ExpenseItem\Models\ExpenseItem::class,
        'icon' => 'bi bi-wallet2',
        'soft_delete' => true,
    ],

    'units' => [
        'title' => 'Единицы измерения',
        'description' => 'Справочник единиц измерения для складских операций и формирования отчетов.',
        'route' => 'units.index',
        'model' => \App\Domains\Unit\Models\Unit::class,
        'icon' => 'bi bi-wallet2',
        'soft_delete' => true,
    ],

    'storage-locations' => [
        'title' => 'Места хранения',
        'description' => 'Справочник мест хранения для складских операций и формирования отчетов.',
        'route' => 'storage-locations.index',
        'model' => \App\Domains\StorageLocation\Models\StorageLocation::class,
        'icon' => 'bi bi-wallet2',
        'soft_delete' => true,
    ],

    'categories' => [
        'title' => 'Категории номенклатуры',
        'description' => 'Справочник категорий номенклатуры для складских операций и формирования отчетов.',
        'route' => 'categories.index',
        'model' => \App\Domains\Category\Models\Category::class,
        'icon' => 'bi bi-wallet2',
        'soft_delete' => true,
    ],

    'nomenclatures' => [
        'title' => 'Номенклатура',
        'description' => 'Справочник номенклатуры для складских операций и формирования отчетов.',
        'route' => 'nomenclatures.index',
        'model' => \App\Domains\Nomenclature\Models\Nomenclature::class,
        'icon' => 'bi bi-wallet2',
        'soft_delete' => true,
    ],

];
