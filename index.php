<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

$App = new \Timetables\App();

$req = !empty($_REQUEST['q']) ? trim($_REQUEST['q']) : '';

$App->handleRequest($req);
