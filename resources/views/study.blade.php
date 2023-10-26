@extends('template')

@section('title', 'Учебный план')

@section('backgroundVideo')
    <img src="{{asset('./assets/bg2.jpg')}}" alt="background" id="lamps">
@endsection

@section('content')
    <main id="mainInfo">
        <h2> Севастопольский государственный университет </h2>
        <h2> Кафедра "Информационные системы" </h2>
        <h3> Перечень изучаемых дисциплин с 1-го по 4-ый семестр </h3>

        <table>
            <thead>
                <tr>
                    <th rowspan="3"> № </th>
                    <th rowspan="3"> Дисциплина </th>
                    <th colspan="12"> Часов в неделю <br> (Лекций, Лаб. раб., Практ. раб.) </th>
                </tr>
                <tr>
                    <th colspan="6"> 1 курс </th>
                    <th colspan="6"> 2 курс </th>
                </tr>
                <tr>
                    <th colspan="3"> 1 сем. </th>
                    <th colspan="3"> 2 сем. </th>
                    <th colspan="3"> 3 сем. </th>
                    <th colspan="3"> 4 сем. </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> 1 </td>
                    <td> Экология </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> 1 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 2 </td>
                    <td> Высшая математика </td>
                    <td> 3 </td>
                    <td> 0 </td>
                    <td> 3 </td>
                    <td> 3 </td>
                    <td> 0 </td>
                    <td> 3 </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 3 </td>
                    <td> Русский язык и культура речи </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 4 </td>
                    <td> Основы дискретной математики </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 1 </td>
                    <td> 3 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 5 </td>
                    <td> Основы программирования и алгоритмические языки </td>
                    <td> 3 </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 3 </td>
                    <td> 3 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 1 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 6 </td>
                    <td> Основы экологии </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 7 </td>
                    <td> Теория вероятностей и математическая статистика </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 3 </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 8 </td>
                    <td> Физика </td>
                    <td> 2 </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 9 </td>
                    <td> Основы электротехники и электроники </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 2 </td>
                    <td> 1 </td>
                    <td> 1 </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                </tr>
                <tr>
                    <td> 10 </td>
                    <td> Численные методы в информатике </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 2 </td>
                    <td> 2 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 0 </td>
                    <td> 1 </td>
                </tr>
                <tr>
                    <td> 11 </td>
                    <td> Методы исследования операций </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> &nbsp; </td>
                    <td> 1 </td>
                    <td> 1 </td>
                    <td> 0 </td>
                    <td> 2 </td>
                    <td> 1 </td>
                    <td> 1 </td>
                </tr>
            </tbody>
        </table>

        <br>
        <h3> <a href="{{ asset('./') }}/pageTest/testPage.html"> Пройти тест по физике </a> </h3>
    </main>
@endsection


