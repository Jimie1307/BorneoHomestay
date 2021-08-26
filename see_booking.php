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
	$bookID = $_POST['bookID'];
	$sql = "SELECT homestayID, bookingPay, checkIn, checkOut from booking WHERE bookingID='$bookID';";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	$hsID = $row['homestayID'];
	$in = new DateTime($row['checkIn']);
	$out = new DateTime($row['checkOut']);
	$duration= $in->diff($out);
	$payment = $row['bookingPay'];
	$sql = "SELECT * from homestay WHERE homestayID='$hsID';";
	$hsArray = $conn->query($sql);

	if($hsArray->num_rows > 0){
while($row = $hsArray->fetch_assoc()) {
?>
<div style=" margin-left: 30%; border: 1px solid gray; max-width: 40%; box-shadow: 1px 1px lightgray; border-radius: 10px;">
	<p> Homestay Name: <?php  echo $row['homestayName']; ?></p>
	<p> Address:  <?php echo $row['homestayAddress'];?> </p>
	<p> Duration of stay: <?php echo $duration->format("%d days"); ?> </p>
	<p> Total Payment: RM <?php echo $payment;?> </p>
</div>
<br>
<?php
}

		}else{
		echo "<p><center> You have no bookings yet!";
	}
	
	
	$conn->close();
?>