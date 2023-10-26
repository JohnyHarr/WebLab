@extends('template')

@section('title', 'Мои интересы')

@section('content')
    <aside id="galleryNav">
        <ul>
            <li> <a href="#{{ $interests::MANGA_LN }}"> <img src="{{ $interests::BOOK_ICON }}" alt="{{ $interests::BOOK }}"> </a> </li>
            <li> <a href="#{{ $interests::VIDEOGAMES }}"> <img src="{{ $interests::CONSOLE_ICON }}" alt="{{ $interests::CONSOLE }}"> </a> </li>
        </ul>
    </aside>

    <main id="mainInfo">
        <h1> {{ $interests::DESCRIPTION }} </h1>
       <section>
            <h2 id="{{ $interests::MANGA_LN }}">{{ $interests::MANGA_LN_TITLE }}</h2>
            <div class="grid3xN">
                @foreach ($interests->mangaLNImgs as $img)
                    <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" title="{{ $img['name'] }}">
                @endforeach
            </div>
        </section>

        <section>
            <h2 id="{{ $interests::VIDEOGAMES }}">{{ $interests::VIDEOGAMES_TITLE }}</h2>
            <div class="grid3xN">
                @foreach ($interests->videogameImgs as $img)
                    <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" title="{{ $img['name'] }}">
                @endforeach
            </div>
        </section>

    </main>
@endsection