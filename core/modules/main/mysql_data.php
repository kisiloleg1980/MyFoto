<?

class mysql_data {

const ERROR_CONNECT = "Ошибка подключения к базе данных";

private $db;

 public function connect($host, $user, $pass, $dbName){
       
        $this->db = new mysqli($host, $user, $pass, $dbName) or die(self::ERROR_CONNECT.": ".mysqli_connect_error());
       
}

public function query($sql){
	$this->db->query($sql);
} 


public function query_select($query){
        $result = $this->db->query($query);
        $arResult = array();
        if($result){
            while ($row = $result->fetch_assoc()) {
                $arResult[] = $row;
            }
            $result->close();
        }
        return $arResult;
    }

public function insert_id(){
    return $this->db->insert_id;
}  

public function error(){
    return $this->db->error;
}  

public function close(){
    $this->db->close();
}    
}

?>