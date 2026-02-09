@php
    $isActive = fn (...$routes) => request()->routeIs($routes)
        ? 'active'
        : '';
@endphp
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <x-icon width="40" height="32" name="logo" />
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('budgets.*') ? 'active' : '' }}"
                        href="{{ route('budgets.index') }}"
                    >
                        Бюджет
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('receipts.*') ? 'active' : '' }}"
                        href="{{ route('receipts.index') }}"
                    >
                        Поступления
                    </a>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle {{ request()->routeIs('payment-authorizations.*') ? 'active' :
                     '' }}"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <i class="bi bi-cash-stack"></i>
                        Платежи
                    </a>

                    <ul class="dropdown-menu">

                        <li>
                            <a class="dropdown-item"
                               href="{{ route('payment-authorizations.index') }}">
                                Разрешения на оплату
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle {{ $isActive('vats.*',
                         'contractor-types.*', 'directories.*', 'categories.*',
                         'contractors.*', 'expense-items.*', 'units.*',
                         'storage-locations.*') }}"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Справочники
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('directories.*') }}"
                                href="{{ route('directories.index') }}">
                                Все справочники
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('contractors.*') }}"
                                href="{{ route('contractors.index') }}"
                            >
                                Контрагенты
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('vats.*') }}"
                                href="{{ route('vats.index') }}"
                            >
                                НДС
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('contractor-types.*') }}"
                                href="{{ route('contractor-types.index') }}"
                            >
                                Типы контрагентов
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('expense-items.*') }}"
                                href="{{ route('expense-items.index') }}"
                            >
                                Статьи расходов
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('units.*') }}"
                                href="{{ route('units.index') }}"
                            >
                                Единицы измерения
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('storage-locations.*') }}"
                                href="{{ route('storage-locations.index') }}"
                            >
                                Места хранения
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item {{ $isActive('categories.*') }}"
                                href="{{ route('categories.index') }}"
                            >
                                Категории номенклатуры
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
