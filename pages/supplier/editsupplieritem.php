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
			$item_Name =$_POST['editName'];
			$item_Unit =$_POST['editUnit'];
			$item_Brand =$_POST['editBrand'];
            $supplierItem_CostPrice =$_POST['editcostprice'];
			$item_Category = $_POST['item_Category'];


		mysqli_query($conn, "UPDATE item set item_ID=' " .$itemID. " ', item_unit=' " .$item_Unit. " ', item_Name=' " . $item_Name . " ', item_Brand=' " . $item_Brand . " ', item_Category=' " . $item_Category . " '
				WHERE item_ID = ' " . $itemID . " ' ") or die( mysqli_error($conn));

		mysqli_query($conn,"UPDATE supplier_item set supplierItem_CostPrice='".$supplierItem_CostPrice."' WHERE supplier_ID ='".$supplierID."' and item_ID ='".$itemID."'") or die( mysqli_error($conn));
		
		
		unset($_POST['edit']);
		header("Location: supplieritem.php");
	}
   
?>