<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function showData($date)
    {
        $data = DB::table('statistics')
            ->leftJoin('rooms', 'rooms.id', '=', 'statistics.room')
            ->leftJoin('prices', function ($join) {
                $join->on('prices.room_type', '=', 'rooms.type');
                $join->on('statistics.work', '=', 'prices.work');
            })
            ->select('statistics.*', 'rooms.type as type', 'prices.price as price')
            ->whereDate('start', $date)
            ->get();

        return view('housekeeping.show_data', compact('data'));
    }
}
