<html>
<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	    
	</head>

	<body>
		<?php

			if(isset($_POST['submit'])|| isset($_POST['Submit']))
			{	
				$db = mysqli_connect("localhost","root","","Hardware");

				if(!$db)
				{
				    die("Connection failed: " . mysqli_connect_error());
				}
			

			    $supplier_ID= $_POST['supplier_ID'];
			    $item_ID= $_POST['item_ID'];
			    $transactionItems_Quantity= $_POST['transactionItems_Quantity'];
			    $supplierItem_CostPrice= $_POST['transactionItems_CostPrice'];
			    $transactionItems_CostPrice= $_POST['transactionItems_CostPrice'];
			    $transaction_Date= $_POST['transaction_Date'];
			    
			    $transaction_Status = $_POST['transaction_Status'];
			    
			     
			    $transactionItems_TotalPrice = $transactionItems_Quantity * $transactionItems_CostPrice;

			    $transaction_TotalPrice= $_POST['transaction_TotalPrice']+$transactionItems_TotalPrice;


			    $insert = mysqli_query($db,"INSERT INTO supplier_transactions". "(supplier_ID, transaction_Date, transaction_Status, transaction_TotalPrice) ". "
						  VALUES('$supplier_ID', '$transaction_Date', '$transaction_Status', '$transaction_TotalPrice')");
						
			    

			    if(!$insert)
			    {
			        echo mysqli_error($db);
			    }
			    else
			    {
			        echo "Supplier transaction records added successfully.";
			    }

			    $transaction_ID = $db->insert_id;

			    mysqli_close($db); 
			    
			    $db1 = mysqli_connect("localhost","root","","VSJM");

				if(!$db1)
				{
				    die("Connection failed: " . mysqli_connect_error());
				}
			  

			    $insert = mysqli_query($db1,"INSERT INTO transaction_items". "(transaction_ID, item_ID, transactionItems_Quantity, transactionItems_CostPrice, transactionItems_TotalPrice) ". "
						  VALUES('$transaction_ID', '$item_ID', '$transactionItems_Quantity', '$transactionItems_CostPrice', '$transactionItems_TotalPrice')");
						
			               
			    if(!$insert)
			    {
			        echo mysqli_error($db1);
			    }
			    else
			    {
			        echo " Transaction item records added successfully.";
			    }

			    mysqli_close($db1); 

			    $db2 = mysqli_connect("localhost","root","","VSJM");

				if(!$db2)
				{
				    die("Connection failed: " . mysqli_connect_error());
				}
			  

			    $nonempty=0;

				$sql = "SELECT * from supplier_item where supplier_ID =".$_POST['supplier_ID']." and item_ID =".$_POST['item_ID'];
					$result = $db2-> query($sql) or die($conn->error);
					if ($result-> num_rows >0) {
						$nonempty=1;
					}
				
				if($nonempty==0){
					$insert = mysqli_query($db2,"INSERT INTO supplier_item". "(supplier_ID, item_ID, supplierItem_CostPrice)"."VALUES('$supplier_ID', '$item_ID', '$supplierItem_CostPrice')");
					mysqli_query($db2, $insert);
				}
				if($nonempty==1){
					$update = mysqli_query($db2,"UPDATE supplier_item set supplierItem_CostPrice='".$supplierItem_CostPrice."' WHERE supplier_ID ='".$supplier_ID."' and item_ID ='".$item_ID."'");
					mysqli_query($db2, $update);
				}

			   
			}

			if($_POST["prevpage"] == "suppliertable"){
				header( "Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
				exit;
			}else {
				header( "Location: ./suppliers.php?");
				exit;
			}
			


		?>

	</body>

</html>