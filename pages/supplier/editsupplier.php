
<?php
	include_once '../../env/conn.php';

	//Edit supplier query
	if(isset($_POST['edit'])>0){
		$name = $_POST['editName'];
		$ID = $_POST['editID'];
		$person = $_POST['editPerson'];
		$number = $_POST['editNumber'];
		$address = $_POST['editAddress'];
		mysqli_query($conn, "UPDATE supplier set supplier_ID='$ID', supplier_Name='$name', supplier_ContactPerson='$person', 
		supplier_ContactNum='$number', supplier_Address='$address' 
		WHERE supplier_ID = '$ID' ");
		
		header( "Location: ./suppliers.php?");
        exit;
	}

?>