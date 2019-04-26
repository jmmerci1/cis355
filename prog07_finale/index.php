<?php
require_once ('database.php');

	session_start();
	if(!isset($_SESSION["id"])){ // if "user" not set,
		session_destroy();
		header('Location: login.php');     // go to login page
		exit;
	}

	if(isset($_POST) & !empty($_POST)){
		$name = $database->sanitize($_POST['name']);
		$email = $database->sanitize($_POST['email']);
		$mobile = $database->sanitize($_POST['mobile']);
		$password = $_POST['password'];
		
		$res = $database->create($name, $email, $mobile, $password);
		if($res){
			echo "Successfully inserted data";
		}else{
			echo "failed to insert data";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data">
			<h2>Create Reservation</h2>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="input1" placeholder="Name" required>
			    </div>
			</div>
 
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input1" placeholder="E-Mail" required>
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Mobile</label>
			    <div class="col-sm-10">
			      <input type="tel" name="mobile"  class="form-control" id="input1" placeholder="Mobile" required>
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="text" name="password"  class="form-control" id="input1" placeholder="Password" required>
			    </div>
			</div>
			
			<p>File</p>
            <input type="file" 
                name="Filename" accept="image/gif, image/jpeg, image/png">
			
 
			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Create" />
			<div><a class='col-md-offset-7 btn btn-primary' href='view.php'>Back</a></div>
		</form>
	</div>
</div>
</body>
</html>