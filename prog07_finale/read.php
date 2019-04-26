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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Read</title>
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
		<h2>Read</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="input1" value="<?php echo $r['name'] ?>" placeholder="Name" readonly>
			    </div>
			</div>


			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-Mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="input1" value="<?php echo $r['email'] ?>" placeholder="E-Mail" readonly>
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Mobile</label>
			    <div class="col-sm-10">
			      <input type="tel" name="mobile"  class="form-control" id="input1" value="<?php echo $r['mobile'] ?>" placeholder="Mobile" readonly>
			    </div>
			</div>
			
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="text" name="password"  class="form-control" id="input1" value="<?php echo $r['password_hash'] ?>" placeholder="Password" readonly>
			    </div>
			</div>
		</form>
		
	</div>
</div>
<div><a class='col-md-offset-7 btn btn-primary' href='view.php'>Back</a></div>
</body>
</html>