<?php
class Users_Ctrl extends Controller{

	public $model;

	public function __construct(){
        parent::__construct();
        $this->model = new Users_Model();
    }

    public function index_Action($params){
       // $this->view->generate('main_view.php', 'template_view.php', array(1, 2, 3, 4));
    }

    public function register_Action($params){

        $this->view->show('menu_view.php','registration_view.php', $this->model);
    }

    public function auth_Action($params){
        
         if($this->model->is_authorize()){
            header('Location: /strip');
        }else{
            $this->view->show('menu_view.php','authorization_view.php',$this->model);
        }    
    }

    public function _auth_Action($params){
        $arInputs = filter_input_array(INPUT_POST);
        $arErrors = $this->model->authorization($arInputs['email'], $arInputs['password']);
       


         if(is_array($arErrors)){
            $this->view->show('menu_view.php','authorization_view.php', $this->model);
        }else{

            header('Location: /strip');
        }
    }

    public function _register_Action($params){
        $arInputs = filter_input_array(INPUT_POST);
        $error = $this->model->registration($arInputs['name'], $arInputs['email'], $arInputs['password']);
        
        if(is_array($error)){
            var_dump($error);
        }else{
            header("Location: /users/auth");
        }

        }

    public function exit_Action(){
        $_SESSION = array();
        session_destroy();
        header("Location: /");
    }    
    
}