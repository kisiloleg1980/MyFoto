<?php
class Main_Ctrl extends Controller{

	public $model;

	public function __construct(){
        parent::__construct();
        $this->model = new Main_Model();
    }

    public function index_Action($params){
        $this->view->show('menu_view.php', 'empty_view.php', $this->model);
    }
}