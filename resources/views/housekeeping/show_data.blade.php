<!-- resources/views/show_data.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Data for {{ $data[0]->start }}</h1>

    <table border="1">
        <tr>
            <th>Номер</th>
            <th>Категория номера</th>
            <th>Тип уборки</th>
            <th>Начало уборки</th>
            <th>Конец уборки</th>
            <th>Сумма за уборку</th>
        </tr>
{{--        @dd($data)--}}
        @foreach ($data as $row)
            @if($row->work != 0)
            <tr>
                <td>{{ $row->room }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->work }}</td>
                <td>{{ $row->start }}</td>
                <td>{{ $row->end }}</td>
{{--                <td>{{ $row->price }}</td>--}}
                @if($row->bed == 1 && $row->towels == 1)
                    <td>{{ $row->price + 30 + 10 }}</td>
                @elseif($row->bed == 1 && $row->towels == 0)
                    <td>{{ $row->price + 30 }}</td>
                @elseif($row->bed == 0 && $row->towels == 1)
                    <td>{{ $row->price + 10 }}</td>
                @else
                    <td>{{ $row->price }}</td>
                @endif
            </tr>
            @endif
        @endforeach
    </table>

@endsection
