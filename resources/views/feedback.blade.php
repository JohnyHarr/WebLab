@extends('template')

@section('title', 'Обратная связь')

@section('script')
    <script src="{{ asset('./js/feedbackScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="mainForm" style="padding-top: 5px;">
        <h1 style="margin-bottom: 5px;"> Форма обратной связи </h1>

        <form id="form" method="post" action="{{ route('feedback.store') }}">
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

            <label for="Name"> ФИО: </label>
            <input type="text" placeholder="..." id="Name" name="Name">

            <br>
            <p style="display:inline"> Пол: </p>
            <label for="Male"> &ensp; М </label>
            <input type="radio" id="Gender" name="Gender" value="Male">
            <label for="Female"> &ensp; Ж </label>
            <input type="radio" id="Gender" name="Gender" value="Female">
            <label for="Secret"> &ensp; ? </label>
            <input type="radio" id="Gender" name="Gender" value="Secret" checked="checked">

            <label for="Age"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Возраст:</label>
            <select id="Age" name="Age">
                <option value="" disabled selected> ... </option>
                <option value="<14"> &lt;14 </option>
                <option value="14-17"> 14-17 </option>
                <option value="18-29"> 18-29 </option>
                <option value="30-49"> 30-49 </option>
                <option value="50-59"> 50-59 </option>
                <option value=">59"> &gt;59 </option>
            </select>

            <br>
            <label for="BirthDate" id="calendar"> Дата рождения:</label>
            <input type="text" placeholder="..." id="BirthDate" name="BirthDate">

            <br>
            <p> <label for="Message"> Ваше сообщение: </label> </p>
            <textarea id="Message" name="Message" cols="36" rows="6" placeholder="..."></textarea>

            <br>
            <p> <label for="Mail"> Ваш адрес электронной почты: </label> </p>
            <input type="text" placeholder="..." id="Mail" name="Mail">
            <br>
            <p> <label for="PhoneNumber"> Ваш телефон: </label> </p>
            <input type="text" placeholder="..." id="PhoneNumber" name="PhoneNumber">

            <br><br>
            <input type="reset" value="Очистить форму" onclick="didTapResetButton()">

            <br><br>
            <input type="button" value="Отправить" id="submitButton">
            </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection


