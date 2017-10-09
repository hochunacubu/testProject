<?php

namespace Timetables\Controllers;

use Timetables\App;
use Timetables\Models\Courier;
use Timetables\Models\Region;
use Timetables\Models\Timetables;

class Add{

    /** @var array errors */
    public $errors = array();

    /** @var array successes */
    public $successes = array();

    public function run(){

        if(isset($_POST['action']) && method_exists($this, $_POST['action']))
            $this->{$_POST['action']}();

        //выберем только не занятых курьеров
        $couriers = Courier::where('in_transit', 0)->get()->toArray();
        $regions = Region::get()->toArray();

        echo App::view('add', array(
                'couriers' => $couriers,
                'regions' => $regions,
                'errors' => $this->errors,
                'successes' => $this->successes
            ));

    }

    /**
     * добавление нового расписания
     */
    public function addTimetables(){

        if(!$this->validateForm($_POST))
            return false;

        //курьер в пути
        Courier::where('id', $_POST['courier'])->update(array('in_transit' => 1));

        //добавим расписание
        $timeTables = new Timetables;
        $timeTables->date_start = $_POST['date_start'];
        $timeTables->region_id_end = $_POST['region'];
        $timeTables->courier_id = $_POST['courier'];
        $resultAdd = $timeTables->save();

        if($resultAdd)
            $this->successes[] = 'Расписание успешно добавлено';
        else
            $this->errors[] = 'Произошла ошибка при добавлении нового расписания';


    }

    /**
     * @return bool
     */
    public function validateForm($data){

        if(empty($data['date_start']))
            $this->errors[] = 'Пожалуйста, укажите дату начала поездки';

        if(empty($this->errors))
            return true;
        else
            return false;

    }


}