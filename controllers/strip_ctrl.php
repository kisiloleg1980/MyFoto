<?php


class Strip_Ctrl extends Controller{

	public $model;

	public function __construct(){
        parent::__construct();
        $id=$_SESSION['user']['id_users'];
        $this->model = new Strip_Model($id);
    }

    public function index_Action($params){
        
        if ($this->model->is_authorize()){
        	//echo "<pre>";
            //var_dump($this->model);
            //echo "</pre>";
            $this->view->show('menu_view.php', 'strip_view.php', $this->model);
        }
        else {
        	header('Location: /users/auth');
        }

    }

    

    
    
}
?>