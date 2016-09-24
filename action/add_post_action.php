<?php
require $_SERVER['DOCUMENT_ROOT'].'/CORE/DB_CONFIG.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/modules/main/MySql_Data.php';

require $_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/post_model.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/users_cls.php';

session_start();

$arParams = filter_input_array(INPUT_POST);
$file_foto=$arParams['file_foto'];
$text_post=$arParams['text_post'];
$id_super_user=$_SESSION['user']['id_users'];


global $DB;
$DB = new MySql_Data();
$DB->connect($DBHost, $DBLogin, $DBPassword, $DBName);

//$post_model=new post_model(); 
$users_cls=new User_cls($id_super_user);

$error=post_model::insert_post($id_super_user,$text_post,$file_foto, $id_post);

$record=array('error'=>$error, 'name'=>$users_cls->name, 'foto'=>$users_cls->id_foto_user, 'text_post'=>$text_post, 'id_post'=> $id_post);

echo  json_encode($record) ;

//$ser=explode('/', $_SERVER['HTTP_REFERER']);
//echo json_encode($ser);
?>