<?

/**
* 
*/
class post_model
{

	static private function get_id_foto($actual_file){
		global $DB;

		$Result=$DB->query_select("SELECT id_foto FROM foto where name_file='$actual_file'");
		$Result=array_shift($Result);
		$Result=$Result['id_foto'];
		return $Result;
	}


	static public function get_text_post($actual_file){
		global $DB;

		$Result=$DB->query_select("SELECT posts.id_post, posts.text_post, users.id_users, users.name, users.id_foto_user, posts.date_time FROM posts 
					inner join assotiation_post on (posts.id_post=assotiation_post.id_post) 
					inner join foto on (assotiation_post.id_foto=foto.id_foto) and (foto.name_file='$actual_file') 
					inner join users on (assotiation_post.id_users=users.id_users);");
		
		return view_date::format_date($Result);
	}

	static private function insert_id_post($text_post, &$id_post){
		global $DB;

		$DB->query("INSERT INTO posts (text_post) VALUES ('$text_post');");
		$id_post=$DB->insert_id();
	}


	static private function insert_assotiation_post($id_post, $id_foto, $id_users){
		global $DB;

		$DB->query("INSERT into assotiation_post (id_post, id_foto, id_users) 
			VALUES ('$id_post','$id_foto','$id_users');");

	}


	static public function insert_post($id_user, $text_posts, $img_file_name, &$Post_id_post){
		global $DB;

		$id_foto=self::get_id_foto($img_file_name);
		
		
		self::insert_id_post($text_posts,$id_post);
		$error1=$DB->error();

		self::insert_assotiation_post($id_post,$id_foto,$id_user);
		$error2=$DB->error();

		$Post_id_post=$id_post;

		return empty($error1) && empty($error2) ? "transaction_true" : "transaction_false";
			
		}


	static public function delete_post($id_post){
		global $DB;

		$DB->query("DELETE from posts where (id_post='$id_post')");
		$error=$DB->error();
		return empty($error) ? "transaction_true" : "transaction_false";
	}

	static public function update_post($id_post, $text_post){
		global $DB;

		$DB->query("UPDATE posts SET text_post='$text_post' where (id_post='$id_post')");
		$error=$DB->error();
		return empty($error) ? "transaction_true" : "transaction_false";
	}

	static public function get_post_user($id_post){
		global $DB;

		$Result=$DB->query_select("SELECT users.id_users, users.password from users inner join assotiation_post on  (users.id_users=assotiation_post.id_users) inner join posts on  (assotiation_post.id_post=posts.id_post) and (posts.id_post='$id_post');");
		return $Result[0];
	}


}

	
	


?>