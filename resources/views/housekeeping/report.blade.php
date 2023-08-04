<!-- resources/views/housekeeping/report.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Отчет по работам за сентябрь</h1>

    <table border="1" id="dateTable">
        <tr>
            <th>Дата</th>
            <th>Начало рабочего дня</th>
            <th>Конец рабочего дня</th>
            <th>Кол-во генеральных уборок</th>
            <th>Кол-во текущих уборок</th>
            <th>Кол-во заездов</th>
            <th>Сумма оплаты за день</th>
        </tr>

        @php
            $datesData = [];
        @endphp

        @foreach ($report_data as $row)
            @php
                $date = substr($row->start, 0, 10); // Extract only the date part from the timestamp
                $startTime = substr($row->start, 11, 5); // Extract only the time part (HH:mm) from the timestamp
                $endTime = substr($row->end, 11, 5); // Extract only the time part (HH:mm) from the end timestamp
                $work = $row->work; // Get the "work" value for the current row
                $price = $row->price; // Get the "price" value for the current row
                $bed = $row->bed; // Get the "bed" value for the current row
                $towels = $row->towels; // Get the "towels" value for the current row
            @endphp

            @if (!isset($datesData[$date]))
                @php
                    $datesData[$date] = [
                        'earliest' => $startTime,
                        'latest' => $endTime,
                        'rowCount' => ($work != 0 ? 1 : 0), // Initialize the row count for this date
                        'totalPrice' => $price,
                    ];

                    // Check if "bed" or "towels" is 1, and add additional amounts to the total price if necessary
                    if ($bed == 1) {
                        $datesData[$date]['totalPrice'] += 30;
                    }

                    if ($towels == 1) {
                        $datesData[$date]['totalPrice'] += 10;
                    }
                @endphp
            @else
                @if ($datesData[$date]['earliest'] > $startTime)
                    @php
                        $datesData[$date]['earliest'] = $startTime;
                    @endphp
                @endif

                @if ($datesData[$date]['latest'] < $endTime)
                    @php
                        $datesData[$date]['latest'] = $endTime;
                    @endphp
                @endif

                @if ($work != 0)
                    @php
                        $datesData[$date]['rowCount']++;
                    @endphp
                @endif

                @if ($bed == 1)
                    @php
                        $datesData[$date]['totalPrice'] += 30;
                    @endphp
                @endif

                @if ($towels == 1)
                    @php
                        $datesData[$date]['totalPrice'] += 10;
                    @endphp
                @endif

                @php
                    $datesData[$date]['totalPrice'] += $price;
                @endphp
            @endif
        @endforeach

        @foreach ($datesData as $date => $data)
            <tr>
                <td><a href="{{ route('show-data', ['date' => $date]) }}">{{ $date }}</a></td>
                <td>{{ $data['earliest'] }}</td>
                <td>{{ $data['latest'] }}</td>
                <td>{{ $data['rowCount'] }}</td>
                <td>{{ $data['rowCount'] }}</td>
                <td>{{ $data['rowCount'] }}</td>
                <td>{{ $data['totalPrice'] }}</td>
            </tr>
        @endforeach

    </table>

@endsection
