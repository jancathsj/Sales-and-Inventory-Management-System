<?php
if(isset($_GET["item_ID"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "Hardware";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));

	$supplier_ID=$_GET['supplier_ID'];

	$query2 = "delete from supplier_item where item_ID= ".$_GET["item_ID"]." and supplier_ID=".$supplier_ID;
	mysqli_query($conn, $query2);


	$query1 = "delete transaction_items from transaction_items inner join supplier_transactions on supplier_transactions.transaction_ID=transaction_items.transaction_ID where transaction_items.item_ID= ".$_GET["item_ID"]." and supplier_transactions.supplier_ID=".$supplier_ID;
	mysqli_query($conn, $query1) or die($conn->error);


	$query = "delete supplier_transactions from transaction_items right join supplier_transactions on supplier_transactions.transaction_ID=transaction_items.transaction_ID where transaction_items.item_ID is NULL ";
	mysqli_query($conn, $query) or die($conn->error);



	mysqli_close($conn);
}

header( "Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
exit;
?>
