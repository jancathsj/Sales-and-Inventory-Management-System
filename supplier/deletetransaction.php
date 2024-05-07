<?php
if(isset($_GET["transaction_ID"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "Hardware";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));

	$sql = "select supplier_ID from supplier_transactions where transaction_ID= ".$_GET["transaction_ID"];
	$result = $conn-> query($sql) or die($conn->error);
		if ($result-> num_rows >0) {
			while ($row = $result-> fetch_assoc()) {
				$supplier_ID = $row["supplier_ID"];
			}
		}

	$query1 = "delete from transaction_items where transaction_ID= ".$_GET["transaction_ID"];
	mysqli_query($conn, $query1);

	$query = "delete from supplier_transactions where transaction_ID= ".$_GET["transaction_ID"];
	mysqli_query($conn, $query);


	mysqli_close($conn);
}

header( "Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
exit;
?>
