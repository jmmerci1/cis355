<?php
/* ---------------------------------------------------------------------------
 * filename    : login.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program logs the user in by setting $_SESSION variables
 * ---------------------------------------------------------------------------
 */
// Start or resume session, and create: $_SESSION[] array
session_start(); 
require "database.php";
if ( !empty($_POST)) { // if $_POST filled then process the form
	// initialize $_POST variables
	$username = $_POST['username']; // username is email address
	$password = $_POST['password'];
	$passwordhash = MD5($password);
	$labelError = "";
	// echo $password . " " . $passwordhash; exit();
	// robot 87b7cb79481f317bde90c116cf36084b
		
	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM customers WHERE email = ? AND password_hash = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$passwordhash));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { // if successful login set session variables
		echo "success!";
		$_SESSION['id'] = $data['id'];
		$sessionid = $data['id'];
		Database::disconnect();
		header("Location: customers.php ");
		// javascript below is necessary for system to work on github
		exit();
	}
	else { // otherwise go to error message
		Database::disconnect();
		$labelError = "Incorrect Username/Password";
	}
} 
// if $_POST NOT filled then display login form, below.
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
				<h3>Prog03 Database Login</h3>
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
						<input name="password" type="password" placeholder="not your SVSU password, please" required> 
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
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>