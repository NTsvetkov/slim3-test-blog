<?php

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';
$settings = include_once __DIR__ . "/../app/settings.php";

$app = new \Slim\App($settings);

require(__DIR__ . '/../app/routes.php');
require(__DIR__ . '/../app/dependencies.php');
