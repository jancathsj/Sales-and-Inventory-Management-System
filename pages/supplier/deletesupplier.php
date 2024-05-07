<?php
if(isset($_GET["supplier_ID"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "Hardware";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));
	/*$query = "delete from supplier where supplier_ID= ".$_GET["supplier_ID"];
	mysqli_query($conn, $query);*/

	$sql = "SELECT * from supplier where supplier_ID = ".$_GET["supplier_ID"]."";
							
	$result = $conn-> query($sql) or die($conn->error);

	if ($result-> num_rows >0) {
		while ($row = $result-> fetch_assoc()) {
			$supplier_Status=$row["supplier_Status"];
		}
	}

	if($supplier_Status==0){
		$supplier_Status = 1;
	}else{
		$supplier_Status = 0;
	}

	mysqli_query($conn, "UPDATE supplier set supplier_Status=' " . $supplier_Status . " '
				WHERE supplier_ID = ' " . $_GET["supplier_ID"] . " ' ");

	mysqli_close($conn);
}
if(isset($_GET['prevpage'])){
	header( "Location: ./suppliertable.php?supplier_ID=".$_GET["supplier_ID"]);
	exit;
}else{
	header("Location: suppliers.php");
	exit;
}

?>
