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
<br>
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

</div>
<br>
<form style="padding-bottom: 3%;" method="post" action="search_homestay.php">
	<label for="checkIn">Check In Date:</label>
	<input type="date" value="checkIn" name="checkIn" >&nbsp
	<label for="checkOut">Check Out Date:</label>
	<input type="date" value="checkOut" name="checkOut">&nbsp
	<input class="sub" type="submit" value=" Submit ">
</form>

<main>
<br>
<h2 style="margin-top: -3%;"> HOMESTAY LIST </h2>

<!-- the menu..  -->

<nav class="vertical-menu">
<a class="button" href="index.php" class="active">Home</a>&nbsp
<a class="button" href="recommendation.php">Our Recommendations</a>&nbsp
<?php
if(isset($_SESSION["UID"])){
echo '<a class="button" href="edit_profile.php">Profile</a>&nbsp 
	<a class="button" href="mybooking.php">My Booking</a>&nbsp';
if ($_SESSION["ownership"] == "Y"){
echo '<a class="button" href="homestayList.php">Homestay </a>&nbsp';
}
}
?>
</nav>
<!-- search 'engine' for homestay over here -->
<form style="margin-left: 31% ;width: 63%; padding-bottom: 2%; margin-bottom: 4%;" action="searchDb.php" method="POST">
<!-- I am going to make the user fill in the state and price--->
<label> State: </label>
<select name="state" id="state" >
	<option value="0"> Please select state </option>
	<option value="Melaka"> Melaka </option>
	<option value="Johor"> Johor </option>
	<option value="Kedah"> Kedah </option>
	<option value="Negeri Sembilan"> Negeri Sembilan </option>
	<option value="Pahang"> Pahang </option>
	<option value="Penang"> Penang </option>
	<option value="Perak"> Perak </option>
	<option value="Perlis"> Perlis </option>
	<option value="Sabah"> Sabah </option>
	<option value="Sarawak"> Sarawak </option>
	<option value="Selangor"> Selangor </option>
	<option value="Terengganu"> Terangganu </option>
</select> &nbsp 
<label> Max price: </label>
<input type="range" min="80" max="300" value="150" class="slider" name="priceRange" id="priceRange"> &nbsp
<span style="margin-left: -3%; padding: 1%; font-size: 11px;" id="rangeValue" > </span>
<script>
var slider = document.getElementById("priceRange");
var output = document.getElementById("rangeValue");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
<label> Rating: </label> <input class="slider2" type="range" name="rating" id="rating" min="1" max="5"> </input>&nbsp
<span style="margin-left: -3%; padding: 1%; font-size: 11px;" id="value" > </span>
<script>
var slider2 = document.getElementById("rating");
var output2 = document.getElementById("value");
output2.innerHTML = slider2.value;

slider2.oninput = function() {
  output2.innerHTML = this.value;
}
</script>
&nbsp <input  class="sub" style="cursor: pointer;" type="submit" value="Search"></input>
</form>


<!-- display of homestays -->
<?php
$sql = "SELECT * FROM homestay WHERE homestayImg !='' order by homestayID ASC";
$hs_list = $conn->query($sql);
if ($hs_list->num_rows > 0) {
while($row = $hs_list->fetch_assoc()) {
?>

<div class="product-image"><img style="margin-bottom: 3%; position: right;" src="<?php echo $row["homestayImg"]; ?>"></img> <a class="index" style=" padding: 6px; margin-bottom: 3%;" href="homestayView.php?hsID=<?php echo urlencode( $row["homestayName"]) ?>"> <?php echo $row["homestayName"]; ?></a> </div><br>


<?php
}
} else {
echo "No results";
}
$conn->close();

?>
<br>
</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>