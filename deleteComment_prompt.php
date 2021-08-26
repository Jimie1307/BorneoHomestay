<?php
session_start();
include("config.php");

$commentTitle = $_GET['name'];

?>
<!-- asalnya nak guna jquery tapi....x geti lagi so :')-->
 <html>
	<style>
	body{
		background-color: #6E7268;
	}
	h2{
		margin-top: 7%;
		margin-bottom: 4%;
		text-align: center;
		margin-left: 26%;
	}
	.prompt{
		margin-top: 10%;
		border: 1px solid lightgray;
		border-radius: 6px;
		background-color: #F8F8F8 ;
		max-width: 35%;
		max-height: 40%;
		line-height: 3em;
		padding-bottom: 5%;
		box-shadow: 1px 1px lightgray;
	}
	a,input{
		border: 1px solid lightgray;
		border-radius: 6px;
		text-decoration: none;
		background-color: whitesmoke;
		color:black;
		font-size: 16px;
		padding: 2%;
		box-shadow: 1px 1px lightgray;
		margin-left: 5%;
		
	}
	a:hover{
		background-color: white;
	}
	input:hover{
		background-color: white;
	}
	.noclick{
		width: 5%;
		margin-left: 30%;
		opacity: 0;
		pointer-events: none;
	}
	</style>
	<body>
	<center>
	<form action="deletepost_action.php" method="POST">
		<div class="prompt">
			<h2> Delete comment? <input class="noclick" type="text" name="name" value="<?php echo $commentTitle;?>"><br></h2>
			<input class="noclick" name="type" type="text" value="1"></input>
			<input style="margin-left: -33%; cursor: pointer;" type="submit" name="submit" value="Yes, delete it" ></input>&nbsp <a href="index.php">Cancel</a>
	</form>
		</div>
	</center>
	</body>
 </html>