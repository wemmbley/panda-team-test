<?php

require_once '../vendor/autoload.php';
require_once '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

Core\DB::boot();
$router = new \Core\Router();
$router->init();
