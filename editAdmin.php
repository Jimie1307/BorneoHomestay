<?php
session_start();
include("config.php");

?>

<html>
<title> ADMIN <3 </title>
<meta charset='UTF-8'>
<head> 
<link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
</head>

<header> <h1> ADMIN PAGE </h1> </header>
<body>
<nav class="vertical-menu">
<a href="admin_index.php"> HOME </a> 
<a href="admin_request.php"> REQUEST </a>
<a href="admin_report.php"> REPORT </a>
<a href="admin_setting.php"> SETTING </a>
<a href="logout.php"> LOGOUT </a>
</nav>
<main>
<h3 style=" margin-left: 40%; text-decoration: overline underline;"> Change current personal details </h3>
<?php 
	$stmt = "SELECT * from user WHERE userID= '".$_SESSION["UID"]."'";
	$result= $conn->query($stmt);
	if($result-> num_rows == 1){
		while($row = $result->fetch_assoc()){
			
	?>
	<section>

		<form style="margin-left: 20%;" action="editAdmin_action.php" method="POST">
			<input style="padding: 1px; margin-bottom: -20%;" class="noclick" type="text" name="type" value="1" required> <br>
			<label> Username: </label><input type="text" name="userName" maxlength="50" value=" <?php echo $row['userName'];?>" required> </input><br>
			<label> Email: </label><input type="email" name="userEmail"  value="<?php echo $row['userEmail'];?>" required> </input> <br>
			<label> Password: </label> <input type="password" name="userPwd"  placeholder=" Enter current password" required> </input> <br>
		<br><br>
		<input style="padding: 6px; cursor:pointer;" class="button" name="submit" type="submit" value="Change" > &nbsp <input style="padding: 6px; cursor:pointer;" class="button"  name="reset" type="reset" value="Reset" > </input>
		
		</form>
	</section>
	<?php
		}
	}else{
		echo "<p> There seems to be an error at accessing your personal details</p>";
	}
	?>
	
</main>

</body>
</html>