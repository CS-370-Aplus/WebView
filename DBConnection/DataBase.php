<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }
	
	function checkUser($table, $username, $type)
	{
		$username = $this->prepareData($username);
		$this->sql = "select * from " . $table . " where username = '" . $username . "'";
		$result = mysqli_query($this->connect, $this->sql);
		$row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
			$dbusername = $row['username'];
			$dbtype = $row['type'];
			if($dbusername == $username && $dbtype == $type){
				$userFound = true;
			}else $userFound = false;
		}else $userFound = false;
		return $userFound;
	}

    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($table, $firstname, $lastname, $username, $email, $password, $zipcode, $type, $status)
    {
        $firstname = $this->prepareData($firstname);
		$lastname =  $this->prepareData($lastname);
        $username = $this->prepareData($username);
		$email = $this->prepareData($email);
        $password = $this->prepareData($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
		$zipcode = $this->prepareData($zipcode);
		$type = $this->prepareData($type);
		$status = $this->prepareData($status);
        $this->sql =
            "INSERT INTO " . $table . " (firstname, lastname, username, email, password, zipcode, type, createddate, status) VALUES ('" . $firstname . "','" . $lastname . "','" . $username . "','" . $email . "','" . $password ."'," . $zipcode .",'" . $type ."', NOW()" . ",'" .$status. "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
	
	function getID($table, $username)
	{
		$username = $this->prepareData($username);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
			$userid = $row['userid'];
		}else $userid = "No match";
		return $userid;
	}
	
	function getUserInfo($table, $userid){
		$userid = $this->prepareData($userid);
		$this->sql = "select * from " . $table . " where userid = '" . $userid . "'";
		$result = mysqli_query($this->connect, $this->sql);
		$row = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result) != 0){
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$email = $row['email'];
			return array($firstname, $lastname, $email);
		}else return array('null', 'null', 'null');
	}
	
	function checkEmail($table, $email){
		$email = $this->prepareData($email);
		$this->sql = "select * from " . $table . " where email = '" . $email . "'";
		$result = mysqli_query($this->connect, $this->sql);
		$row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
			$dbemail = $row['email'];
			if($dbemail == $email){
				$emailFound = true;
			}else $emailFound = false;
		}else $emailFound = false;
		return $emailFound;
	}
	
	function addResetCode($table, $email, $code){
		$email = $this->prepareData($email);
		$code = $this->prepareData($code);
		$this->sql = "INSERT INTO " . $table . " (email, code) VALUES('" . $email . "', '" . $code . "')";
		if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
	}
	
	function getNextImageID(){
		$this->sql = "select MAX('pid') from images";
		$result = mysqli_query($this->connect, $this->sql);
		$row = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) != 0) {
			return $row['pid'];
		}return '0';
	}
	
	function addToImages($table, $itemid, $link){
		$itemid = $this->prepareData($itemid);
		$link = $this->prepareData($link);
		$this->sql = "INSERT INTO " . $table . " (itemid, link) VALUES('" . $itemid . "' , '" . $link . "')";
		if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
	}
		
		
	function additem($table, $id, $title, $color, $size, $gender, $description, $quantity, $price){
		$id = $this->prepareData($id);
		$title = $this->prepareData($title);
		$color = $this->prepareData($color);
		$size = $this->prepareData($size);
		$gender = $this->prepareData($gender);
		$description = $this->prepareData($description);
		$quantity = $this->prepareData($quantity);
		$price = $this->prepareData($price);
		
}

?>
