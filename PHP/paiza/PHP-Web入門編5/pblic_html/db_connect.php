<?php

    require_once './vendor/autoload.php';
    use Illuminate\Database\Capsule\Manager as Capsule;
    use Illuminate\Database\Eloquent\Model as Model;

    $db = new Capsule;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'memo',
        'username'  => 'root',
        'password'  => ''
    ]);

    $db->setAsGlobal();
    $db->bootEloquent();

    class Note extends Model {
    }
