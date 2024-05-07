<?php
	error_reporting(0);
	include_once '../../env/conn.php';
	$itemID = $_SESSION['itemID'];
	$supplierID = $_SESSION['supplierID'];
	echo $_POST['edititemID'];
	echo $_POST['editsupplierID'];
	if (isset($_POST['edit'])) { //UPDATING INVENTORY
			echo $_POST['edititemID'];
			echo $_POST['editsupplierID'];

			$itemID = $_POST['edititemID'];
			$item_Name =trim($_POST['editName']);
			$item_Unit =trim($_POST['editUnit']);
			$item_Brand =trim($_POST['editBrand']);
			$item_Category = trim($_POST['item_Category']);
			$supplierID = $_POST['editsupplierID'];
			$supplier_Name =trim($_POST['editsupplier']);
			$supplier_Status =$_POST['editstatus'];
			$supplierItem_CostPrice =$_POST['editcostprice'];



		mysqli_query($conn, "UPDATE item set item_ID=' " .$itemID. " ', item_unit=' " .$item_Unit. " ', item_Name=' " . $item_Name . " ', item_Brand=' " . $item_Brand . " ', item_Category=' " . $item_Category . " '
				WHERE item_ID = ' " . $itemID . " ' ") or die( mysqli_error($conn));

		mysqli_query($conn, "UPDATE supplier set supplier_ID=' " . $supplierID . " ', supplier_Name=' " . $supplier_Name . " ', supplier_Status=' " . $supplier_Status . " '
			WHERE supplier_ID = ' " . $supplierID . " ' ") or die( mysqli_error($conn));

		mysqli_query($conn,"UPDATE supplier_item set supplierItem_CostPrice='".$supplierItem_CostPrice."' WHERE supplier_ID ='".$supplierID."' and item_ID ='".$itemID."'") or die( mysqli_error($conn));
		
		

		

		unset($_POST['edit']);
		header("Location: supplieritem.php");
	}

?>
