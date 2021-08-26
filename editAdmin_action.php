<?php
session_start();
include("config.php");

$type = $_POST['type'];

if($type === "1"){
$newName = sanitize_input($_POST['userName']);
$newEmail = sanitize_input($_POST['userEmail']);
$pass = $_POST['userPwd'];
$emailEnding= ".com";
$userID = $_SESSION["UID"];
$invalid = "Invalid password!";

//check email ada .com x
if(!strpos($newEmail, '.com')){
	$newEmail = $newEmail.$emailEnding;
	echo $newEmail;
}
//check password match ke x
$sql = "SELECT pwdEncrypt from user WHERE userID='$userID' LIMIT 1;";
$result= $conn->query($sql);
if ($result->num_rows >0){
while($row = $result->fetch_assoc()){
	if(password_verify($pass, $row['pwdEncrypt'])){
		//echo "Password matched";
		$sql = $conn->prepare("UPDATE user SET userName = ?, userEmail = ? WHERE userID='$userID';");
		$sql->bind_param("ss", $newName, $newEmail);
		$sql->execute();
		
		if($sql){
			$_SESSION["userName"] = $newName;
			echo "<script type='text/javascript'> alert('Successfully updated your details! Yay ');</script>";
			echo "<script>setTimeout(\"location.href = 'editAdmin.php';\",500);</script>";
		}else{
			echo "<script type='text/javascript'> alert('Something went wrong! Failed to update your info T^T');</script>";
			echo "<script>setTimeout(\"location.href = 'editAdmin.php';\",600);</script>";
		}
		
	}else{
		echo "<script type='text/javascript'> alert('Invalid password!');</script>";
		echo "<script>setTimeout(\"location.href = 'editAdmin.php';\",600);</script>";
	}
  }
}else{
	echo "<script type='text/javascript'> alert('Something went wrong! Failed to retrieve your info T^T');</script>";
	echo "<script>setTimeout(\"location.href = 'editAdmin.php';\",600);</script>";
	}
}

if($type === "2"){
	
$currPwd = $_POST['userPwd'];
$newPwd = $_POST['newPwd'];
$userID = $_SESSION["UID"];

//check currPwd tu betul x
$sql= "SELECT pwdEncrypt from user WHERE userID='$userID';";
$result=$conn->query($sql);
$row= $result->fetch_assoc();

if(password_verify($currPwd,$row['pwdEncrypt'])){
	echo "Match<br>";

	$pwdHash = trim(password_hash($newPwd, PASSWORD_DEFAULT)); 
	$updatePwd= $conn->prepare("UPDATE user SET userPwd= ?, pwdEncrypt=? WHERE userID= '$userID' ;");
	$updatePwd->bind_param("ss", $newPwd, $pwdHash);
	$updatePwd->execute();
		if($updatePwd){
			echo "<br><h2> Successfully changed password!<br> Please login back!...<h2>";
			echo "<script>setTimeout(\"location.href = 'logout.php';\",1000);</script>";
			
		}else{
			echo "<br><h2> There was a problem in changing password. Please login back and try again later.<h2><br>";
			echo "<script>setTimeout(\"location.href = 'logout.php';\",1000);</script>";
		}
}else{
	echo "Password does not match";
	
}
	
	
	
}

function sanitize_input($data) {//sanitize_input function
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}


?>