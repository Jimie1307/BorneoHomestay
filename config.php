<?php
		define( 'DB_SERVER', 'localhost');
		define( 'DB_USERNAME', 'root');
		define( 'DB_PASSWORD', 'Parkjimin_13');
		define( 'DB_DATABASE', 'homestay_webeng');
		
	//oop style
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	//check connection
	if ($conn->connect_error) {
		die( "</p>Connection failed: </p>" . $conn->connect_error);
		}
		
		
	?>