<!-- resources/views/housekeeping/works.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Список работ за {{ $selected_date }}</h1>

    <table border="1">
        <tr>
            <th>Номер</th>
            <th>Категория номера</th>
            <th>Тип уборки</th>
            <th>Начало уборки</th>
            <th>Конец уборки</th>
            <th>Сумма за уборку</th>
        </tr>
        @foreach($works_data as $row)
            <tr>
                <td>{{ $row['room'] }}</td>
                <td>{{ $row['room_category'] }}</td>
                <td>{{ $row['type'] }}</td>
                <td>{{ $row['start'] }}</td>
                <td>{{ $row['end'] }}</td>
                <td>{{ $row['total_payment'] }}</td>
            </tr>
        @endforeach
    </table>
@endsection
