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
<h3 style=" margin-left: 40%; text-decoration: overline underline;"> Change Password </h3>

	<form style="margin-left: 35%;" action="editAdmin_action.php" method="POST">
		<input style=" padding: 1px; margin-bottom: -20%;" class="noclick" type="text" name="type" value="2" required> 
		<br>
		<label> Current Password: </label> &nbsp <input type="password" name="userPwd"  placeholder="********" required></input><br>
		<label> New Password: </label> &nbsp <input type= "password" name="newPwd" placeholder="********" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{0,12}" title= "Must contain at least: one number, one uppercase, one lowercase. Not more than 12 characters!" required><br>
<br>

	<input style="padding: 6px; cursor:pointer;" class="button" name="submit" type="submit" value="Change" > &nbsp <input style="padding: 6px; cursor:pointer;" class="button" name="reset" type="reset" value="Reset" > </input>
	</form>
	

</main>
</body>
</html>