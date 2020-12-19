<?php
use \Medoo\Medoo;

// $dbconn = new Medoo([
//     'database_type' => 'mysql',
// 	'database_name' => '3555236_dbhomework',
// 	'server' => 'pdb52.awardspace.net',
// 	'username' => '3555236_dbhomework',
// 	'password' => '*rOQRt7f1EmA;4,v',
 
// 	// [optional]
// 	'charset' => 'utf8',
// 	'collation' => 'utf8_general_ci',
// ]);

$dbconn = new Medoo([
    'database_type' => 'mysql',
	'database_name' => 'hdr',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// [optional]
	'charset' => 'utf8',
	'collation' => 'utf8_general_ci',
]);