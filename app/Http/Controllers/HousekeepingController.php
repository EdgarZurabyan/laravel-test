<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HousekeepingController extends Controller
{
    // Метод для отчета по всем работам за сентябрь
    public function reportForSeptember()
    {

        $report_data = DB::table('statistics')
            ->leftJoin('rooms', 'rooms.id', '=', 'statistics.room')
            ->leftJoin('prices', function ($join) {
                $join->on('prices.room_type', '=', 'rooms.type');
                $join->on('statistics.work', '=', 'prices.work');
            })
            ->select('statistics.*', 'rooms.type as type', 'prices.price as price')
            ->where('statistics.staff', '=', "167")
            ->get();

        return view('housekeeping.report', compact('report_data'));
    }

}
