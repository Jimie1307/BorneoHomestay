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
<h2> YOUR HOMESTAY </h2>
<a class="button" href="profit_homestay.php">See Profit</a>&nbsp
<a class="button" href="add_homestay.php">Add Homestay List</a>&nbsp


<table style=" text-align: center; margin-top: 2%; width: 100%; padding: 3%;">
	<tr>
	<th class="content"> Homestay ID </th>
	<th class="content"> Name </th>
	<th class="content"> Address </th>
	<th class="content"> Price (RM) </th>
	<th class="content"> Availability </th>
	<th class="content"> Image </th>
	<th class="content">  </th>
	</tr>
	<tr>
<?php

$sql= "SELECT * from homestay where userID='".$_SESSION["UID"]."';";
$hs_list = $conn->query($sql);
if ($hs_list->num_rows > 0) {
while($row = $hs_list->fetch_assoc()) {
?>

  <td class="content"> <?php echo $row['homestayID']; ?> </td>
  </form>
  <td class="content"> <?php echo $row['homestayName']; ?></td>
  <td class="content"> <?php echo $row['homestayAddress']; ?></td>
  <td class="content"><?php echo $row['homestayPrice']; ?></td>
  <td class="content"> <?php echo $row['availability']; ?></td>
   <td class="content"> <?php if(!empty($row['homestayImg'])){ echo "Y";}else{ echo "N"; } ?></td>
  <td style="width: 15%; padding-top : 4%; padding-bottom: 5%;" class="content"><a class="button" href="editHomestay.php?hsID=<?php echo urlencode($row['homestayID']); ?>"> EDIT </a> &nbsp <a onclick="return confirm('Are you sure to delete homestay? Deleted homestay cannot be retrieved!')" class="button" href="deletepost_action.php?hsID=<?php echo urlencode($row['homestayID']); ?>&type=5"> DELETE </a> </td>
  </tr>
  
<?php
}
}

?>
</table>

<br><br>
</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>