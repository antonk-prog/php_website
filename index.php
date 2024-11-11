<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('APP_PATH', __DIR__);

require_once APP_PATH.'/vendor/autoload.php';

use App\App;

$app = new App();

$app->run();

// dd(APP_PATH);
