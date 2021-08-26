<?php
include("config.php");
session_start();

//dptkn nama and email requester tu
		$requestName = $_SESSION['reqName'];
		$requestEmail = $_SESSION['reqEmail'];
		
//access the table and delete je la
		$sql = $conn->prepare("DELETE from request WHERE userName = '$requestName' AND userEmail = '$requestEmail';");
		$sql->execute();
		
		if($sql->execute()){
			echo "<h1> Rejection successful!</h1>";
			echo "<script>setTimeout(\"location.href = 'admin_request.php';\",1000);</script>";	
			
		}else{
			echo "<h1> Rejection unsuccessful!</h1>";
			echo "<script>setTimeout(\"location.href = 'admin_request.php';\",1000);</script>";	
		}

?>