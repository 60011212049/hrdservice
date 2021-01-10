<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

// Load Framework
require 'vendor/autoload.php';

// Create Slim
$app = new \Slim\App;

require 'api/material.php';
require 'api/pay_order.php';
require 'api/report.php';
require 'api/login.php';
require 'api/employee.php';
// require 'connectDB.php';
require 'db_connect.php';

// Run S lim app
$app->run();
