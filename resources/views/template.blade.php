<!DOCTYPE html>

<html lang="ru">
    <head>
        <meta charset="utf-8">
        @yield('meta')
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('./css/style.css') }}">
        <script src="{{ asset('./js/jquery-3.6.2.min.js') }}"></script>
        @yield('script')
        <script src="{{ asset('./js/menuScript.js') }}" defer></script>
        <script src="{{ asset('./js/localStorageAndCookiesScript.js') }}"></script>
    </head>

    <?php
        if ((View::getSection('title') === 'Галерея') || (View::getSection('title') === 'Мои интересы')) {
            $id = 'gridHiddenScroll';
        } else {
            $id = 'gridNoScroll';
        }
    ?>

    <body id="{{ $id }}" onload="updateLocalStorageAndCookies()">
        @yield('backgroundVideo')

        <nav id="navHeader">
            <ul id="navList">
                <li> <a href="{{ route('home') }}"> Главная страница </a> </li>
                <li> <a href="{{ route('aboutMe') }}"> Обо мне </a> </li>
                <li> <a href="{{ route('hobbies') }}" id="hobbiesDropdownMenu"> Мои интересы </a> </li>
                <li> <a href="{{ route('study') }}"> Учебный план </a> </li>
                <li> <a href="{{ route('gallery') }}"> Галерея </a> </li>
                <li> <a href="{{ route('feedback') }}"> Обратная связь </a> </li>
                <li> <a href="{{ route('test') }}"> Тест </a> </li>
                <li> <a href="{{ route('history') }}"> История </a> </li>
                <li> <a href="{{ route('guestBook') }}"> Гостевая книга </a> </li>
                <li> <a href="{{ route('myBlog') }}"> Мой блог </a> </li>
                @if (auth()->check())
                    <li> <a href="{{ route('logout') }}"> Выйти </a> </li>
                    <li> <a href="javascript:void(0)"> {{auth()->user()->name}} </a></li>
                @else
                    <li> <a href="{{ route('authentication') }}"> Войти </a> </li>
                @endif
            </ul>
        </nav>

        @yield('content')

        @yield('footer')
    </body>
</html>
