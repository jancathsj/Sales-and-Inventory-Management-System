<!DOCTYPE html>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	    
	</head>

	<body>
		<?php
		if(isset($_POST['submit']) || isset($_POST['Submit'])){	
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "VSJM";
			$conn = mysqli_connect($server, $user, $pass, $db);
			if(!$conn) die(mysqli_error($conn));

			$supplierItem_CostPrice = $_POST['supplierItem_CostPrice'];
			$nonempty=0;

			if($_POST['supplier_ID']=="other"){

		        $supplier_Name= $_POST['supplier_Name'];
		        $supplier_ContactPerson = $_POST['supplier_ContactPerson'];
		        $supplier_ContactNum= $_POST['supplier_ContactNum'];
		        $supplier_Address= $_POST['supplier_Address'];
		        $supplier_Status=1;

		        $insert = mysqli_query($conn,"INSERT INTO supplier ". "(supplier_Name, supplier_ContactPerson, supplier_ContactNum, supplier_Address, supplier_Status) ". "VALUES('$supplier_Name', '$supplier_ContactPerson', '$supplier_ContactNum', '$supplier_Address', '$supplier_Status')");

		        if(!$insert)
		        {
		            echo mysqli_error();
		        }

		        $supplier_ID = $conn->insert_id;

			}else{
			    $supplier_ID = $_POST['supplier_ID'];
			}

			if($_POST['item_ID']=="other"){

				$item_Name= $_POST['item_Name'];
			    $item_unit= $_POST['item_unit'];
			    $item_Brand= $_POST['item_Brand'];
			    $item_Category= $_POST['item_Category'];

			  
			    $insert = mysqli_query($conn,"INSERT INTO item ". "(item_Name, item_unit, item_Brand, item_Category) ". "
						  VALUES('$item_Name', '$item_unit', '$item_Brand', '$item_Category')");
						
			               
			    if(!$insert)
			    {
			        echo mysqli_error();
			    }

			    $item_ID = $conn->insert_id;
			}else{
				$item_ID = $_POST['item_ID'];

			}

			$sql = "SELECT * from supplier_item where supplier_ID =".$supplier_ID." and item_ID =".$item_ID;
				$result = $conn-> query($sql) or die($conn->error);
				if ($result-> num_rows >0) {
					$nonempty=1;
				}
			
			if($nonempty==0){
				$insert = mysqli_query($conn,"INSERT INTO supplier_item". "(supplier_ID, item_ID, supplierItem_CostPrice)"."VALUES('$supplier_ID', '$item_ID', '$supplierItem_CostPrice')");
				mysqli_query($conn, $insert);
			}
			if($nonempty==1){
				$update = mysqli_query($conn,"UPDATE supplier_item set supplierItem_CostPrice='".$supplierItem_CostPrice."' WHERE supplier_ID ='".$supplier_ID."' and item_ID ='".$item_ID."'");
				mysqli_query($conn, $update);
			}
			
			mysqli_close($conn);
		
			if($_POST["prevpage"] == "suppliertable"){
				header( "Location: ./suppliertable.php?supplier_ID=".$supplier_ID);
				exit;
			}else if($_POST["prevpage"] == "supplieritem"){
				header( "Location: ./supplieritem.php?");
				exit;
			}else {
				header( "Location: ../inventory/items.php?");
				exit;
			}
			
		}
		?>
		<div id ="transactionform">

			<h3>Fill the Form</h3>


			<form action = "./addsupplieritem.php" method="post" id="myForm">
				<p>
				

					Supplier:

						<?php
							$server = "localhost:3306";
							$user = "root";
							$pass = "";
							$db = "Hardware";
							$conn = mysqli_connect($server, $user, $pass, $db);
							if(!$conn) die(mysqli_error($conn));

							if(isset($_GET['supplier_ID'])){
								$supplier_ID=$_GET['supplier_ID'];
							}

							$query = "SELECT * from supplier";
								$result = mysqli_query($conn,$query);
								if(mysqli_num_rows($result) > 0){
									echo "<select id='supplier_ID' name='supplier_ID'>";
										while($row = mysqli_fetch_assoc($result)){
											echo "<option value='".$row['supplier_ID']."'";

											if(isset($_GET['supplier_ID'])){
												if($row['supplier_ID']==$supplier_ID){
													echo " selected";
												}
											}

											echo">".$row['supplier_ID']." - ".$row['supplier_Name']."</option>";										

										}
										echo "<option value='other'>Other</option>";
										echo "</select><br>";
								}
						?>
					</p>
					<div id="addsupplier">
				        <p>
				            Supplier Name:
				            <input type="text" name="supplier_Name" id="supplier_Name">
				        </p> 
				        <p>
				            Supplier Contact Person:
				            <input type="text" name="supplier_ContactPerson" id="supplier_ContactPerson">
				        </p>
				        <p>
				            Supplier Contact Number:
				            <input type="text" name="supplier_ContactNum" id="supplier_ContactNum">
				        </p>  
				        <p>
				            Supplier Address:
				            <input type="text" name="supplier_Address" id="supplier_Address">
				        </p>
				    </div>

				    
					<p>
						Item:
						<?php
							$query = "SELECT * from item";
								$result = mysqli_query($conn,$query);
								if(mysqli_num_rows($result) > 0){
									echo "<select id='item_ID' name='item_ID'>";
										while($row = mysqli_fetch_assoc($result)){
											echo "<option value='".$row['item_ID']."'>".$row['item_ID']." - ".$row['item_Name']."</option>";
										}
										echo "<option value='other'>Other</option>";
										echo "</select><br>";
									}
							mysqli_close($conn);
						?>
					</p>

					<div id="additem">
						<p>
					        Item Name:
					        <input type="text" name="item_Name" id="item_Name">
					    </p> 
					    <p>
					        Item Unit:
					        <input type="text" name="item_unit" id="item_unit">
					    </p>
					    <p>
					        Item Brand:
					        <input type="text" name="item_Brand" id="item_Brand">
					    </p>
					    <label for="item_Category" >Category: </label>
		                <div>
		                    <select name="item_Category" id="item_Category" style="height:30px;" >
		                      <option value="Electrical" >Electrical</option>
		                      <option value="Plumbing">Plumbing</option>
		                      <option value="Architectural"> Architectural</option>
		                      <option value="Paints">Paints</option>
		                      <option value="bolts and nuts">Bolts and Nuts</option>
		                      <option value="Tools">Tools</option>
		                    </select>        
		                </div> 

					</div>

					<p>Item Cost Price: Php <input type="text" name="supplierItem_CostPrice"></p>

					<input type="submit" name="submit" value="Confirm" id="submitform">
			</form>
			<?php
				if(isset($_GET['supplier_ID'])){
					echo"<br><button onclick=\"location.href='suppliertable.php?supplier_ID=".$supplier_ID."'\">Back</button>";
					$_SESSION["prevpage"]="suppliertable";
				}
				else{
					echo "<br><button onclick=\"location.href='supplieritem.php'\">Back</button>";
					$_SESSION["prevpage"]="supplieritem";
				}
			?>
		</div>

	</body>
	<script type="text/javascript"> 
	        $(document).ready(function () {
	            toggleFields(); 
	            $("#supplier_ID").change(function () {
	                toggleFields();
	            });

	            $("#item_ID").change(function () {
	                toggleFields();
	            });
				
	        });
	        
	        function toggleFields() {
	            if ($("#supplier_ID").val() === "other"){
	            	$("#addsupplier").show();
	            }
	        	else{
	            	$("#addsupplier").hide();
	        	}

	        	if ($("#item_ID").val() === "other"){
	            	$("#additem").show();
	            }
	        	else{
	            	$("#additem").hide();
	        	}
	        }
	</script>
</html>