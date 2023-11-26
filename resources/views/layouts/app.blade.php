<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="d-flex vh-100">
    <aside class="aside w-100 h-100 p-0">
        <div class="d-flex mb-3">
            <div class="aside__logo d-inline-flex p-3 border-bo bg-white">
                <x-logo></x-logo>
            </div>
            <p class="description align-self-center px-3 mb-0 text-white">Enterprise Resource Planning</p>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('home') }}"
                   class="nav-link active">Продукты</a>
            </li>
        </ul>
    </aside>
    <main class="main flex-grow-1 h-100">
        <header class="header bg-white">
            <div class="container-fluid header__container">
                <nav class="navbar bg-white p-0">
                    <ul class="nav gap-4">
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                               class="nav-link active px-0 py-3 text-uppercase">Продукты
                            </a>
                        </li>
                    </ul>
                    <div>
                        <h3 class="user-name m-0">{{ config('products.name') }}</h3>
                    </div>
                </nav>
            </div>
        </header>
        @yield('content')
    </main>
</div>
@if(isset($scripts))
    {{ $scripts }}
@endif
</body>
</html>
