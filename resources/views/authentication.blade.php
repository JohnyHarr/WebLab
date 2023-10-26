@extends('template')

@section('title', 'Авторизация')

@section('script')
    <script>
        function setupAreYouSureWindow() {
            let areYouSureWindow = $('<div class="areYouSureWindow" id="areYouSure"><p> Вы уверены? </p> <div id="YES"> ДА </div> <div id="NO"> НЕТ </div></div>').hide();
            $('#form').append(areYouSureWindow);

            $('#YES').mouseenter(function() {
                $(this).css('backgroundColor', "darkgreen")
            });
            $('#NO').mouseenter(function() {
                $(this).css('backgroundColor', "darkred")
            });
            $('#YES').add('#NO').mouseleave(function() {
                $(this).css('backgroundColor', "rgb(255, 175, 63)")
            });
        }

        function hideOK() {
            $('#areYouSure').fadeOut('fast');
        }
    </script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="mainForm" style="padding-top: 5px;">
        <h1 style="margin-bottom: 5px;"> Авторизация </h1>
        <br>

        <form id="form" method="post" action="{{route('authenticate')}}">
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

            <input type="text" placeholder="Почта" name="email" id="email">
            <br><br>
            <input type="password" placeholder="Пароль" name="password" id="password">
            <br><br>
            <input type="submit" value="Авторизоваться" id="submitButton">
            <a href="{{route('registration')}}"><p>Регистрация</p></a>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
