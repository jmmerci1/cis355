<?php

session_start();
$_SESSION['id'] = guest;

// include the class that handles database connections
require "database.php";

// include the class containing functions/methods for "customer" table
// Note: this application uses "customer" table, not "cusotmers" table
require "join.class.php";
$joinee = new Joinee();
 
// set active record field values, if any 
// (field values not set for display_list and display_create_form)
if(isset($_GET["id"]))          $id = $_GET["id"]; 
if(isset($_POST["name"]))       $joinee->name = htmlspecialchars($_POST["name"]);
if(isset($_POST["email"]))      $joinee->email = htmlspecialchars($_POST["email"]);
if(isset($_POST["mobile"]))     $joinee->mobile = htmlspecialchars($_POST["mobile"]);
// No htmlspecialschars to allow special characters in a password
if(isset($_POST["password"]))   $joinee->password = $_POST["password"];

// "fun" is short for "function" to be invoked 
if(isset($_GET["fun"])) $fun = $_GET["fun"];
else $fun = "display_create_form"; 

switch ($fun) {
    case "display_create_form": $joinee->create_record(); 
        break;
    default: 
        echo "Error: Invalid function call (customer.php)";
        exit();
        break;
}
?>