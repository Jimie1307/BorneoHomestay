<?php
include("config.php");//OOP
session_start();

$userID = $_SESSION["UID"];
$choice = $_POST['whichChange'];
$error= "Invalid password! ";
$pass = sanitize_input($_POST['currentPwd']);
//check mana satu nk tukar
//echo $userID;
//echo $choice;

//validate password first
 $bool = validatePassword($pass,$userID,$conn);
 
 if($bool == 1){
	echo "Password matched.."; 
if($choice == "Change Name"){

$newName = sanitize_input($_POST['newName']);	
 $sql= $conn->prepare("UPDATE user SET userName= '$newName' WHERE userID= '$userID';");
 $sql->execute();
 if($sql){
	echo "<br> Your name is successfully updated!<br> Please login back!...";
	echo "<script>setTimeout(\"location.href = 'logout.php';\",1000);</script>";
 }else{
	errorMessage();
 }
}


else if($choice == "Change Password"){
	$newPwd = sanitize_input($_POST['newPwd']);
	$pwdHash = trim(password_hash($newPwd, PASSWORD_DEFAULT)); 
 $sql= $conn->prepare("UPDATE user SET userPwd= '$newPwd', pwdEncrypt= '$pwdHash' WHERE userID= '$userID';");
	
 $sql->execute();
  if($sql){
	echo "<br> Successfully changed password!<br> Please login back!...";
	echo "<script>setTimeout(\"location.href = 'logout.php';\",1000);</script>";
 }else{
	errorMessage();
 }
 
}

else if($choice == "Change Email"){
	$newEmail = sanitize_input($_POST['newEmail']);
 $sql= $conn->prepare("UPDATE user SET userEmail= '$newEmail' WHERE userID= '$userID';");
 $sql->execute();
 
  if($sql){
	echo "<br> Your email is successfully updated!<br>";
	echo "<script>setTimeout(\"location.href = 'index.php';\",1000);</script>";
 }else{
	errorMessage();
 }
}

else if($choice == "Apply as Owner"){
	$hsName = sanitize_input($_POST['hsName']);
	$hsAddress = sanitize_input($_POST['hsAddress']);
	
	//fetch email from user table
	$sql = "SELECT userEmail from user WHERE userID='".$_SESSION["UID"]."'";
	$result = $conn->query($sql);
	$row= $result->fetch_assoc();
	$userEmail = $row['userEmail'];
	
	$sql= $conn->prepare("INSERT INTO request(userName, userEmail,hsName,hsAddress) VALUES(?,?,?,?); ");
	$sql->bind_param("ssss", $_SESSION["userName"], $userEmail, $hsName, $hsAddress);
	$sql->execute();
	
	if($sql){
		echo "<h1> Thank you for applying! Your request is under review . <br> If accepted, you will be notified! If not, your homestay details will be deleted!</h1>";
		echo "<script>setTimeout(\"location.href = 'index.php';\",1000);</script>";
	}else{
		echo "<h1>There seems to be a problem at sending your application.<br> Please try again later. </h1>";
		echo "<script>setTimeout(\"location.href = 'index.php';\",1000);</script>";
	}
}

else{
	//header("location: edit_profile.php"); 
}

 }
 
 
function sanitize_input($data) {//sanitize_input function
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
 
function errorMessage(){
	echo "Oops, there is a problem! Try later.";
	echo "<script>setTimeout(\"location.href = 'edit_profile.php';\",1000);</script>";
 }
 
 function validatePassword($pass,$userID,$conn){
	 $sql = "SELECT pwdEncrypt FROM user WHERE userID='$userID'";
//	echo $userID;
//	echo "<br>".$pass;
	$login_data = $conn->query($sql);
if ($login_data->num_rows > 0) {
	$row = $login_data->fetch_assoc();
	if (password_verify($pass,$row['pwdEncrypt'])){
		return 1;
	}else{
		echo "<br> Password does not match <br>";
		//echo $row['userPwd'];
	///	echo $row['pwdEncrypt'];
	}
 }else{
	echo "<br> Cannot find row.";	
}
 }
 
?>