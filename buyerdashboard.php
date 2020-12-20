<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>
<style>
img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>

</head>

<body>
	<?php
	require "DBConnection/DataBase.php";
    		$db = new DataBase();
		if(isset($_POST['username'])){
		    if ($db->dbConnect()) {
    		    $user = $_POST['username'];
    			$id = $db->getID("users", $user);
    			list($firstname, $lastname, $username, $email, $zipcode) = $db->getUserInfo("users", $id);
				
			}else echo "Error: Database connection";
				
		}else echo "username empty";
		
		if(is_null($_POST['keyword'])){
		    $sql = "select * from items ORDER BY RAND() LIMIT 10";
		}else{
		    $sql = "select * from items WHERE title LIKE '%" . $_POST['keyword'] . "%'";
		}
				
		
		$result = mysqli_query($db->connect, $sql);
		
		echo "<table width='100%'>";
			while($row = mysqli_fetch_assoc($result)){
				$link = $db->getImageLink("itemimages", $row['itemid']);
				$price = number_format ($row['price'], 2, '.', ',');
				echo "<tr> 
						<td height = '200dp' width='200dp'><img src = 'uploadedImages/" . $link . "' alt = '" . $row['id'] . "_picture'></td>
						<td style=\"vertical-align: top;\">
							<table>
								<tr class = 'tablerow'><td><h3><a href = 'itemdescription.php?itemid=".$row['itemid']."' style='color:black;'>" . ucwords($row['title']) . "</a></h3></td></tr>
								<tr class = 'tablerow'><td>" . "<b>Size: </b>&#9;" . ucwords($row['size']) . "</td></tr>
								<tr class = 'tablerow'><td>" . "<b>Color: </b>&#9;" . ucwords($row['color']) . "</td></tr>
								<tr class = 'tablerow'><td>" . "<b>Available: </b>&#9;" . $row['quantity'] . "</td></tr>
								<tr class = 'tablerow'><td>" . "<b>Price: </b>&#9;$ " . $price . "</td></tr>
							</table>
					  </tr>
					  <tr>
					    <td> &nbsp; </td>
					    <td><hr></td>
					  </tr>
				";
			}
			
			echo "</table>";
		
	?>
</body>
</html>
