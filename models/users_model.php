<?

require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/menu_model.php');
/**
* 
*/
class Users_Model extends Model
{
	
public $menu_model;

private function insert_record($name, $email, $pass, &$actual_file){
 	global $DB;

 	$DB->query("INSERT INTO users (name, login, password) VALUES ('$name','$email','$pass')");
 	$id_foto_user=$DB->insert_id();

 	$path_parts = pathinfo($actual_file);
	$ext=$path_parts['extension'];
	$new_name="$id_foto_user".'.'."$ext";

	$DB->query("UPDATE users SET id_foto_user='$new_name' WHERE (id_users='$id_foto_user')");
	$actual_file=$new_name;
 	}

public function registration($name, $email, $pass){
	$dir='user_foto';

	$tmp_name=$_FILES['file_name']['tmp_name'];
    $file_name=$_FILES['file_name']['name'];

    //var_dump($name);
    $name = trim($name, " ");
    $reg = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
    $arErrors = array();
    if($name == ""){
            $arErrors[] = "Name is empty!";
        }

    if($email == ""){//если пустой email
       $arErrors[] = "Email is empty!";
        }elseif(!preg_match($reg, $email)){//если не верный email
            $arErrors[] = "Email wrong!";
        }

    if($pass == ""){
            $arErrors[] = "Password is empty!";
        }
        

    if(count($arErrors) > 0){
		return $arErrors;
        }else {
        	$this->insert_record($name, $email, $pass, $file_name);
        	move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT']."/$dir/$file_name");
        }      
}
	
public function authorization($email, $pass){
	global $DB;

	 $arUser = $DB->query_select("SELECT id_users, login, password FROM users WHERE (login='$email') and (password='$pass');");
	 
	 if (!empty($arUser)){
	 	$arUser = array_shift($arUser);
	 	
	 	$_SESSION['user'] = array(
                        'id_users' => $arUser['id_users'],
                        'password' => $arUser['password'],
                        'email' => $arUser['login']);

	 	return true;
	 }
	 return false;
	 
}	

public function is_authorize(){
    return empty($_SESSION['user']) ? false : true;
    }



public function __construct(){

	$this->menu_model=new Menu_model();
	$this->menu_model->registration=array ('name'=>'Реєстрація', 'url'=>'/users/register') ;
	$this->menu_model->authorization=array ('name'=>'Авторизація', 'url'=>'/users/auth');
}

}

?>