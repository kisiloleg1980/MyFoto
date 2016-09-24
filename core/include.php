<?php

session_start();

require_once('DB_CONFIG.php');

//require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/menu_model.php');

function autoload_core($class){
    include $_SERVER['DOCUMENT_ROOT'].'/core/modules/main/'.strtolower($class).'.php';    
}

//function autoload_add_dll($class){
//	 include $_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/'.strtolower($class).'.php';
//}

spl_autoload_register('autoload_core');
//spl_autoload_register('autoload_add_dll');

global $DB;
$DB = new mysql_data();
$DB->connect($DBHost, $DBLogin, $DBPassword, $DBName);

/*global $USER;
$USER = new User();*/
Route::run();

