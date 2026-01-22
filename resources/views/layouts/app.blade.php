<!doctype html>
<html lang="ru" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Приложение')</title>

    <!-- Bootstrap 5 -->
    <link
        href="{{ asset('/assets/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/toastr/toastr.min.css') }}">
    <script type="text/javascript"
            src="{{ asset('/assets/jquery-3.7.1/jquery-3.7.1.min.js') }}"></script>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <x-icon width="40" height="32"  name="logo" />
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Справочники
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('vats.index') }}">
                                НДС
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('contractor-types.index') }}">
                                Типы контрагентов
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-4 flex-grow-1">
    @yield('content')
</main>

<x-footer />

<button
    id="themeToggle"
    class="btn btn-outline-secondary btn-sm position-fixed shadow d-flex align-items-center justify-content-center"
    type="button"
    title="Сменить тему"
    style="bottom: 1rem; right: 1rem; z-index: 1030;"
>
    <span class="icon-light">
        <x-icon class="d-block" name="sun-icon" />
    </span>
    <span class="icon-dark d-none">
        <x-icon class="d-block" name="moon-icon" />
    </span>
</button>
<!-- Bootstrap 5 -->
<script src="{{ asset('/assets/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        @if(Session::has('success'))
        toastr.success("{{ session('success') }}", "Успешно!");
        @endif
        @if(Session::has('errors'))
        toastr.error("{{ session('errors') }}", "Ошибка!");
        @endif
    });
</script>
<script>
    (function () {
        const html = document.documentElement;
        const toggle = document.getElementById('themeToggle');

        if (!toggle) return;

        const storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            html.setAttribute('data-bs-theme', storedTheme);
        }

        toggle.addEventListener('click', function () {
            const current = html.getAttribute('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            const isDark = next === 'dark';
            toggle.querySelector('.icon-light').classList.toggle('d-none', !isDark);
            toggle.querySelector('.icon-dark').classList.toggle('d-none', isDark);

            html.setAttribute('data-bs-theme', next);
            localStorage.setItem('theme', next);
        });
    })();
</script>
</body>
</html>
