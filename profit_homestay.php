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
<h2> PROFIT GAINED </h2>

<table style="width 70%; ">
<tr >
	<th  class="content"> Homestay ID </th>
	<th  class="content"> Homestay Name </th>
	<th  class="content"> Total profit (RM)  </th>
	<th  class="content"> Current rating </th>
</tr>
<tr>
	<?php

	$rating;
	$total=0;
	//amik dulu homestay milik owner nie and also rating dia
	$sql = "SELECT homestayID,homestayName,rating FROM homestay WHERE userID='".$_SESSION["UID"]."'";
	$result = $conn->query($sql);
	if($result-> num_rows > 0){
		while($row = $result->fetch_assoc()){
		
			$rating = $row['rating'];
			?>
			<td  class="content"> <?php echo $row['homestayID']; ?> </td>
			<td  class="content"> <?php echo $row['homestayName']; ?> </td>
			
			<?php
			//amik lak from table booking
			
			?>
			<td  class="content"> <?php findProfit($conn,$row['homestayID']); ?> </td>
			<td  class="content"> <?php echo $rating; ?> </td>
			</tr>
			<?php
		}
	}
	
	function findProfit($conn,$hsID){
		$total = 0;
		$sql = "SELECT bookingPay from booking WHERE homestayID='$hsID'";
			$result = $conn->query($sql);
			if($result-> num_rows > 0){
				while($row=$result->fetch_assoc()){
			
			$total += $row['bookingPay'];
			 echo $total;

				}
			}else{
				
				 echo $total;
			}
		
		
	}
	
	?>
		
</tr>

</table>
<br><br>
</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 </i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>