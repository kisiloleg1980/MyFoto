<?php

/**
* 
*/
class User_cls
{
	
	public $id_user;
	public $name;
	public $login;
	public $password;
	public $id_foto_user;

//	public $user;

public function get_user($id){
	global $DB;
	$Result=$DB->query_select("SELECT name, login, password, id_foto_user from users where (id_users='$id') limit 1");
	$Result=array_shift($Result);

	$this->name=$Result['name'];
	$this->login=$Result['login'];
	$this->password=$Result['password'];
	$this->id_foto_user=$Result['id_foto_user'];
	
	
}

	function __construct($id)
	{
		$this->id_user=$id;
  		$this->get_user($id);
	}
}

?>