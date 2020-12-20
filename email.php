<?php
require "DBConnection/DataBase.php";
$db = new DataBase();
if(isset($_POST['email']) && isset($_POST['code'])){
	if($db->dbConnect()){
		if($db->checkEmail("users", $_POST['email'])){
			$msg = "Your DamiBazar reset code is : " . $_POST['code'];
			
			mail($_POST['email'], "Reset Password", $msg);
			
			if($db->addResetCode("forgotpassword", $_POST['email'], $_POST['code'])){
				echo "Reset";
			}else echo "Not verified";
		}else echo "Email not registered";
	}else echo "Error: Database Connection";
}else echo "Email or code missing";
?>