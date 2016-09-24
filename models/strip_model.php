<?

require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/users_cls.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/post_model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/date_parse.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/menu_model.php');
/**
* 
*/
class strip_model
{
	
	public $user;

	public $id_follow;
	public $name_file_follow;

	public $post_model;

	public $menu_model;

	public function get_id_follow($id){
		global $DB;
		$Result=$DB->query_select("SELECT id_follow from assotiation_follow, users where 
								(users.id_users=assotiation_follow.id_users) and (users.id_users='$id'); ");
		return $Result;
	}

	public function get_follow(){
		global $DB;

		$variable=$this->id_follow;
		$id_user_str='';

		foreach ($variable as $key =>$value) {
			$id_value=$value['id_follow'];
			if ($key==0) 	
				$id_user_str="users.id_users='$id_value'";
				else
				$id_user_str=$id_user_str." or users.id_users='$id_value'";
		}

		$Result=$DB->query_select("SELECT users.name, users.id_foto_user, foto.name_file, foto.date_time FROM users, foto, assotiation_foto 
						where (users.id_users=assotiation_foto.id_users) and (assotiation_foto.id_foto=foto.id_foto) 
						and ($id_user_str) order by date_time desc;");

		$Result=view_date::format_date($Result);
		
		foreach ($Result as $key => $value) {
			$Result[$key]['posts']=post_model::get_text_post($value['name_file']);
		}

		return $Result;
	}

	/*public function get_posts(){
		global $DB;
		
		foreach ($this->name_file_follow as $key=>$value) {
			$variable=post_model::get_text_post($value['name_file']);
			$this->name_file_follow[$key]['posts']=$variable;
		}
	}*/


	public function is_authorize(){
    	return empty($_SESSION['user']) ? false : true;
    }

	function __construct($id)
	{
		
		$this->user=new User_cls($id);

		$this->id_follow=$this->get_id_follow($id);
		$this->name_file_follow=$this->get_follow();
		
		//$this->post_model=new post_model();
		//$this->get_posts();

		$this->menu_model=new Menu_model();
		//$this->menu_model->strip=array ('name'=>'Стрічка', 'url'=>'/strip') ;
		$this->menu_model->profile=array ('name'=>'Профіль', 'url'=>'/profile/index/?id='.$id);
		$this->menu_model->exit=array ('name'=>'Вихід', 'url'=>'/users/exit');
	}
}

?>