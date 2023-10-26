@extends('adminTemplate')

@section('title', 'Загрузка г. книги')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="mainForm">
        <h1> Загрузка гостевой книги </h1>

        <form id="form" method="post" enctype="multipart/form-data" action="{{ route('admin.guestBookUpload.upload') }}">
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

            <br><br><br><br>
            <label for="file">Выберите файл</label>
            <br><br>
            <input type="file" id="file" name="file">

            <br><br><br><br>
            <input type="submit" value="Отправить">
        </form>
    </main>
@endsection

