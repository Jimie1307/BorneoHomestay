<?php
session_start();
include("config.php");

$commentText = $_GET['name'];
$hsID = $_GET['hsID'];


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
		margin-left: auto;
		margin-right: -55%;
	}
	.prompt{
		margin-top: 10%;
		border: 1px solid lightgray;
		border-radius: 6px;
		background-color: #F8F8F8 ;
		max-width: 75%;
		max-height: 50%;
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
	select{
		padding: 3px;
		
		
	}
	</style>
	<body>
	<center>
	<form action="deletepost_action.php" method="POST">
		<div class="prompt">
			<h2> Tell us more about the comment! <input class="noclick" type="text" name="name" value="<?php echo $commentText;?>"><br></h2>
			<select for="report" name="reportCause" id="reportCause">
				<option value="Inapproriate remark (Nudity/pornography/ degradation)">Inapproriate remark (Nudity/pornography/ degradation)</option>
				<option value="Dangerous organization or individuals">Dangerous organization or individuals</option>
				<option value="Inapproriate remark">Inapproriate remark</option>
				<option value="Harassment/Bullying">Harassment/Bullying</option>
				<option value="Hate speech">Hate speech</option>
				<option value="Spam">Spam</option>
				<option value="Intellectual Property Infringement">Intellectual Property Infringement</option>
				<option value="Other">Others</option>
			</select><br><br>
			<input class="noclick" name="type" type="text" value="2"></input>
			<input style="margin-bottom: 25%; margin-left: -33%; cursor: pointer;" type="submit" name="submit" value="Yes, report it" ></input>&nbsp <a href="homestayView.php?hsID=<?php echo urlencode($hsID) ?>">Cancel</a>
	</form>
		</div>
	</center>
	</body>
 </html>