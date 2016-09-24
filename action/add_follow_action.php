<?php
require $_SERVER['DOCUMENT_ROOT'].'/CORE/DB_CONFIG.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/modules/main/MySql_Data.php';


session_start();

$arParams = filter_input_array(INPUT_POST);
$id_profile=$arParams['id_profile'];
$id_super_user=$_SESSION['user']['id_users'];
$subs=$arParams['subs'];

global $DB;
$DB = new MySql_Data();
$DB->connect($DBHost, $DBLogin, $DBPassword, $DBName);

if ($subs=='not_follow'){
	$DB->query("INSERT INTO assotiation_follow (id_users, id_follow) VALUES ($id_super_user,$id_profile);");
	$error=$DB->error();
	$subs="follow";
} else {
	$DB->query("DELETE FROM assotiation_follow where ($id_profile=id_follow and $id_super_user=id_users);");
	$error=$DB->error();
	$subs="not_follow";
}

$error=(empty($error) ? "transaction_true" : "transaction_false");

$record=array('error'=>$error, 'subs'=>$subs);

echo json_encode($record);





?>