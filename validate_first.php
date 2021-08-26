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
<body>
<h2 style="padding:2%;"> </h2>
<main style="margin-top: -3.3%;">

<?php 
	//var_dump($_GET);
	$whichChange = $_POST["change"];
	?>
<form method="POST" action="change_action.php">
	<input  style="pointer-events:none; opacity: 0; cursor: no-drop; width: 7%;" type="text" value="<?php echo $whichChange; ?>" name="whichChange"></input>&nbsp
	<p> Current Password:&nbsp <input name="currentPwd" type="password" placeholder= "Enter current password" required></input>&nbsp
	<?php
	if($whichChange == "Change Name"){
		?>

	<p> Change Name:&nbsp <input name="newName" type="text" placeholder= "Enter new name"></input>&nbsp <br><br> <input style="font-size: 17px; cursor : pointer;" class= "button " type="submit" value="Submit"></input></p>
	<?php
	} 
	
	 if($whichChange == "Change Email"){
	?>

	<p> Change Email:&nbsp <input name="newEmail" type="text" placeholder= "Enter new email"></input>&nbsp <br><br><input style="font-size: 17px; cursor : pointer;" class= "button " type="submit" value="Submit"></input></p>
	<?php
	} 
	
	if($whichChange == "Change Password"){
	?>	

	<p> Change Password:&nbsp <input name="newPwd" type="password" placeholder="********" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{0,12}" title= "Must contain at least: one number, one uppercase, one lowercase. Not more than 12 characters!" required></input>&nbsp <br><br><input style="font-size: 17px; cursor : pointer;" class= "button " type="submit" value="Submit"></input></p><br><br>
	<?php
	} 
	
	if($whichChange == "Apply as Owner"){
	?>	
	<p> Do not worry, you can change this information later when we approve you as an owner! </p><br>
	<label> Homestay Name: </label>&nbsp <input type="text" maxlength="50" name="hsName" required><br><br>
	<label> Homestay Address: </label>&nbsp  </label>&nbsp <input type="text" maxlength="50" name="hsAddress" required><br><br>
	<input class="button" type="submit" value="Apply"> &nbsp <a class="button" href="index.php"> Cancel </a>
	<?php
	} 
	
	?>
	<br><br>
</form>
</main>
</body>
</html>