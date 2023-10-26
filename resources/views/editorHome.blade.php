@extends('editorTemplate')

@section('title', 'Главная страница')

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo">
        <h1> Лабораторная работа №10 </h1>

        <h2> "Исследование механизма сессий в PHP" </h2>

        <h3> Редактор </h3>
    </main>
@endsection


