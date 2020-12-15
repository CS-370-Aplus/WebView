<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])) {
    if ($db->dbConnect()) {
		if($db->checkUser("users", $_POST['username'], $_POST['type'])){
			if ($db->logIn("users", $_POST['username'], $_POST['password'])) {
				echo "Logged in as " . $_POST['username'];
			} else echo "Username or Password wrong";
		}else{
			if($_POST['type'] == 'B'){
				echo "User not found for Buyer Account";
			}else if($_POST['type'] == 'S'){
				echo "User not found for Seller Account";
			}
		}
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
