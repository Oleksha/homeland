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
                <li>
                    <a
                        class="nav-item nav-link"
                        href="{{ url('dashboard') }}"
                    >
                        Дашбоард
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle {{ $isActive('vats.*', 'contractor-types.*') }}"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Справочники
                    </a>
                    <ul class="dropdown-menu">
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
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
