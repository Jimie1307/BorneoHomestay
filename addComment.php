<?php 

include("config.php");
session_start();
$hsName = $_POST['hsName'];
$newRating = $_POST['rating'];

	if(!isset($_SESSION["userName"])){
			echo '<script> alert("Please login.") </script>';
			echo "<script>setTimeout(\"location.href = 'login.html';\",800);</script>";
		}else{
			$comment = $_POST['comment'];
			$sql=$conn->prepare("INSERT INTO comments (commentText, userName, homestayName, rating) VALUES(?,?,?,?);");
			$sql->bind_param("sssi", $comment, $_SESSION["userName"], $hsName, $newRating);
			$sql->execute();
			
			if(!$sql){
				echo '<script> alert("Comment not posted. There was an error.") </script>';
				echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",1000);</script>";
			}else{
				//kira brp rmai yg dh comment homestay nie
				$cust = 0;
				$stmt = "SELECT * from comments WHERE homestayName = '$hsName'";
				$result = $conn->query($stmt);
				if($result-> num_rows >0){
					while($row = $result->fetch_assoc() ){
						++$cust;
					}
				}
				//kira jumlah rating yg dh ada lak
				$stmt = "SELECT rating from homestay WHERE homestayName = '$hsName'";
				$result = $conn->query($stmt);
				$row = $result->fetch_assoc();
				$currRate = $row['rating'];
				
				//echo $cust."<br>";
				//echo $currRate."<br>";
				
				//kira average rating
				$aveRate =($currRate + $newRating)/$cust;
				//echo number_format((float)$aveRate, 2,'.','');
				//echo $aveRate;
				$average = number_format((float)$aveRate, 2,'.','');
				$stmt = $conn->prepare("UPDATE homestay SET rating = '$average' WHERE homestayName='$hsName' ");
				$stmt->execute();
				if($stmt){ 
				//echo "Successfuly rated!";
				header("location:homestayView.php?hsID=".$hsName."");
				}else{  echo "<h1> Rating homestay failed </h1>";
					echo "<script>setTimeout(\"location.href = 'homestayView.php?hsID=".$hsName."';\",1000);</script>";
				}
			
			}
		}
	
		
?>