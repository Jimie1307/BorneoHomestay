<?php
include("config.php"); 
error_reporting(E_ERROR | E_PARSE);
$userType = $_POST['userType'];
//ini for both user and admin registration
$guestEmail = sanitize_input($_POST['guestEmail']);
$guestName = sanitize_input($_POST['guestName']);
$guestPwd = "";
$pwdHash = "";
$notowner = "N";

$sql = "SELECT * FROM user WHERE userEmail='$guestEmail' AND userPw='$guestPwd' LIMIT 1";

$userExist = $conn->query($sql);
if($userExist->num_rows == 1){
	echo "<p><b>Error: </b> User Exist, cannot register </p>";
}else 
{// User does not exist, insert new user record

if($userType === "1"){
	$guestPwd = $_POST['guestPwd'];
	$pwdHash = trim(password_hash($guestPwd, PASSWORD_DEFAULT)); 
	
}

if($userType === "2"){
	
	$guestPwd= "adomino".rand(10,100);
	$pwdHash = trim(password_hash($guestPwd, PASSWORD_DEFAULT)); 
	
}
	$sql = $conn->prepare("INSERT INTO user (userName, userEmail, userPwd, pwdEncrypt, userType, ownership) VALUES (?,?,?,?,?,?);");
	$sql->bind_param("ssssis",$guestName, $guestEmail, $guestPwd, $pwdHash, $userType, $notowner);
	$sql->execute();
	if($sql){

			echo "Succesfully registered! <br> Taking you to the login page....";
			echo "<script>setTimeout(\"location.href = 'login.html';\",1200);</script>";
	}else{
		echo "</br> Error: " .$sql. "</br>" . mysqli_error($conn);
	}
}
		
function sanitize_input($data) {//sanitize_input function
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
$conn->close();

?>

