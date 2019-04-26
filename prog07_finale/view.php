<?php
require_once ('database.php');

session_start();
if(!isset($_SESSION["id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}

$res = $database->read();
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Reservations</title>
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
	<h2>Reservation Customers Listing:</h2>
		<div><a class='btn btn-success' href='index.php'>Create</a>
			 <a class='btn btn-warning' href='logout.php'>Logout</a>
		</div>
		<table class="table "> 
		<thead> 
			<tr> 
				<th>ID</th> 
				<th>Name</th> 
				<th>E-Mail</th> 
				<th>Mobile</th> 
			</tr> 
		</thead> 
		<tbody> 
			<tr> 
				<?php 
					while($r = mysqli_fetch_assoc($res)){
					?>
					<tr>
						<td><?php echo $r['id']; ?></td>
						<td><?php echo $r['name'] ; ?></td>
						<td><?php echo $r['email']; ?></td>
						<td><?php echo $r['mobile']; ?></td>
						<td> <a href="read.php?id=<?php echo $r['id']; ?>">Read</a>
						<a href="update.php?id=<?php echo $r['id']; ?>">Update</a> 
						<a href="delete.php?id=<?php echo $r['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
			</tr> 
		</tbody> 
		</table>
	</div>
</div>
</body>
</html>