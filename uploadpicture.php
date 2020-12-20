<?php
	require "DBConnection/DataBase.php";
	$db = new DataBase();
	
	if(isset($_POST['name']) && isset($_POST['upload'])){
    	$name = $_POST['name'];
    	$img = $_POST['upload'];
    	
    	$filename = "IMG" . rand() . ".jpg";
    	file_put_contents("uploadedImages/".$filename, base64_decode($img));
    	if($db->dbConnect()){
    	    if($db->uploadImage("itemimages", $filename, $name)){
    	        echo "Success";
    	    }else echo "Failed";
    	}else echo "Error: Database Connection";
	}else echo "All Fields Required";
?>