<?php
require_once ('database.php');

session_start();
if(!isset($_SESSION["id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}

$id = $_GET['id'];
$res = $database->view($id);
$r = mysqli_fetch_assoc($res);

	if(isset($_POST) & !empty($_POST)){
		$name = $database->sanitize($_POST['name']);
		$email = $database->sanitize($_POST['email']);
		$mobile = $database->sanitize($_POST['mobile']);
		$password = $_POST['password'];
		
		$res = $database->update($name, $email, $mobile, $password, $id);
		if($res){
			echo "Successfully updated data";
		}else{
			echo "failed to update data";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Update</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="input1" value="<?php echo $r['name'] ?>" placeholder="Name" />
			    </div>
			</div>


			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input1" value="<?php echo $r['email'] ?>" placeholder="E-Mail" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Mobile</label>
			    <div class="col-sm-10">
			      <input type="tel" name="mobile"  class="form-control" id="input1" value="<?php echo $r['mobile'] ?>" placeholder="Mobile" />
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="text" name="password"  class="form-control" id="input1" value="<?php echo $r['password_hash'] ?>" placeholder="Password" />
			    </div>
			</div>
			
			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Update" />
			<a class='col-md-offset-11 btn btn-primary' href='view.php'>Back</a>
		</form>
	</div>
</div>
</body>
</html>