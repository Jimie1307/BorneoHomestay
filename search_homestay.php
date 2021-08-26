<?php
session_start();
include("config.php");



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
echo '<p style="text-align:right"><a class="button" href="loginPage.html">Login</a>&nbsp&nbsp<a class="button" href="Register.html">Register</a></p>';

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
<?php
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];
$searchQuery = "SELECT hs.homestayID AS hsID, hs.homestayName AS hsName, hs.homestayImg AS hsImg, b.homestayID as hsBooked, b.checkIn, b.checkOut, b.userID FROM homestay hs LEFT JOIN booking b ON hs.homestayID = b.homestayID AND b.checkOut >= '". $checkIn ."' AND b.checkIn <= '". $checkOut ."' WHERE b.homestayID IS NULL AND homestayImg != '' ";
$hsArray = $conn->query($searchQuery);

if($hsArray->num_rows > 0){
// output data of each row
?>
<h2> Homestay Available</h2>
<h2 class="duration">Booking duration: <?php echo $checkIn; echo " -> ".$checkOut; ?> </h2>

<?php
while($row = $hsArray->fetch_assoc()) {
?>
<img src=" <?php echo $row["hsImg"] ?>"></img>
<p>Homestay ID: <?php echo $row["hsID"]; ?><br> Homestay Name: <?php echo $row["hsName"]; ?></p> <a class="button" href="homestayBook.php?hsID=<?php echo $row["hsID"] ?>"> Book</a>

<a class="button" href="homestayView.php?hsID=<?php echo $row["hsID"] ?>"> View </a> <br><br>
<?php
}
}
else {
echo "0 results <br>";
}
?>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>