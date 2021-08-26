<?php 
include("config.php");
session_start();

	
		//dptkn nama and email requester tu
		$requestName = $_SESSION['reqName'];
		$requestEmail = $_SESSION['reqEmail'];
		
		echo $requestName;
		echo "<br>".$requestEmail;
		//check dia wujud x as a member, if not x leh
		$sql="SELECT userID,userName,userEmail from user WHERE userName='$requestName'";
		$userExist=$conn->query($sql);
		
		if($userExist-> num_rows == 1){
		$row= $userExist->fetch_assoc();
		$userID = $row['userID'];
		// wujud then update dia as an owner
		$sql = $conn->prepare("UPDATE user SET ownership= 'Y' WHERE userName='$requestName' AND userEmail='$requestEmail';");
		$sql->execute();
		
		if($sql->execute()){
		//retrieve homestay details from request
		$sql = "SELECT hsName, hsAddress from request WHERE userName='$requestName' AND userEmail='$requestEmail'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$hsName = $row['hsName'];
		$hsAddress = $row['hsAddress'];
		
		$sql = $conn->prepare("INSERT INTO homestay(homestayName, homestayAddress, userID) VALUES(?,?,?); ");
		$sql->bind_param("ssi", $hsName, $hsAddress, $userID);
		$sql->execute();
		
		if($sql){
		echo "<h1> Homestay details have been recorded</h1>";
		//delete request record
		$sql=$conn->prepare("DELETE from request WHERE userName='$requestName'");
		$sql->execute();
		
		echo "<h2>New User became owner successfully</h2><br>";
		echo "<script>setTimeout(\"location.href = 'admin_request.php';\",1200);</script>";
		
		}else{
		echo "<h1>There seems to be a problem at storing homestay details.</h1>";
		echo "<script>setTimeout(\"location.href = 'admin_request.php.php';\",1000);</script>";
	}
		}else{
		echo "</br> Error: " .$sql. "</br>" . mysqli_error($conn);
		echo "<script>setTimeout(\"location.href = 'admin_request.php';\",1600);</script>";	
	}
			}else{
			echo "<h1>User is not an authorised user beforehand: Owner record is not created</h1> <br>";
			echo "<script>setTimeout(\"location.href = 'admin_request.php';\",1200);</script>";
			
	}
		
		
		
	$conn->close();
?>