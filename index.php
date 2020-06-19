<?php

define('RHINO_START', microtime(true));

require_once __DIR__ . '/vendor/autoload.php';


$dotenv = new Config\Dotenv();
$dotenv->load(__DIR__.'\.env');


$request  = App\Http\Request::capture();
$response = $request->handle();
$response->send();
