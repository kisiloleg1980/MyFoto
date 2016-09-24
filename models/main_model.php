<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/modules/add_lib/menu_model.php');

/**
* 
*/
class main_model 
{
	
	public $menu_model;

	function __construct()
	{
		$this->menu_model=new Menu_model();
		$this->menu_model->registration=array ('name'=>'Реєстрація', 'url'=>'/users/register') ;
		$this->menu_model->authorization=array ('name'=>'Авторизація', 'url'=>'/users/auth');
	}
}
?>