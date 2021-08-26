<?php
session_start();
include("config.php");
if(!isset($_SESSION["UID"])){
header("location:index.php");
}


?>

<!DOCTYPE html>
<meta charset='UTP-8'>
<html>
<title> Homepage </title>
<head>
<link rel="stylesheet" href="homestayWebEng.css?v=<?php echo time(); ?>">
</head>
<header><h1 ><a href="index.php"><img class="home" src="homestay.png"></img></a> &nbsp ~Borneo Homestay~</h1> </header>
<body>
<?php
//login&logout section
if(isset($_SESSION["UID"])){
echo '<p style=" text-align:right"> '. $_SESSION["userName"] . ' <a class="button" href="logout.php">Logout</a></p>';
}
else {
echo '<p style="text-align:right"><a class="button" href="login.html">Login</a>&nbsp&nbsp<a class="button" href="Register.html">Register</a></p>';

}


?>

<div class="topnav">
<a class="button" href="index.php" class="button">Home</a>&nbsp
<?php
if(isset($_SESSION["UID"])){
echo '<a class="button" href="edit_profile.php">Profile</a>&nbsp';
echo '<a class="button" href="mybooking.php">My Booking</a>&nbsp';
if ($_SESSION["ownership"] == "Y"){
echo '<a class="button" href="homestayList.php">Homestay</a>&nbsp';
}
}

?>
</div>

<h2 style="padding: 2%;"> PROFILE DETAILS <br></h2>
<main style="margin-top: -3.3%;">
<br>
<?php
//echo $_SESSION["UID"];
 $sql="SELECT * from user WHERE userID ='".$_SESSION["UID"]."';";
 $hs_list = $conn->query($sql);
if ($hs_list->num_rows > 0) {
while($row = $hs_list->fetch_assoc()) {
	
	?>
	<p  >Username: &nbsp <?php echo $row['userName'];?> </p>
	<p >Email: &nbsp <?php echo $row['userEmail'];?> </p>
	
<form action="validate_first.php" method="POST">
<input style="font-size: 17px; cursor : pointer;" class="a button" type="submit" name="change" value="Change Name"> </input> &nbsp
<input style="font-size: 17px; cursor : pointer;" class="a button" type="submit" name="change" value="Change Email"> </input> &nbsp
<input style="font-size: 17px; cursor : pointer;" class="a button" type="submit" name="change" value="Change Password"> </input> &nbsp
<?php
if($_SESSION["ownership"] == "N"){
echo '<input style="font-size: 17px; cursor : pointer;" class="a button" type="submit" name="change" value="Apply as Owner"> </input> &nbsp';
}else{
	echo "";
	
}
?>
</form>
 <br>

<a style="border: 1px solid gray; font-size: 17px;cursor : pointer; background-color: #FF5C5C;" href="deleteProfile_prompt.php" class="a button"> DELETE ACCOUNT </a> <br><br>

<?php
	}
}else{
	echo "<br> Error occured. Could not find user.<br>";
	header("location: logout.php");
}
$conn->close();
?>

</main>
</body>
</html>