@extends('adminTemplate')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Редактор блога')

@section('script')
    <script src="{{ asset('./js/testScript.js') }}" defer></script>
    <script>

        $(document).ready(function () {
            function setupUpdate() {
                document.querySelectorAll('.update-post').forEach(button => {
                    button.addEventListener('click', function () {
                        const postId = this.dataset.postId;

                        const postElement = document.getElementById('post-' + postId);
                        const title = postElement.querySelector('.post-title').innerText;
                        const content = postElement.querySelector('.post-content').innerText;
                        const imgBlog = postElement.querySelector('.blogImage');
                        let img = '';
                        if (imgBlog && !imgBlog.src.startsWith('data:image/jpeg;base64')) {
                            img = imgBlog.src;
                        }
                        document.getElementById('edit-id').value = postId;
                        document.getElementById('edit-title').value = title;
                        document.getElementById('edit-content').value = content;
                        document.getElementById('imgUrlChange').value = img;
                        document.getElementById('areYouSure').style.display = 'block';
                    });
                });
            }

            function setupDeleteButtons() {
                document.querySelectorAll('.delete-post').forEach(button => {
                    button.addEventListener('click', function () {
                        const postId = this.dataset.postId;

                        fetch('/admin/myBlogEditor/delete/' + postId, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/xml',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                        })
                            .then(response => response.text())
                            .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
                            .then(data => {
                                const status = data.getElementsByTagName('status')[0].textContent;
                                const message = data.getElementsByTagName('message')[0].textContent;

                                if (status === 'success') {
                                    const postElement = document.getElementById('post-' + postId);
                                    postElement.remove();
                                } else {
                                    console.error('Failed to delete post: ' + message);
                                }
                            });
                    });
                });
            }

            function createNewBlog(content, title, imgString, useURL) {
                console.log(imgString);
                const xml = `
                    <post>
                        <title>${title}</title>
                        <content>${content}</content>
                        <image>${imgString}</image>
                        <useURL>${useURL}</useURL>
                    </post>
                `;

                fetch('/admin/myBlogEditor/storeXML', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/xml',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: xml
                })
                    .then(response => response.text())
                    .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
                    .then(data => {
                        document.getElementById('form').reset();
                        const postElement = document.createElement("tr");
                        const postTitle = document.createElement('td')
                        postTitle.classList.add('post-title');
                        const date = data.getElementsByTagName('date')[0].textContent;
                        const id = data.getElementsByTagName('id')[0].textContent;
                        const postContent = document.createElement('td');
                        const postDate = document.createElement('td');
                        const postImgCell = document.createElement('td');
                        const changeButton = document.createElement('td');
                        const deleteButton = document.createElement('td');
                        postContent.classList.add('post-content');
                        postTitle.innerText = title;
                        postContent.innerText = content;
                        postContent.id = id;
                        postDate.innerText = date;
                        changeButton.innerHTML = '<a class="update-post" data-post-id="' + id + '">Изменить</a>';
                        deleteButton.innerHTML = '<a class="delete-post" data-post-id="' + id + '">Удалить</a>';
                        console.log('before img:' + imgString);
                        if (imgString !== "" && useURL === false) {
                            postImgCell.innerHTML = '<img src="data:image/jpeg;base64,' + imgString + '" alt="' + title + '" style="max-width: 40%;" class="blogImage"">'
                        }
                        if (useURL === true && imgString !== "") {
                            postImgCell.innerHTML = '<img src="' + imgString + '" alt="' + title + '" style="max-width: 40%;" class="blogImage">'
                        }
                        postElement.id = 'post-' + id;
                        postElement.appendChild(postDate);
                        postElement.appendChild(postTitle);
                        postElement.appendChild(postContent);
                        postElement.appendChild(postImgCell);
                        postElement.appendChild(changeButton);
                        postElement.appendChild(deleteButton);
                        document.getElementById('tbodyid').appendChild(postElement);
                        setupDeleteButtons();
                        setupUpdate();
                    });
            }

            document.getElementById('submit-post').addEventListener('click', function () {
                const postId = document.getElementById('edit-id').value;
                const title = document.getElementById('edit-title').value;
                const content = document.getElementById('edit-content').value;
                const imageFile = document.getElementById('imageChange').files[0];
                const imgURL = document.getElementById('imgUrlChange').value;
                const blogImg = document.getElementById('post-' + postId).querySelector('.blogImage');
                let imgString = '';
                if (blogImg) {
                    imgString = blogImg.src.replace('data:image/jpeg;base64,', '');
                }
                if (imgURL === "") {
                    let reader = new FileReader();
                    reader.onload = function () {
                        imgString = reader.result.replace("data:", "")
                            .replace(/^.+,/, "");
                    }
                    if (imageFile) {
                        reader.readAsDataURL(imageFile);
                        reader.onloadend = function () {
                            updatePost(postId, content, title, imgString, false);
                        }
                    } else {
                        updatePost(postId, content, title, imgString, false);
                    }
                } else {
                    updatePost(postId, content, title, imgURL, true);
                }
            });

            function updatePost(postId, content, title, imgString, useURL) {
                console.log('update/' + imgString);
                const xml = `
                    <post>
                        <id>${postId}</id>
                        <title>${title}</title>
                        <content>${content}</content>
                        <image>${imgString}</image>
                        <useURL>${useURL}</useURL>
                    </post>
                `;

                fetch('/admin/myBlogEditor/update', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/xml',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: xml
                })
                    .then(response => response.text())
                    .then(data => {
                        const postElement = document.getElementById('post-' + postId);
                        postElement.querySelector('.post-title').innerText = title;
                        postElement.querySelector('.post-content').innerText = content;
                        let postImg = postElement.querySelector('.blogImage');
                        if (postImg) {
                            postImg.remove()
                        }
                        if (imgString !== '') {
                            postImg = document.createElement('img');
                            postImg.classList.add('blogImage');
                            postImg.style.maxWidth = '40%';
                            postElement.querySelector('.imgContainer').appendChild(postImg);
                        }
                        if (useURL === false && imgString !== "") {
                            postImg.src = "data:image/jpeg;base64," + imgString;
                        }
                        if (useURL === true && imgString !== "") {
                            postImg.src = imgString;
                        }
                        document.getElementById('areYouSure').style.display = 'none';
                    });
            }

            document.getElementById('deleteImage').addEventListener('click', function (){
                const id = document.getElementById('edit-id').value;
                const image = document.getElementById('post-'+id).querySelector('.blogImage');
                if(image){
                    image.remove();
                    document.getElementById('imgUrlChange').value = '';
                }
            })

            document.getElementById('form').addEventListener('submit', function (event) {
                event.preventDefault();
                console.log('click');
                const title = document.getElementById('title').value;
                const content = document.getElementById('content').value;
                const imageFile = document.getElementById('image').files[0];
                const imageURL = document.getElementById('imgUrl').value;
                let imgString = ""
                if (imageURL === "") {
                    let reader = new FileReader();
                    reader.onload = function () {
                        imgString = reader.result.replace("data:", "")
                            .replace(/^.+,/, "");
                    }
                    if (imageFile) {
                        reader.readAsDataURL(imageFile);
                        reader.onloadend = function () {
                            createNewBlog(content, title, imgString, false);
                        }
                    } else {
                        createNewBlog(content, title, imgString, false);
                    }
                } else {
                    createNewBlog(content, title, imageURL, true);
                }

            })
            setupUpdate()
            setupDeleteButtons();
        });
    </script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="namingIsMyMiddleNameMain">
        <h1 class="namingIsMyMiddleNameHeader"> Редактор блога </h1>

        <form id="form" class="namingIsMyMiddleNameForm">
            @csrf

            @if(session('success'))
                <div class="areYouSureWindow" id="areYouSure">
                    <p> {{ session('success') }} </p>
                    <div id="YES" onclick="hideOK()"> ОК</div>
                </div>
            @endif

            @if($errors->any())
                <div class="areYouSureWindow" id="areYouSure">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <div id="NO" onclick="hideOK()"> ОК</div>
                </div>
            @endif

            <label for="title">Тема сообщения:</label>
            <input type="text" name="title" id="title" required>

            <label for="image">Изображение:</label>
            <input type="file" name="image" id="image">
            <input type="text" id="imgUrl" placeholder="url картинки">
            <label for="content">Текст сообщения:</label>
            <textarea name="content" id="content" rows="5" required></textarea>
            <input type="submit" id="create_post" value="Отправить">
        </form>
        <table class="namingIsMyMiddleNameTable">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Заголовок</th>
                <th>Содержание</th>
                <th>Изображение</th>
                <th>_</th>
                <th>_</th>
            </tr>
            </thead>
            <tbody id="tbodyid">
            @foreach($blogPosts as $post)
                <tr class="post" id="post-{{ $post->id }}">
                    <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                    <td class="post-title">{{ $post->title }}</td>
                    <td class="post-content">{{ $post->content }}</td>
                    <td class="imgContainer">
                        @if ($post->image !== "" and $post->useURL === 0)
                            <img src="data:image/jpeg;base64,{{ $post->image }}" alt="{{ $post->title }}"
                                 style="max-width: 40%;" class="blogImage">
                        @elseif($post->image !== "" and $post->useURL === 1)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                 style="max-width: 40%;" class="blogImage">
                    @endif
                    <td>
                        <a class="update-post" data-post-id="{{ $post->id }}">Изменить</a>
                    </td>
                    <td>
                        <a class="delete-post" data-post-id="{{ $post->id }}">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="namingIsMyMiddleNamePagination">
            {{ $blogPosts->links() }}
        </div>

        <div class="areYouSureWindow" id="areYouSure" style="display: none;">
            <p style="text-align: center;"> Измените пост: </p>
            <input type="hidden" id="edit-id"></input>
            <input type="text" id="edit-title"></input>
            <br><br>
            <textarea cols="28" , rows="4" type="text" id="edit-content"></textarea>
            <br>
            <button id="deleteImage">Удалить картинку</button>
            <input type="file" name="image" id="imageChange">
            <input type="text" id="imgUrlChange" placeholder="url картинки">
            <button id="submit-post">Сохранить</button>
        </div>
    </main>
@endsection


