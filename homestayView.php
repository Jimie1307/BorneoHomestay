<?php
session_start();
include("config.php");

error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
echo '<p style="text-align:right"><a class="button" href="login.html">Login</a>&nbsp&nbsp<a class="button" ="Register.html">Register</a></p>';

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

<main>
<?php
	$ID = $_GET['hsID'];
	echo "<h2> ".$ID." Homestay </h2> ";
	$sql = "SELECT * FROM homestay WHERE homestayName='$ID'";
	$hsArray = $conn->query($sql);
	//echo "ID: ".$_GET['hsID'];
	if($hsArray->num_rows > 0){
while($row = $hsArray->fetch_assoc()) {
?>
<p> <img src=" <?php echo $row['homestayImg']; ?>"></img> </p>
<p> Address: <?php echo $row['homestayAddress']; ?> </p>
<p> Price: RM<?php echo $row['homestayPrice']; ?> </p>
<p> ⭐️ <?php if ($row['rating'] == "0"){
	echo "No ratings yet";
}else{ 
echo $row['rating'];} ?> </p><br>
 <a class="button" href="homestayBook.php?hsID=<?php echo $row['homestayID'] ?>"> Book</a><br><br>

<?php
}
	}else{
		echo "There seems to be a problem in displaying the details!";
		header("location: index.php");
	}
?>

<section class="comments">
<h3 style="margin-bottom: -1%; text-decoration: overline underline; margin-left: 4%; font-size: 20px; text-align: left;"> Review Section </h3>
	<br>
	<form action="addComment.php" method="POST">
	<legend> Please rate this homestay! </legend>
		<input type="range" min="1" max="5" value="3" class="slider" name="rating" id="rating"> &nbsp
		<p id="rangeValue"> </p>
		<span style=" margin-left: -3%; font-size: 11px;" id="rangeValue" > </span>
		
<script>
var slider = document.getElementById("rating");
var output = document.getElementById("rangeValue");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

		<input style="font-size: 3px; opacity: 0; margin-top: -15%;"class="noclick" type="text" name="hsName" value="<?php echo $ID?>">
		<input class="commentsect" type="text" maxlength="500" name="comment" placeholder="Post a review here!">&nbsp <input style="font-size: 18px; cursor: pointer;"class="button" type="submit" name="submit" value="Post"></input> 
	</form>
	
	<?php
		$sql= "SELECT * from comments WHERE homestayName = '$ID'";
		$result = $conn->query($sql);
		if($result-> num_rows > 0){
			while($row = $result->fetch_assoc()){
				
				?>
		<div class="userComments">
			<p style="font-size: 18px; text-align: left; margin-left: 3%;"> <?php echo $row['userName'] ?> &nbsp <label style="font-size: 11px; opacity: 0.5;"><?php echo $row['datePosted'] ?></p>
			<p style="font-size: 18px; text-align: left; margin-left: 3%;"> <?php echo $row['commentText']?>   </p>
			<p style="font-size: 14px; text-align: left; margin-left: 3%;"> Homestay rating: ⭐️ <?php echo $row['rating']?>  </p>
			<?php 
				if($row['userName'] === $_SESSION["userName"]){
				
				echo '<a href="deleteComment_prompt.php?name='.urlencode($row['commentText']).'" style=" text-decoration: underline; font-size: 12px; float:right;  margin-top: -3%; margin-right: 4%;"> Delete </a></p>
			
				</div><br>';}else{
				echo '<a href="reportComment_prompt.php?name='.urlencode($row['commentText']).'&hsID='.urlencode($ID).'" style=" text-decoration: underline; font-size: 12px; float:right;  margin-top: -3%; margin-right: 4%;"> Report </a></p>';
				}
			
			
			?>
		</div>
				<?php
			}
		}else{
			echo "<p> No comments yet for now! </p>";
		}
	?>
	</div>
</section>

</main>
<br>
</body>
</html>
<footer style="font-size: 10px"><i>Copyright&copy 2020 Wan Norazlin Binti Abdullah</i></footer>
<footer style="font-size: 12px" >Icons made by <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> from <a class="foot" style="font-size: 12px" class="p attribute" href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></footer>56