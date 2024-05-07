<?php
if(isset($_GET["item_ID"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "Hardware";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));

	$supplier_ID=$_GET['supplier_ID'];

	$query1 = "delete from supplier_item where item_ID= ".$_GET["item_ID"]." and supplier_ID=".$supplier_ID;
	mysqli_query($conn, $query1);


	mysqli_close($conn);
}

header( "Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
exit;
?>