<?php

    require_once dirname(__FILE__) . '/config.php';
    require_once dirname(__FILE__) . '/vendor/autoload.php';

    $App = new \Timetables\App();

    $req = !empty($_REQUEST['q'])
        ? trim($_REQUEST['q'])
        : '';

    $App->handleRequest($req);