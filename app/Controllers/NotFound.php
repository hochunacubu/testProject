<?php

namespace Timetables\Controllers;

use Timetables\App;

class NotFound{

    public function run(){

        echo App::view('notFound');

    }


}