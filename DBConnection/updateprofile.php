<?php
	require "DataBase.php"
	$db = new DataBase();
	
	if(isset($_POST['userid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['zipcode'])){
		if($db->dbConnect()){
			if($db->updateUserProfile("users", $_POST['userid'], $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['zipcode'])){
				echo "Profile Updated"
			}else echo "Update Failed";
		}else echo "Error: Database Connection";
	}else echo "All Fields Required"; 

?>