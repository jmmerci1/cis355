<?php
session_start(); 
require_once "database.php";
$labelError = "";

if ( !empty($_POST)) { 
	$username = $_POST['username']; // username is email address
	$password = $_POST['password'];
	
	$res = $database->login_db($username, $password);
	$r = mysqli_fetch_assoc($res);
	$_SESSION['id'] = $r['id'];
	$sessionid = $r['id'];
	
	if($r['id'] != null){
		header("Location: view.php ");
		exit();	
	}else{
			$labelError = "Incorrect Username/Password";
	}
	
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

		<div class="span10 offset1">
	

			<div class="row">
				<h3>Prog07 Database Login</h3>
			</div>

			<form class="form-horizontal" action="login.php" method="post">		  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="Type password here" required> 
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign in</button>
					&nbsp; &nbsp;
					<input type="button" value = "Join" onclick="window.location.href='join.php'"/>
				</div>
				
				<div>
					<?php
						echo "<br>";
						echo "<span style = 'color: red;' span class='help-inline'>";
						echo "&nbsp;&nbsp;" . $labelError;
						echo "</span>";
						echo "<br>";
					?>
				</div>
					<a href="https://github.com/jmmerci1/cis355/blob/master/prog03/cis355diagram_template.docx">Diagrams for Prog07</a>
					<a href="https://github.com/jmmerci1/cis355/blob/master/prog03/cis355diagram_template.docx">Source Code for Prog07</a>
				<div>
					
				</div>
			</form>
		</div> 			
    </div> 
  </body>
</html>