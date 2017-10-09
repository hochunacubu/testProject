<?php

namespace Timetables\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;

class Timetables extends Model{

    public $timestamps = false;

    /**
     * Вывод дат за период
     * @param $dateStart
     * @param $dateEnd
     * @return array|static[]
     */
    public static function getTimetables($dateStart, $dateEnd){

        return DB::table('timetables')
            ->join('regions', 'timetables.region_id_end', '=', 'regions.id')
            ->join('couriers', 'timetables.courier_id', '=', 'couriers.id')
            ->select('timetables.*', 'regions.region_name', 'couriers.*')
            ->whereDate('date_start', '>=', $dateStart)
            ->whereDate('date_start', '<=', $dateEnd)
            ->get();

    }

}