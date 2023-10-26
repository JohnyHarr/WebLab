@extends('template')

@section('title', 'Гостевая книга')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="namingIsMyMiddleNameMain">
        <h1 class="namingIsMyMiddleNameHeader"> Гостевая книга </h1>

        <form id="form" class="namingIsMyMiddleNameForm" method="post" action="{{ route('guestBook.store') }}">
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

            <label>Фамилия</label>
            <input type="text" name="surname" required>

            <label>Имя</label>
            <input type="text" name="name" required>

            <label>Отчество</label>
            <input type="text" name="patronymic" required>

            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Текст отзыва</label>
            <textarea name="message" rows="5" required></textarea>

            <input type="submit" value="Отправить">
        </form>

        <table class="namingIsMyMiddleNameTable">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Текст отзыва</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message['date'] }}</td>
                        <td>{{ $message['name'] }}</td>
                        <td>{{ $message['email'] }}</td>
                        <td>{{ $message['message'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="namingIsMyMiddleNamePagination">
            {{ $messages->links('pagination::bootstrap-4') }}
        </div>
    </main>
@endsection


