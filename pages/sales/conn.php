<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $dbname = "Hardware";
    //create conection
    $conn = new mysqli($servername, $username, "", $dbname);

    //check connection
    if($conn -> connect_errno){
		die("ERROR: Could not connect. " . mysqli_connect_error());
		exit();
	}


?>