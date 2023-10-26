@extends('template')

@section('title', 'Обо мне')

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo">
        <h1> Обо мне </h1>
        <p> Фамилия: Воронухин </p>
        <p> Имя: Александр </p>
        <p> Отчество: Александрович </p>
        <p> Пол: муж. </p>
        <p> Дата рождения: 15.03.2003 </p>
        <p> Место рождения: гор. Симферополь.</p>
    </main>
@endsection


