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

<main>
<h2> BOOKING DETAILS </h2>

<?php
	$sql = "SELECT * from booking WHERE userID='".$_SESSION["UID"]."';";
	$hsArray = $conn->query($sql);
	
	if($hsArray->num_rows > 0){
while($row = $hsArray->fetch_assoc()) {
	$hsID = $row['homestayID'];
	//echo $hsID;
?>
<div style="border: 1px solid lightgray; padding: 3px; margin-bottom: 2%; max-width: 24%; border-radius: 4px; margin-left: 38%; margin-right: 0 ;">
<form action="see_booking.php" method="POST">
	<p> Booking ID: <input name="bookID" type="text" style="opacity: 0.75; pointer-events: none; max-width: 6%;" value="<?php echo $row['bookingID'];?>" ></input> </p>
	<p style="font-size: 13px;"> Check-in: <?php echo $row['checkIn'] ?>&nbsp Check-out: <?php echo $row['checkOut'] ?></p>
	<input style="color: maroon; text-decoration: underline; cursor: pointer; font-size:12px; border-style: none; background-color: white;" type="submit" value="BOOKING DETAILS?"> </input>
</form>
</div>
<?php

}
	}
	?>

<br><br>
</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>