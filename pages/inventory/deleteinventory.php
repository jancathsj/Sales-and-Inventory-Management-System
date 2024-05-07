<?php
if(isset($_GET["item_ID"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "Hardware";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));
	$query = "delete from inventory where item_ID= ".$_GET["item_ID"];
	mysqli_query($conn, $query);
	mysqli_close($conn);
	
}
header("Location: ./inventory.php");
exit;
?>