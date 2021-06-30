<?php

require_once __DIR__ . '/../vendor/autoload.php';

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('API_URI', str_replace('index.php','',$_SERVER['SCRIPT_NAME']));

use app\lib\api;
use app\controllers\mainController;

$api = new api();
$api->post('/sum', [mainController::class, 'sum']);
$api->notFound_404();
