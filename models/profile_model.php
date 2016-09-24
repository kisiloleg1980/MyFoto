<?

require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/users_cls.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/post_model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/date_parse.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/menu_model.php');

class profile_model 
{

	public $user;
	public $access;

	public $status_follow;

	public $name_file;

	public $post_model;

	public $menu_model;


public function get_follow($id){
		global $DB;
		$arr=$DB->query_select("SELECT id_follow from assotiation_follow, users where 
								(users.id_users=assotiation_follow.id_users) and (users.id_users='$id'); ");
		$Result=false;
		  foreach ($arr as $value) {
		  	if ($value['id_follow']===$this->user->id_user) {
			  	$Result=true;
			  }
		  }
		 return $Result;
	}

public function insert_file_name(&$id_foto, &$actulal_file){
	global $DB;

	$DB->query("INSERT INTO foto (name_file) VALUES ('No_Name.jpg')");
	$id_foto=$DB->insert_id();

	$path_parts = pathinfo($actulal_file);
	$ext=$path_parts['extension'];
	$new_name="$id_foto".'.'."$ext";

	$DB->query("UPDATE foto SET name_file='$new_name' WHERE (id_foto='$id_foto')");
	$actulal_file=$new_name;
}


public function insert_assotiation_foto($id_foto,$id_users){
	global $DB;

	$DB->query("INSERT INTO assotiation_foto (id_foto, id_users) VALUES ('$id_foto','$id_users')");
}

public function get_file_name($id){
    global $DB;   	
   
	$Result=$DB->query_select("SELECT name_file, date_time  FROM users, foto, assotiation_foto where 
							(users.id_users=assotiation_foto.id_users) and 
						(assotiation_foto.id_foto=foto.id_foto) and (users.id_users='$id')");

    $Result=view_date::format_date($Result);

    foreach ($Result as $key => $value) {
    	$Result[$key]['posts']=post_model::get_text_post($value['name_file']);
    }

    return $Result;
    }


/*public function get_posts(){
		global $DB;
		
		foreach ($this->name_file as $key=>$value) {
			$variable=$this->post_model->get_text_post($value['name_file']);
			$this->name_file[$key]['posts']=$variable;
		}
	}*/

public function set_access($access){
	$this->access=$access;
}



public function is_authorize(){
    	return empty($_SESSION['user']) ? false : true;
    }


function is_insert_foto(){
	$dir='foto';

	$tmp_name=$_FILES['file_name']['tmp_name'];
	$name=$_FILES['file_name']['name'];

	if (!empty($name)){
		$id=$this->user->id_user;
		$this->insert_file_name($id_foto, $name);
		$this->insert_assotiation_foto($id_foto,$id);

		move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT']."/$dir/$name");

		return true;
	} 
		else {
			return false;
		}



	
}

  function __construct($id){
  	
  	$this->user=new User_cls($id);
    
    (($this->user->login==$_SESSION['user']['email']) 
    	&& ($this->user->password==$_SESSION['user']['password'])) ? 
	$this->set_access(true) : $this->set_access(false); 
  	
  	$this->status_follow=$this->get_follow($_SESSION['user']['id_users']);

  	$this->name_file=$this->get_file_name($id);

  	//$this->post_model=new post_model();
  	//$this->get_posts();

  	$this->menu_model=new Menu_model();
  	
	$this->menu_model->strip=array ('name'=>'Стрічка', 'url'=>'/strip') ;
	$this->menu_model->exit=array ('name'=>'Вихід', 'url'=>'/users/exit');
  } 

}

 

?>