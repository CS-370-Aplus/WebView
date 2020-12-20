<?php
        require "DBConnection/DataBase.php";
        $db = new DataBase();
        
        
        if(isset($_POST['seller']) && isset($_POST['title']) && isset($_POST['color']) && isset($_POST['size']) && isset($_POST['gender']) && isset($_POST['description']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['upload'])){
            $img = $_POST['upload'];
            if ($db->dbConnect()) 
            {
                $uniqueid = $db->getNextImageID();
                $filename = $uniqueid . "_IMG" . rand() . ".jpg";
                file_put_contents("uploadedImages/".$filename, base64_decode($img));
                $id = $db->getID("users", $_POST['seller']);
                if($id == "No Match"){
                    echo "Seller id error";
                }else{
                    if($db->additem("items", $id, $_POST['title'], $_POST['color'], $_POST['size'], $_POST['gender'], $_POST['description'], $_POST['quantity'], $_POST['price'])){
                        $itemid = $db->getCurrentItemID();
                        if($db->uploadImage("itemimages", $itemid, $filename, $_POST['seller'])){
                            echo "Success";
                        }else echo "Image Upload Failed";
                    }else echo "Item Upload Failed";
                }
            }else echo "Error: Database Connection";
            
       }else echo "All Fields required";
?>
