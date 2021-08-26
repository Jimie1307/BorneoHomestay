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
	$counter = 0;
	$sql = "SELECT requestID from request";
	$result=$conn->query($sql);
	if($result-> num_rows >0){
		while($row=$result->fetch_assoc()){
			
			++$counter;
		}
	}
	?>
	<h3> OWNER REQUESTS PENDING: <?php echo $counter?> </h3>
	<?php 
	$counter = 0;
	$sql = "SELECT reportID from report";
	$result=$conn->query($sql);
	if($result-> num_rows >0){
		while($row=$result->fetch_assoc()){
			
			++$counter;
		}
	}else{
		echo "";
		
	}
	?>
	<h3> REPORTS: <?php echo $counter?> </h3>



</main>
</body>
</html>