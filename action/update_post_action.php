<?
require $_SERVER['DOCUMENT_ROOT'].'/CORE/DB_CONFIG.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/modules/main/MySql_Data.php';

require $_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/post_model.php';
require $_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/users_cls.php';

session_start();

$arParams = filter_input_array(INPUT_POST);
$id_post=$arParams['id_post'];
$text_post=$arParams['text_post'];
$id_super_user=$_SESSION['user']['id_users'];


global $DB;
$DB = new MySql_Data();
$DB->connect($DBHost, $DBLogin, $DBPassword, $DBName);

$access=post_model::get_post_user($id_post);

if ($id_super_user==$access['id_users']) {
	
	$error=post_model::update_post($id_post,$text_post);

	$record=array('error'=>$error,'text_post'=>$text_post);

	echo json_encode($record);
}

//echo json_encode($id_post);
?>