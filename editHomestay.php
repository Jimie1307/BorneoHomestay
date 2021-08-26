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
<?php
 $hsID= $_GET['hsID'];
 $sql = "SELECT * from homestay WHERE homestayID='".$hsID."';";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
?>
<h2> HOMESTAY <?php echo $hsID?><br><br> </h2>
<main style="margin-top: -4%;">
<form action="edit_action.php" method="POST"  enctype="multipart/form-data">
	<p>ID: <input style=" opacity: 0.5; cursor: no-drop;" name="hsID" type="text" value="<?php echo $hsID?>" readonly></input></p>
	<p>Name: <input name="updateName" type="text" value="<?php echo $row['homestayName']?>"></input></p>
	<p>Address: <input name="updateAddress" type="text" value="<?php echo $row['homestayAddress']?>"></input></p>
	<p>State: <input name="updateState" type="text" value="<?php echo $row['homestayState']?>"></input></p>
	<p>Price: <input name="updatePrice" type="number" value="<?php echo $row['homestayPrice']?>"></input></p>
	<p>Current Image:<img src="<?php echo $row['homestayImg']?>"> </img> &nbsp 
	<p> New Image (If needed):<input style="margin-left: 2%;" type="file"  id="imgUpload" name="imgUpload" ></input><br></p>
	<label for="title"> *Show Homestay: </label>
		<?php if($row['availability']==="Y"){
			echo '<input style="margin-left: 2%;" type="radio" name="updateAvail" value="Y" checked>Y<input type="radio" name="updateAvail" value="N" >N</input><br>';
		}else{
			echo '<input style="margin-left: 2%;" type="radio" name="updateAvail" value="Y">Y<input type="radio" name="updateAvail" value="N" checked>N</input><br>';
		}
		?>
	
	</input>
<!--	<p>Current Image: <?php echo $row['homestayImg']?></p>
	<p>New Image: <input type="file" name="updateImg"></input>-->
<br><br>
<center>
<input style="cursor: pointer;" class="button" type="submit" value="Submit"> &nbsp <a class="button" href="homestayList.php">Cancel</a>

</form>


<br><br>

</center>
<?php
}
 }
 $conn->close();
 ?>


</main>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>