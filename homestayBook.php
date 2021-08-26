<?php
session_start();
include("config.php");

if(!isset($_SESSION["UID"])){
	echo "<script> alert('Login first to book!') </script>";
	echo "<script>setTimeout(\"location.href = 'login.html';\",800);</script>";	
	
}else{
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
<a class="button" href="index.php" class="active">Home</a>&nbsp
<?php
if(isset($_SESSION["UID"])){
echo '<a class="button" href="edit_profile.php">Profile</a>&nbsp';
echo '<a class="button" href="mybooking.php">My Booking</a>&nbsp';
if ($_SESSION["ownership"] == "Y"){
echo '<a class="button" href="add_homestay.php">Add Homestay List</a>&nbsp';
echo '<a class="button" href="homestayList.php">Homestay List</a>&nbsp';
}
}

?>
</div>
<?php

$hsID = $_GET['hsID'];
$sql = "SELECT * from homestay WHERE homestayID='$hsID.';";
$result = $conn->query($sql);

if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		
?>
<h2> </h2>
<form style="margin-top: -3.5%;" method="post" action="booking_action.php">
	<label>Payment per night : </label> RM <input style="width: 2%; pointer-events: none; opacity: 0.5;" name="hsPay" type="text" value="<?php echo $row['homestayPrice'] ?>"> </input>
	<br><br><label for="hsBook">Homestay</label>
	<input  style="pointer-events:none; opacity: 0.5; cursor: no-drop; width: 5%;" type="text" value="<?php echo $row['homestayID']; ?>" name="hsBook">&nbsp
	<br><br>
	<label for="checkIn">Check In Date:</label>
	<input  style="cursor: pointer;" type="date" value="checkIn" name="checkIn">&nbsp
	<label for="checkOut">Check Out Date:</label>
	<input style="cursor: pointer;" type="date" value="checkOut" name="checkOut">&nbsp
	<br><br><input class="sub" type="submit" value=" Submit "></input>&nbsp <a class="sub" style="text-decoration: none; padding: 7px; margin-top:1%;" href="index.php"> Cancel </a>
</form>
<br><br>
</div>

<?php

		}
	}
?>
</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>
<?php
}
$conn->close();
?>
