<?php
session_start();
include("config.php");//OOP
?>
<html>
<body>
<?php
//login values from login form
$username = sanitize_input($_POST['userEmail']);

$password = $_POST['userPwd'];
//EXAMPLE OOP PHP
$bool= validatePassword($password, $username, $conn);
if($bool == 1){
$sql = "SELECT userID, userType, userName, ownership FROM user WHERE userEmail='$username' AND userPwd='$password' LIMIT 1";
$login_data = $conn->query($sql);
if ($login_data->num_rows == 1) {
$row = $login_data->fetch_assoc();
$_SESSION["UID"] = $row["userID"];//set session userID
$_SESSION["userType"] = $row["userType"];
$_SESSION["userName"] = $row["userName"];
$_SESSION["ownership"] = $row["ownership"];

if($row["userType"] == "2"){
	echo "<script>setTimeout(\"location.href = 'admin_index.php';\",1000);</script>";
		}else{
	echo "<script>setTimeout(\"location.href = 'index.php';\",1000);</script>";	
		}
}
 else {
echo "Login error, username or password is incorrect.";
echo "<script>setTimeout(\"location.href = 'login.html';\",500);</script>";
	}
}

function validatePassword($password,$username,$conn){
	 $sql = "SELECT pwdEncrypt FROM user WHERE userEmail='$username'";
	//echo $userName;
	//echo "<br>".$password;
	$login_data = $conn->query($sql);
if ($login_data->num_rows > 0) {
	$row = $login_data->fetch_assoc();
	if (password_verify($password,$row['pwdEncrypt'])){
		return 1;
	}else{
		echo "<h2> Password does not match </h2> <br>";
		echo "<script>setTimeout(\"location.href = 'login.html';\",1200);</script>";
		//echo $row['userPwd'];
		//echo $row['pwdEncrypt'];
	}
 }else{
	echo "<br> Cannot find user. Invalid email!";	
	echo "<script>setTimeout(\"location.href = 'login.html';\",1200);</script>";
}
 }
 
function sanitize_input($data) {//sanitize_input function
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
$conn->close();