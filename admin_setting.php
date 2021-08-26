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
<?php 
	$stmt = "SELECT * from user WHERE userID= '".$_SESSION["UID"]."'";
	$result= $conn->query($stmt);
	if($result-> num_rows == 1){
		while($row = $result->fetch_assoc()){
			
	?>
	<section>
	
	<p> Username: <?php echo $row['userName'];?> </p>
	<p> Email: <?php echo $row['userEmail'];?> </p>
	
	</section>
	<br>
	<a style="margin-left: 10%;" class="button" href="register_admin.html"> Add an admin </a> &nbsp 
	<a class="button" href="editAdmin.php"> Edit Details</a> &nbsp 
	<a class="button" href="pwdAdmin.php"> Change Password</a>
	
<?php
		}
	}else{
		echo "<p> There seems to be an error at accessing your personal details</p>";
	}
	?>
	
</main>

</body>
</html>