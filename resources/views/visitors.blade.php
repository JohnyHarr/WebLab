@extends('adminTemplate')

@section('title', 'Статистика посещений')

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo" class="namingIsMyMiddleNameMain" style='grid-template-areas: "namingIsMyMiddleNameHeader" "namingIsMyMiddleNameTable" "namingIsMyMiddleNamePagination"; grid-template-columns: 1fr;'>
        <h1 class="namingIsMyMiddleNameHeader"> Статистика посещений </h1>

        <table class="namingIsMyMiddleNameTable">
            <thead>
                <tr>
                    <th>Время посещения</th>
                    <th>Страница</th>
                    <th>IP-адрес</th>
                    <th>Имя хоста</th>
                    <th>Название браузера</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $visitor->page }}</td>
                        <td>{{ $visitor->ip }}</td>
                        <td>{{ $visitor->hostname }}</td>
                        <td>{{ $visitor->browser }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="namingIsMyMiddleNamePagination">
            {{ $visitors->links() }}
        </div>
    </main>
@endsection


