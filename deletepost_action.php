<?php 
include("config.php");
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['type'])){
	$type= $_POST['type'];
}
else{
	$type= $_GET['type'];
}
//this is to separate btw user deleting their comment & user report a comment, with admin deleting comments
if(isset($_POST['name'])){
	$thingName = $_POST['name'];
	
	$sql= "SELECT homestayName from comments WHERE commentText = '$thingName'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$hsName = $row['homestayName'];
	
// user delete comment 
	if($type === "1"){

$stmt= "DELETE from comments WHERE commentText = '$thingName';";
$result= $conn->query($stmt);
if($result){
	echo "<h1> Deleted comment from".$hsName." review section successfully! </h1>";
	echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",900);</script>";	
}else{
	echo "There is a problem in deleting!";
	echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",800);</script>";	
	
}
}

//user report comment
if($type === "2"){

	$cause =$_POST['reportCause'];
	$commentID="";
	
	//amik commentID sat
	//yang I noticed is that if the comment ada '' or  "", mysql wont take it well. They will say ada syntax error so be careful for the comments
	$sql= "SELECT commentID FROM comments WHERE commentText = '$thingName'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$commentID = $row['commentID'];
	if($commentID){
		echo "Success #1";
	}else{
		echo "Problem #1";
	}
    
	//update strike tally
	$sql = "UPDATE comments SET strikeTally=strikeTally+1 WHERE commentID='$commentID'";
	$result=$conn->query($sql);
	if($result){
		echo "Strike updated";
	}else{
		echo "Something wrong in striking comment";	
		echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",1000);</script>";	
	}
	
	//then insert into report table
	$sql = $conn->prepare("INSERT INTO report(commentID, reportCause) VALUES(?,?) ");
	$sql->bind_param("is", $commentID, $cause);
	if($sql->execute()){
		echo "<h2> Report will be reviewed! Thank you for your cooperation. </h2>";
		echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",1000);</script>";	
	}else{
		echo "<h2> Failed to save report. Try again later. </h2>";
		echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",1000);</script>";	
	}
	
	
	}
}else{
	//delete report comments from admin's side
	if($type === "3"){

		if(isset($_POST['checklist'])){

			foreach($_POST['checklist'] as $check){

				$ID = (int)$check;
				$sql = "DELETE from comments WHERE commentID = '$ID' ";
				$result = $conn->query($sql);
				
				if($result){
					echo "<h3> Comment deleted successfully </h3>";
					echo "<script>setTimeout(\"location.href = 'admin_report.php';\",900);</script>";	
				}else{
					echo "<h3> Comment is not deleted. Try again later </h3>";
					echo "<script>setTimeout(\"location.href = 'admin_report.php';\",900);</script>";	
				}
			}
		}
	
	}
	
	//user delete account dia
	if($type === "4"){

		$userID = $_SESSION["UID"];
		//delete dia alluhama live long my fellow ex-user T^T
		$sql = "DELETE from user WHERE userID='$userID'";
		$result = $conn->query($sql);
		if($result){
			
			echo "<center><h1>Your account is successfully deleted! Thank you for using us <3 </h1>";
			echo "<script>setTimeout(\"location.href = 'logout.php';\",900);</script>";	
		}
	}
	
	if($type === "5"){
		
		$hsID = $_GET["hsID"];
		$sql = $conn->prepare("DELETE from homestay WHERE homestayID='$hsID'");

		if($sql->execute()){
			
			echo "<center><h1>Your homestay is successfully deleted! <3 </h1>";
			echo "<script>setTimeout(\"location.href = 'homestayList.php';\",900);</script>";	
		}
		
		
	}
}
$conn->close();
?>