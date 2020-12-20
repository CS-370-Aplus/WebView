<?php
	require "DataBase.php";
	$db = new DataBase();
	
	if(isset($_POST['username'])){
		if($db->dbConnect()){
			$userid = $db->getID("users", $_POST['username']);
			list($firstname, $lastname, $username, $email, $zipcode) = $db->getUserInfo("users", $userid);
			echo $firstname . ", " . $lastname . ", " . $username . ", " . $email . ", " . $zipcode";
		}else echo"Error: Database Connection";
	}else echo "No fields Passes";

?>
