@extends('template')

@section('title', 'История')

@section('script')
    <script src="{{ asset('./js/historyScript.js') }}" defer></script>
@endsection

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo">
        <h2> История текущего сеанса </h2>
        <table id="tableCurrenSession">
            <thead>
                <tr>
                    <th></th>
                    <th>Главная страница</th>
                    <th>Обо мне</th>
                    <th>Мои интересы</th>
                    <th>Учебный план</th>
                    <th>Галерея</th>
                    <th>Обратная связь</th>
                    <th>Тест</th>
                    <th>История</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th> Кол-во <br> посещений </th>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                </tr>
            </tbody>
        </table>

        <br><br>
        <h2> История за всё время </h2>
        <table id="tableAllSessions">
            <thead>
                <tr>
                    <th></th>
                    <th> Главная страница </th>
                    <th> Обо мне </th>
                    <th> Мои интересы </th>
                    <th> Учебный план </th>
                    <th> Галерея </th>
                    <th> Обратная связь </th>
                    <th> Тест </th>
                    <th> История </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th> Кол-во <br> посещений </th>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                </tr>
            </tbody>
        </table>
    </main>
@endsection

