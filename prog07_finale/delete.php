<?php
require_once ('database.php');

session_start();
if(!isset($_SESSION["id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}

$id = $_GET['id'];

$res = $database->delete($id);
if($res){
	header('location: view.php');
}else{
	echo "Failed to Delete Record";
}
?>