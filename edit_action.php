<?php
session_start();
include("config.php");
if(!isset($_SESSION["UID"]))
header("location:login.html");

$hsID = $_POST["hsID"];
$updateName= $_POST["updateName"];
$updateAddress= $_POST["updateAddress"];
$updatePrice= $_POST["updatePrice"];
$state = $_POST["updateState"];
$updateAvail = $_POST["updateAvail"];

//update name,address and price duluan
$sql= $conn->prepare("UPDATE homestay SET homestayName = ?, homestayAddress = ?, homestayPrice = ?, homestayState = ?, availability = ? WHERE homestayID= '".$hsID."';");
$sql->bind_param("ssiss", $updateName, $updateAddress, $updatePrice, $state, $updateAvail);
$sql->execute();

if($sql){
		echo "Checking image....";
		$check = checkImage($updateName,$conn);
		if($check === 1 ){
			echo "<h1> No image was uploaded. Successfully updated! </h1> <br><p> <b>Please wait as we redirect you to homepage..... <b> </p><br>";
			echo "<script>setTimeout(\"location.href = 'homestayList.php';\",1300);</script>";
			
		}else{
			echo "<h1> An image was uploaded. Successfully updated! </h1> <br><p> <b>Please wait as we redirect you to homepage..... <b> </p><br>";
		echo "<script>setTimeout(\"location.href = 'homestayList.php';\",1300);</script>";
		}
		
}

function checkImage($updateName,$conn){
	$target_dir = "homestayImg/";
	if(empty($_FILES["imgUpload"]["name"])){
		$target_file = "";
		return 1;
	}else{
		
		$target_file = $target_dir . basename($_FILES["imgUpload"]["name"]);
		clearstatcache();		
		
if(filesize($target_file)){
	//fetch the project ID
	$sql = "SELECT homestayID from homestay WHERE homestayName = '$updateName';";
	$result= $conn->query($sql);
	$row= $result->fetch_assoc();
	$hsID = $row['homestayID'];
	
	//dan bwh nie sume copy paste from previous ones I alrdy edited and did from dr suraya punya 
	$uploadOk = 1;
	$sql=$conn->prepare("UPDATE homestay SET homestayImg = '$target_file' WHERE homestayID='$hsID'; ");
			
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imgUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["imgUpload"]["tmp_name"], $target_file)) {
		
		$imgUp = $sql->execute();
		if ($imgUp) {
			return 2;	
		}
		else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
		$conn->close();
        echo "The file ". basename( $_FILES["imgUpload"]["name"]). " has been uploaded.";		
	} else {
        echo "There was an error uploading your file.<br>";
		echo "<script>setTimeout(\"location.href = 'editHomestay.php';\",1500);</script>";	
    }	
}
}else{
		echo "There was a problem";
		
	}
	
}
}

$conn->close();
?>

</main>
</body>
</html>