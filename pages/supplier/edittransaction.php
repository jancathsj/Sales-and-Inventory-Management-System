
		<?php
			include_once '../../env/conn.php';
		

			if(isset($_POST['edit'])>0){

				$item_ID = $_POST['editItemID'];
				$supplier_ID = $_POST['editSupplierID'];
				$transaction_ID = $_POST['editTransactionID'];
				$transactionItems_Quantity = $_POST['editQuantity'];
				$transactionItems_CostPrice = $_POST['editItemCost'];
				$transaction_Date = $_POST['editDate'];
				$transaction_Status = $_POST['editStatus'];
				$transaction_TotalPrice = $_POST['editTotalPrice'];
				
			
				mysqli_query($conn, "UPDATE supplier_transactions set transaction_ID='$transaction_ID', supplier_ID='$supplier_ID', transaction_Date='$transaction_Date', transaction_Status='$transaction_Status', transaction_TotalPrice='$transaction_TotalPrice' WHERE transaction_ID = '$transaction_ID' ");
				
				mysqli_query($conn, "UPDATE transaction_items set transaction_ID='$transaction_ID', item_ID='$item_ID',transactionItems_Quantity='$transactionItems_Quantity',transactionItems_CostPrice='$transactionItems_CostPrice' WHERE transaction_ID ='$transaction_ID'");

				$nonempty=0;

				$sql = "SELECT * from supplier_item where supplier_ID ='$supplier_ID' and item_ID ='$item_ID'";
					$result = $conn-> query($sql) or die($conn->error);
					if ($result-> num_rows >0) {
						$nonempty=1;
					}
				
				if($nonempty==0){
					$insert = mysqli_query($conn,"INSERT INTO supplier_item". "(supplier_ID, item_ID, supplierItem_CostPrice)"."VALUES('$supplier_ID', '$item_ID', '$supplierItem_CostPrice')");
					mysqli_query($conn, $insert);
				}
				if($nonempty==1){
					$update = mysqli_query($conn,"UPDATE supplier_item set supplierItem_CostPrice='$supplierItem_CostPrice' WHERE supplier_ID ='$supplier_ID' and item_ID ='$item_ID'");
					mysqli_query($conn, $update);
				}

				unset($_SESSION['transaction_ID']);
				mysqli_close($conn);

				header("Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
				exit();
			}


		?>
	