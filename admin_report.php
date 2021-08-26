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
<br> 
	<table for="report" style=" width: 70%;">
		<tr>
			<th class="title" style="width: 10%;">  </th>
			<th class="title" style="width: 10%;"> ID </th>
			<th class="title"> REPORTS </th>
			
		</tr>
		
	<?php 
	$commentID = "";
	//amik info from report
	$sql = "SELECT * from report order by commentID ASC";
			$result = $conn->query($sql);
			if($result-> num_rows >0){
				while($row = $result->fetch_assoc()){
				?> 
			<form action="deletepost_action.php" method="POST" enctype="multipart/form-data">
			<tr>
			<td class="content"> <input type="checkbox" name="checklist[]" value="<?php echo $row['commentID']; ?>"></input></td>
			<td class="content"> <?php echo $row['commentID']?></td>
			<td class="content"> <?php echo $row['reportCause']?></td>
					<?php
				}
			  
			
		}else{
		echo "<p> No reports submitted for now </p>";
}?>
	</tr>
	</table>
	<input style="margin-left: 23%;  width: 2%;" class="noclick" type="text" name="type" value="3"></input>
	<input class="button" style="margin-top: 2%; padding: 4px; cursor: pointer;" type="submit" value="Delete"> &nbsp <input style="margin-top: 2%; padding: 4px; cursor: pointer;" class="button" type="reset" value="Reset"></input>
		</form>
		
	<br><br>
	<table style="width: 70%; margin-left: 19%;">
		<tr>
			<th class="title"> ID</th>
			<th class="title"> COMMENT </th>
		</tr>
		
		<tr>
	<?php 
			$sql = "SELECT commentID,commentText from comments WHERE strikeTally > 0 order by commentID";
			$result = $conn->query($sql);
			if($result->num_rows >0){
				while($row = $result->fetch_assoc()){
			?>
			<td class="content"><?php echo $row['commentID'];?></td>
			<td class="content"><?php echo $row['commentText'];?></td>
			</tr>
			<?php
				}
			}
			?>	
		
	</table>
	
	
</main>
</body>
</html>