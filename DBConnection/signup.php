<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) &&  isset($_POST['password']) && isset($_POST['zipcode']) && isset($_POST['type']) && isset($_POST['status'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("users", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['zipcode'], $_POST['type'], $_POST['status'])) {
            echo "Sign Up Success";
        } else echo "Sign up Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
