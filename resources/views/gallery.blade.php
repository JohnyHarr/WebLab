@extends('template')

@section('title', 'Галерея')

@section('script')

@endsection

@section('content')
    <aside id="galleryNav">
        <ul>
            <li> <a href="#{{ $photos::STABLE }}"> <p>{{ $photos::STABLE_TITLE }}</p> </a> </li>
            <li> <a href="#{{ $photos::DALLE }}"> <p>{{ $photos::DALLE_TITLE }}</p> </a> </li>
        </ul>
    </aside>

    <main id="mainInfo">
        <h1>{{ $photos::DESCRIPTION }}</h1>
        <section>
            <h2 id="{{ $photos::STABLE }}">{{ $photos::STABLE_TITLE }}</h2>
            <div id="{{ $photos::STABLE }}Grid" class="grid4xN">
                @foreach ($photos->stablePhotos as $photo)
                    <img src="{{ $photo['url'] }}" alt="{{ $photo['name'] }}" title="{{ $photo['name'] }}">
                @endforeach
            </div>
        </section>

        <section>
            <h2 id="{{ $photos::DALLE }}">{{ $photos::DALLE_TITLE }}</h2>
            <div id="{{ $photos::DALLE }}Grid" class="grid4xN">
                @foreach ($photos->dallePhotos as $photo)
                    <img src="{{ $photo['url'] }}" alt="{{ $photo['name'] }}" title="{{ $photo['name'] }}">
                @endforeach
            </div>
        </section>
    </main>
@endsection
