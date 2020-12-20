<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ContactPage</title>
<style>
    body{
        font-size: 20px;
    }
</style>
<body>
<?php
    require "DBConnection/DataBase.php";
    $db = new DataBase();

    $sellerid = $_GET['sellerid'];
    if($db->dbConnect()){
        list($firstname, $lastname, $username, $email, $zipcode) = 
        $db->getUserInfo("users", $sellerid);
    }else echo "Error: Database Connection";
    
    echo "
        <table style=\"width:100%\">
            <tr><td><b>Name: &nbsp;" . ucwords($firstname . " " . $lastname) . "</b></td></tr>
            <tr><td><b>E-mail:</b> &nbsp;" . $email . " </td></tr>
            <tr><td><b>Item Location:</b> &nbsp;" . $zipcode . "</td></tr>
        </table>
            
    ";
?>

</body>
</html>