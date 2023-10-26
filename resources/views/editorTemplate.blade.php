<!DOCTYPE html>

<html lang="ru">
    <head>
        <meta charset="utf-8">
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
                <li> <a href="{{ route('editor.editorHome') }}"> Главная страница </a> </li>
                <li> <a href="{{ route('editor.editorMyBlogEditor') }}"> Редактор блога </a> </li>
            </ul>
        </nav>

        @yield('content')

        @yield('footer')
    </body>
</html>