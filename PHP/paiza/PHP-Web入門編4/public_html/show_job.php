<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
        public function player() {
            return $this->hasMany('Player');
        }
    }

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $job = Job::find($id);
	$message = 'This is paiza';
    require_once 'views/job_profile.tpl.php';
