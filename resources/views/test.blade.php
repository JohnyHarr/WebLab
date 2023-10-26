@extends('template')

@section('title', 'Тест')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
<main id="mainInfo" class="mainForm">
            <h1> Тест по физике </h1>

            <form id="form" method="post" action="{{ route('test.store') }}" onsubmit="return validateForm()">
                @csrf

                @if(session('success'))
                    <div class="areYouSureWindow" id="areYouSure">
                        <p> {{ session('success') }} </p>
                        <div id="YES" onclick="hideOK()"> ОК </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="areYouSureWindow" id="areYouSure">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <div id="NO" onclick="hideOK()"> ОК </div>
                    </div>
                @endif

                <label for="ФИО"> ФИО: </label>
                <input type="text" placeholder="..." id="ФИО" name="name">

                <br><br>
                <label for="Группа"> Группа: </label>
                <input type="text" placeholder="..." id="Группа" name="group">

                <br>
                <p> <label for="Вопрос-1"> 1) Формула эквивалентности массы и энергии? </label> </p>
                <input type="text" placeholder="..." id="Вопрос-1" name="question1">

                <br>
                <p> 2) Скорость света в вакууме? </p>
                <label for="Вопрос-2a"> 300 000 км/c </label>
                <input type="checkbox" id="Вопрос-2a" name="question2a" value="300 000 км/c">
                <label for="Вопрос-2b"> 299 792 458 м/c </label>
                <input type="checkbox" id="Вопрос-2b" name="question2b" value="299 792 458 м/c">

                <br><br>
                <label for="Вопрос-3"> 3) Выберите неподходящую своей группе частицу: </label>
                <br><br>
                <select id="Вопрос-3" name="question3">
                    <option value="" disabled selected> ... </option>

                    <optgroup label="Кварки">
                        <option value="Верхний"> Верхний </option>
                        <option value="Прелестный"> Прелестный </option>
                    </optgroup>

                    <optgroup label="Лептоны">
                        <option value="Электрон"> Электрон </option>
                        <option value="Бозон Хиггса"> Бозон Хиггса </option>
                    </optgroup>
                </select>

                <br><br>
                <input type="reset" value="Очистить форму">

                <br><br>
                <input type="submit" value="Отправить">
              </form>
        </main>
@endsection

