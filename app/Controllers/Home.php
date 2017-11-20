<?php

namespace Timetables\Controllers;

use Timetables\App;
use Timetables\Models\Timetables;

class Home
{
    public $data = [];

    public function run()
    {
        if (isset($_GET['action']) && method_exists($this, $_GET['action'])) {
            $this->{$_GET['action']}();
        }

        echo App::view('home', $this->data);
    }

    public function getTimetables()
    {
        $this->data['timetables'] = Timetables::getTimetables(
            $_GET['date_start'],
            $_GET['date_end']
        );
    }
}
