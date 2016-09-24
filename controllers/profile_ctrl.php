<?php

class Profile_Ctrl extends Controller{

	public $model;

	public function __construct(){
        parent::__construct();
        $arParams = filter_input_array(INPUT_GET);
        $this->model = new Profile_Model($arParams['id']);
    }

    public function index_Action($params){
      
        if ($this->model->is_authorize()){
        	//echo "<pre>";
        	//var_dump($this->model);
        	//echo "</pre>";

        	$this->view->show('menu_view.php', 'profile_view.php', $this->model);
        }
        else {
        	header('Location: /users/auth');
        }

    }

    public function insert_Action($params){

    	$arErrors = $this->model->is_insert_foto();
    	
    	if ($arErrors){
            header('Location: /profile/index/?id='.$this->model->user->id_user);
        }  
    	
    }
    

    
    
}
?>