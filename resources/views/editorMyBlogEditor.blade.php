@extends('editorTemplate')

@section('title', 'Редактор блога')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="namingIsMyMiddleNameMain">
        <h1 class="namingIsMyMiddleNameHeader"> Редактор блога </h1>

        <form id="form" class="namingIsMyMiddleNameForm" enctype="multipart/form-data" method="post" action="{{ route('editor.myBlogEditor.store') }}">
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

            <label for="title">Тема сообщения:</label>
            <input type="text" name="title" id="title" required>

            <label for="image">Изображение:</label>
            <input type="file" name="image" id="image">

            <label for="content">Текст сообщения:</label>
            <textarea name="content" id="content" rows="5" required></textarea>

            <input type="submit" value="Отправить">
        </form>

        <table class="namingIsMyMiddleNameTable">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Заголовок</th>
                    <th>Содержание</th>
                    <th>Изображение</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogPosts as $post)
                    <tr>
                        <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            @if ($post->image)
                                <img src="data:image/jpeg;base64,{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 40%;">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="namingIsMyMiddleNamePagination">
            {{ $blogPosts->links() }}
        </div>
    </main>
@endsection

