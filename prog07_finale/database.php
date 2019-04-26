<?php
 
class Database{
	
	private $connection;
	
	function __construct(){
		$this->connect_db();
	}
 
	public function connect_db(){
		$this->connection = mysqli_connect('localhost', 'id6929737_jmmerci1355wi19', 'Ludwigs1337!', 'id6929737_jmmerci1355wi19');
		if(mysqli_connect_error()){
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
	}
	
	public function sanitize($var){
		$return = mysqli_real_escape_string($this->connection, $var);
		return $return;
	}
	
	public function create($name,$email,$mobile,$password){
		$sql = "INSERT INTO `reservations` (name, email, mobile, password_hash) VALUES ('$name', '$email', '$mobile', '$password')";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	public function read(){
		$sql = "SELECT * FROM `reservations`";
		$res = mysqli_query($this->connection, $sql);
		return $res;
	}
	
	public function view($id=null){
		$sql = "SELECT * FROM `reservations`";
		if($id){ $sql .= " WHERE id=$id";}
		$res = mysqli_query($this->connection, $sql);
		return $res;
	}
	
	public function update($name,$email,$mobile,$password, $id){
		$sql = "UPDATE `reservations` SET name='$name', email='$email', mobile='$mobile', password_hash='$password' WHERE id=$id";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	public function delete($id){
		$sql = "DELETE FROM `reservations` WHERE id='$id'";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	public function login_db($email, $password){
		$sql = "SELECT * FROM `reservations` WHERE email = '$email' AND password_hash = '$password' LIMIT 1";
		$res = mysqli_query($this->connection, $sql);
		return $res;
	}
}


 
$database = new Database();
$database->connect_db();
?>