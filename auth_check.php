<?php
	if(!isset($_SESSION['customerID'])){
		header("Location: login.php");
	}
?>