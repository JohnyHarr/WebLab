@extends('template')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Мой блог')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            document.querySelectorAll('.add-comment').forEach(function(button) {
                button.addEventListener('click', function() {
                    var modal = document.getElementById('areYouSure');
                    modal.style.display = 'block';
                    modal.dataset.postId = this.dataset.postId;
                });
            });

            document.getElementById('submit-comment').addEventListener('click', function() {
                var modal = document.getElementById('areYouSure');
                var postId = modal.dataset.postId;
                var comment = document.getElementById('comment-input').value;
                var image = document.getElementById('image-input').files[0];

                var formData = new FormData();
                formData.append('comment', comment);
                formData.append('image', image);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/myBlog/storeComment?postId=' + postId);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
                xhr.send(formData);
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        var post = document.getElementById('post-' + postId);
                        post.querySelector('.post-comment').innerHTML = '<p>' + response.created_at + '</p><p>' + response.username + '</p><p>' + response.comment + '</p><img src="data:image/jpeg;base64,' + response.image + '" style="max-width: 40%;">';
                        ;
                        modal.style.display = 'none';
                        document.getElementById('comment-input').value = '';
                    } else {
                        alert('Ошибка при отправке комментария');
                    }
                };
            });
        });
    </script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="namingIsMyMiddleNameMain" style='grid-template-areas: "namingIsMyMiddleNameHeader" "namingIsMyMiddleNameTable" "namingIsMyMiddleNamePagination"; grid-template-columns: 1fr;'>
        <h1 class="namingIsMyMiddleNameHeader"> Мой блог </h1>

        <table class="namingIsMyMiddleNameTable">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Заголовок</th>
                <th>Содержание</th>
                <th>Изображение</th>
                <th>Комментарий</th>
                <th>_</th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogPosts as $post)
                <tr class="post" id="post-{{ $post->id }}">
                    <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        @if ($post->image)
                            <img src="data:image/jpeg;base64,{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 40%;">
                        @endif
                    </td>
                    <td class="post-comment">
                        @if ($post->randomComment)
                            <p>{{ $post->randomComment->created_at }}</p>
                            <p>{{ $post->randomComment->user->name }}</p>
                            <p>{{ $post->randomComment->comment }}</p>
                            @if ($post->randomComment->image)
                                <img src="data:image/jpeg;base64,{{ $post->randomComment->image }}" style="max-width: 40%;">
                            @endif
                        @endif
                    </td>
                    <td>
                        @if (Auth::check())
                            <a class="add-comment" data-post-id="{{ $post->id }}">Добавить комментарий</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="namingIsMyMiddleNamePagination">
            {{ $blogPosts->links() }}
        </div>

        <div class="areYouSureWindow" id="areYouSure" style="display: none;">
            <p style="text-align: center;"> Оставьте комментарий: </p>
            <textarea cols="28", rows="4" type="text" id="comment-input"></textarea>
            <br>
            <label for="image-input">Добавьте изображение:</label>
            <input type="file" name="image-input" id="image-input">
            <br>
            <button id="submit-comment">Отправить</button>
        </div>
    </main>
@endsection


