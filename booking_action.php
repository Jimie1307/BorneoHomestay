<?php
session_start();
include("config.php");

if(!isset($_SESSION["UID"])){
header("location:login.html");}


?>

<!DOCTYPE html>
<meta charset='UTP-8'>
<html>
<title> Homepage </title>
<head>
<link rel="stylesheet" href="homestayWebEng.css?v=<?php echo time(); ?>">
</head>
<header><h1><img class="home" src="homestay.png"></img> &nbsp ~Borneo Homestay~</h1> </header>
<body>
<h2></h2>
<main>
<?php
//login&logout section
if(isset($_SESSION["UID"])){
echo '<p style=" text-align:right"> '. $_SESSION["userName"] . ' <a href="logout.php">Logout</a></p>';
}
else {
echo '<p style="text-align:right"><a href="loginPage.html">Login</a>&nbsp&nbsp<a href="Register.html">Register</a></p>';

}
echo "<br><br><br>";

$inDate = new DateTime($_POST['checkIn']);
$outDate = new DateTime($_POST['checkOut']);
$hsPay = $_POST['hsPay'];
$hsBook = $_POST['hsBook'];

$interval = $outDate->diff($inDate);
$bookDays = $interval->format('%a');
//echo $bookDays;

$pay = number_format((double)$bookDays*$hsPay, 2,'.','');
//echo $pay;
//echo $_SESSION["UID"];
//echo  $hsBook;
$sql = $conn->prepare( "INSERT INTO booking(userID, homestayID, bookingPay, checkIn, checkOut) VALUES (?, ?, ?, ?,?)");
$sql->bind_param("iidss", $_SESSION["UID"], $hsBook, $pay, $_POST['checkIn'], $_POST['checkOut']);
$sql->execute();

if(!$sql){
	error_log("Booking transaction failed. Try again later.",0);
	echo "<script>setTimeout(\"location.href = 'index.php';\",1400);</script>";
}
else{
	
	echo "<p>Booking successful! </h1> <br><p> <b>Please wait as we redirect you to homepage..... <b> </p><br>";
	echo "<script>setTimeout(\"location.href = 'index.php';\",1400);</script>";


}

$conn->close();

?>

</main>
</body>
</html>