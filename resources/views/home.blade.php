@extends('template')

@section('title', 'Главная Страница')

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">

@endsection

@section('content')
    <main id="mainInfo">
        <h1> Лабораторная работа №8 </h1>

        <h2> "Исследование архитектуры MVC приложения и возможностей обработки данных HTML-форм на стороне сервера с использованием языка PHP" </h2>

        <h3> Воронухин Александр Александрович </h3>
        <h3> ИС/б-20-2-о </h3>
    </main>
@endsection


