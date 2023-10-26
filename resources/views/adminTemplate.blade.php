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
    </head>

    <body id="gridNoScroll">
        @yield('backgroundVideo')

        <nav id="navHeader">
            <ul id="navList">
                <li> <a href="{{ route('admin.adminHome') }}"> Главная страница </a> </li>
                <li> <a href="{{ route('admin.guestBookUpload') }}"> Загрузка г. книги </a> </li>
                <li> <a href="{{ route('admin.myBlogUpload') }}"> Загрузка з. блога </a> </li>
                <li> <a href="{{ route('admin.myBlogEditor') }}"> Редактор блога </a> </li>
                <li> <a href="{{ route('admin.visitors') }}"> Статистика посещений </a> </li>
                <li> <a href="{{ route('logout') }}"> Выйти </a> </li>
            </ul>
        </nav>

        @yield('content')

        @yield('footer')
    </body>
</html>
