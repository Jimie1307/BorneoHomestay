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
<br><br>
<form method="POST" action="add_action.php" enctype="multipart/form-data">
<table border="0" >
<tr>
	<td>Homestay Name:</td>
	<td><input type="text" name="homestayName" size="50"></td>
</tr>
	<tr>
<td>Homestay Address:</td>
<td><input type="text" name="homestayAddress" size="50"></td>
	</tr>
	<tr>
<td>State:</td>
<td><input type="text" name="homestayState" size="50"></td>
	</tr>
		<tr>
			<td>Homestay Image:</td>
			<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
		</tr>
			<tr>
				<td>Availability:</td>
				<td><input type="checkbox" name="availability" value="Y" checked></td>
			</tr>
				<tr>
					<td>Price:</td>
					<td><input type="number" name="price" value=""></td>
				</tr>
				<tr>
		<td>&nbsp;</td>

	<td align="center">
	<br><br>
		<input style="cursor:pointer;" class="button" type="submit" value="Submit"> &nbsp <input style="cursor:pointer;" class="button" type="reset" value="Reset"></td>
</tr>
</table>
</form>
<?php
	$conn->close();
?>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>