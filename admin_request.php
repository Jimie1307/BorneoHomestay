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
	<table for="request" style=" border: 1px solid black; margin-left: 20%; width: 80%;">
		<tr>	
			<td> No. </td>
			<td> Username </td>
			<td> Email </td>
			<td>   </td>
		</tr>
		<tr>
	<?php
		$counter = 0;
		$sql = "SELECT * from request";
		$result= $conn->query($sql);
			if($result-> num_rows > 0){
				while($row= $result->fetch_assoc()){
				++$counter;
	?>
			<td class="content"> <?php echo $counter;?> </td>
			<td class="content"> <?php echo $row['userName']; $_SESSION['reqName'] = $row['userName']?></td>
			<td class="content"> <?php echo $row['userEmail']; $_SESSION['reqEmail'] = $row['userEmail']?> </td>
			<td style="line-height: 3.5em; width: 20%; padding: 3%;" class="content"><a style="font-size: 15px; " class="button" href="approveReq_action.php"> APPROVE </a> <br> <a style="font-size: 15px; " class="button" href="reject_action.php"> REJECT </a>
		<?php
				}
			}else{
				echo "
				</tr> </table>
				<h3> There are no requests pending...</h3>";
				
			}
		
		?>
</tr>
	</table>
</main>
</body>
</html>