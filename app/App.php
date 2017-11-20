<?php

namespace Timetables;

use Illuminate\Database\Capsule\Manager as Capsule;
use Timetables\Controllers;

Class App
{
    public function __construct()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => DBDRIVER,
            'host' => DBHOST,
            'database' => DBNAME,
            'username' => DBUSER,
            'password' => DBPASS,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
        ]);

        // this is important
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }

    /**
     * Обработка входящего запроса
     *
     * @param $uri
     */
    public function handleRequest($uri)
    {
        $request = explode('/', $uri);

        $className = '\Timetables\Controllers\\' . ucfirst(array_shift($request));

        if (class_exists($className)) {
            $controller = new $className;
        } elseif (!class_exists($className) && !empty($uri)) {
            $controller = new Controllers\NotFound;
        } else {
            $controller = new Controllers\Home;
        }

        $controller->run();
    }

    /**
     * рендер шаблона
     *
     * @param array $data
     * @param string $name
     */
    public static function view($name, $data = array())
    {
        $loader = new \Twig_Loader_Filesystem(VIEWS_DIR);
        $twig = new \Twig_Environment($loader, array(
            'cache' => CACHE_DIR,
            'auto_reload' => true
        ));

        echo $twig->render($name . '.html', $data);
    }
}
