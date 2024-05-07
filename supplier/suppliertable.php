<html>
	<head>
		<?php
			include_once '../../env/conn.php';
			require_once '../../env/auth_check.php';

			if(isset($_POST['order'])){
				$_SESSION['orderItemID'] = $_POST['orderItemID'];
				$_SESSION['orderItemSupp'] = $_POST['orderItemSupp'];
					header("Location: ../inventory/addinventory.php");
				unset($_POST['edit']);
				}

		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css?ts=<?=time()?>">
	  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	  <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
		<script src="myjs.js" type="text/javascript"></script>
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
		
		<!-- CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<!-- JQUERY/BOOTSTRAP -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 


		<style>
			@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
			@import url("https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
			*, *:before, *:after {
			  margin: 0;
			  padding: 0;
			  box-sizing: border-box;
			}
			th, td {
				vertical-align:middle;
			}

			a {
			  color: black;
			  border: none;
			  text-decoration: none;
			}

			a.hover:hover
			{
			  color: black;
			  border: none;
			  text-decoration: none;
			}

			#tabs-w-content{
				padding:  2px;
			}

			#supplier-name {
			  padding: 3px 0;
			  
			  text-align: left;
			}

			p {
			  margin: 0 0 20px;
			  line-height: 1.5;
			}

			.table thead {
			    position: sticky;
			}

			.colhead {
				border-right: 1px solid #28a745;
				width:  12%;
			}

			#activestat{
				color: #6fed6f;
			}

			#inactivestat{
				color:  #caccca;
			}

			#content1, #content2, #content3 {
			  display: none;
			  padding: 10px 0 0;
			  border-top: 1px solid #ddd;
			}

			input {
			  display: none;
			}

			#tab01 {
			  display: inline-block;
			  margin: 0 0 -1px;
			  padding: 15px 25px;
			  font-weight: 700;
			  font-size: 16;
			  text-align: center;
			  color: black;
			  border: 1px solid transparent;
			  background-color: #5cb85c;
			  border-radius: 12px 12px 0 0;

			}

			#tab01:before {
			  font-family: fontawesome;
			  font-weight: normal;
			  margin-right: 10px;



			}

			label[for*='1']:before {
			  content: '\f05a';
			}

			label[for*='2']:before {
			  content: '\f0c9';
			}

			label[for*='3']:before {
			  content: '\f09d';
			}

			#tab01:hover {
			  cursor: pointer;
			  background-color: #72d474;
			}

			input:checked + #tab01 {
			  color: black;
			  border: 1px solid #ddd;
			  border-bottom: 1px solid #fff;
			  background-color: #f0ad4e;
			}

			#tab1:checked ~ #content1,
			#tab2:checked ~ #content2,
			#tab3:checked ~ #content3 {
			  display: block;
			}

			@media screen and (max-width: 650px) {
			  label {
			    font-size: 0;
			  }

			  label:before {
			    margin: 0;
			    font-size: 18px;

			  }
			}
			@media screen and (max-width: 400px) {
			  label {
			    padding: 15px;
			  }
			}
		</style>



	</head>

	<body>
		
	<main >
   
    <div class="nav"> 
    <?php include 'navbar.php'; ?>
    </div> 

        
    <div class="container-fluid bg-light p-4">
    	<br>
    	<div style="position: relative; text-align: center;">
	    	<div style="position: absolute;"><span><button class="btn btn-dark mt-3" type="button" onclick="location.href='suppliers.php'"><i class="fa fa-chevron-left"></i> Go Back</button></span></div>
	    	<div class="text-center fs-1 fw-bold" style="display: inline-block;"> SUPPLIERS </div>
    	<br>
    	</div>
    	<br><br>
		<div class="supplier_choice">

			<?php

				$supplier_chosen = $_GET['supplier_ID'];
			
				$sql = "SELECT * from supplier where supplier_ID =".$supplier_chosen;
				$result = $conn-> query($sql) or die($conn->error);
				if ($result-> num_rows >0) {
						while ($row = $result-> fetch_assoc()) {
							echo "<div id=\"supplier-name\" class=\"fs-3 fw-bold rounded-top bg-dark text-info px-4\">".$row["supplier_Name"];
							if($row["supplier_Status"] == 0){
								echo "<div id=\"inactivestat\" class=\"fs-4 fw-light\" style=\" float: right;\"><i class=\"fa fa-circle-o\"></i> Inactive  </div>";
							}else{
								echo "<div id=\"activestat\" class=\"fs-4 fw-light\" style=\" float: right;\"><i class=\"fa fa-circle-o\"></i> Active  </div>";
							}
							
							echo "</div><div id=\"container\" class=\"bg-white rounded-bottom border shadow-sm overflow-auto p-4\">";
						}
				}
				
			?>

	   <!-- EDIT ITEM MODAL ############################################################################ -->
		<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- MODAL-HEADER -->
            
            <form id="newform" action="editsupplieritem.php" method="post" class="form-inline" > 
              <div class="modal-body mb-2">   

                <!--<input type="hidden"  id="edititemID" name="edititemID" placeholder="Enter"> -->
                <div style="display:flex; flex-direction: row; align-items: center;">
                  <label for="edititemID" style="border:0; background-color: transparent; font-size: 1.35em; color:black; font-weight: 500;">Item ID: </label>
                  <span><input type="text" class="form-control" id="edititemID" name="edititemID" style="font-size: 1.35em; color:black; font-weight: 500;" readonly></span>
                </div>
               
                <div class="mb-1 mt-1"> 
                  <label for="editName" >Item Name: </label>
                  <div>
                    <input type="text" class="form-control"  id="editName" name="editName" placeholder="Enter">
                  </div>
                  <label for="editBrand" >Unit: </label>
                  <div>
                    <input type="text" class="form-control"  id="editUnit" name="editUnit" placeholder="Enter">
                  </div> 
                  <label for="editBrand" >Brand: </label>
                  <div>
                    <input type="text" class="form-control"  id="editBrand" name="editBrand" placeholder="Enter">
                  </div>
				  <label for="editcostprice">Cost Price: </label>
                  <div>
                    <input type="number" step="any" class="form-control"  id="editcostprice" name="editcostprice" placeholder="Enter">
                  </div> 
				  <label for="item_Category" >Category: </label>
                        <div>
                            <select name="item_Category" type="text" id="item_Category" style="height:30px;" >
                            <option value="Electrical" >Electrical</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Architectural"> Architectural</option>
                            <option value="Paints">Paints</option>
                            <option value="bolts and nuts">Bolts and Nuts</option>
                            <option value="Tools">Tools</option>
                            <option value="Wood">Wood</option>
                            </select>        
                        </div> 
                </div> <!-- MB-1 MT-1 -->
              </div> <!-- MODAL-BODY -->
              <div class="modal-footer pb-0">
                  <input  type="submit" value="Update" name="edit" class="form-control btn btn-primary" style="width:150px" > 
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div> <!-- MODAL FOOTER -->
            </form>  
          </div> <!-- MODAL-CONTENT -->
        </div> <!-- MODAL-DIALOG -->
      </div> <!-- MODAL-FADE-->
      <!-- EDIT ITEM MODAL ############################################################################ -->

	  <!-- EDIT TRANSACTION MODAL ############################################################################ -->
			<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- MODAL-HEADER -->

                <form id="newform" action="edittransaction.php" method="post" class="form-inline" > 
                <div class="modal-body mb-2"> 
				<input type="text"  id="editTransactionID" name="editTransactionID" placeholder="Enter"> 
                <label for="editTransactionID" id="labelTransactionID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;">Transaction ID: </label>  
                <input type="hidden"  id="editSupplierID" name="editSupplierID" placeholder="Enter"> 
                <label for="editSupplierID" id="labelSupplierID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;">Supplier ID: </label>
				<input type="hidden"  id="editItemID" name="editItemID" placeholder="Enter"> 
                <label for="editItemID" id="labelItemID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;">Item ID: </label>	
					
					<div class="mb-1 mt-1"> 
                    <label for="editQuantity" >Item Quantity: </label>
                    <div>
                        <input type="number" class="form-control"  id="editQuantity" name="editQuantity" placeholder="Enter">
                    </div> 
                    <label for="editItemCost" >Item Cost Price: </label>
                    <div>
                        <input type="number" step="0.01" class="form-control"  id="editItemCost" name="editItemCost" placeholder="Enter">
                    </div> 
                    <label for="editDate" >Transaction Date: </label>
                    <div>
                        <input type="datetime-local" class="form-control"  id="editDate" name="editDate" placeholder="Enter">
                    </div> 
					<label for="editStatus" >Transaction Status: </label>
                    <div>
                        <select  id="editStatus" name="editStatus" >
						<?php
								echo"<p>
								<option value=\"1\""; 
								if(['$editStatus']=="1"){
									echo " selected";
								}
							    echo ">Successful</option>
								<option value=\"0\"";
								if(['$editStatus']=="0"){
									echo " selected";
								}
							   echo ">Failed</option>
							   </select></p>";
						?>
                    </div> 
					<label for="editTotalPrice" >Transaction Total Price: </label>
					<div>
                        <input type="number" step="0.01" class="form-control"  id="editTotalPrice" name="editTotalPrice" placeholder="Enter">
                    </div>
                    </div> <!-- MB-1 MT-1 -->
                </div> <!-- MODAL-BODY -->
                <div class="modal-footer pb-0">
                    <input type="hidden" name="url" value="inventory.php">
                    <input  type="submit" value="Update" name="edit" class="form-control btn btn-primary" style="width:150px" > 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> <!-- MODAL FOOTER -->
                </form>  
            </div> <!-- MODAL-CONTENT -->
            </div> <!-- MODAL-DIALOG -->
        </div> <!-- MODAL-FADE-->
        <!-- EDIT TRANSACTION MODAL ############################################################################ -->

			<!-- BUY MODAL ############################################################################ -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Buy Item</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <!-- MODAL-HEADER -->
					
					<form id="newform" action="../inventory/addinventory.php" method="post" class="form-inline" > 
					<div class="modal-body mb-2">   
						
						<input type="hidden"  id="editID" name="editID" placeholder="Enter"> 
						<input type="hidden" name=orderItemSupp value=<?php echo $supplier_chosen?>>
						<label for="editID" id="labelID" style="border:0; background-color: transparent; font-size: 1em; color:black; font-weight: 400;padding:0px;">Item ID: </label> </br>

						<label for="editName" id="labelName" style="border:0; background-color: transparent; font-size: 1.5em; color:black; font-weight: 500;"></label>
						<div>
							<label  id="labelBrand" style="border:0; background-color: transparent; font-size: 1em; color:black; font-weight: 500;"></label>
						</div>
						<div class="mb-1 mt-1">
						 
						
						<div>
							<label id="labelCost" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500; padding-bottom:5px; color:#D8172B;"></label>
							<input type="hidden"  id="editCost" name="editCost" placeholder="Enter">
						</div> 
						
						<label for="editRetail" >Retail Price: </label>
						<div>
							<input type="number" step="0.25" class="form-control"  id="editRetail" name="editRetail" placeholder="Enter">
							<input type="hidden" step="0.25" class="form-control"  id="hiddenRetail" name="hiddenRetail" placeholder="Enter">
						</div> 
						
						<label for="editMarkup" >Markup: </label>
						<div>
							<input type="number" step="0.01" class="form-control"  id="editMarkup" name="editMarkup" placeholder="Enter">
							<input type="hidden" step="0.01" class="form-control"  id="hiddenmarkup" name="hiddenmarkup" placeholder="Enter">
						</div> 
						<label for="editStock" >Quantity: </label>
						<div>
							<input type="number" step="any" class="form-control"  id="editStock" name="editStock" placeholder="Enter">
						</div> 
						<label for="item_Category" >Category: </label>
						<div>
							<select name="item_Category" id="item_Category" style="height:30px;" >
							<option value="Electrical" >Electrical</option>
							<option value="Plumbing">Plumbing</option>
							<option value="Architectural"> Architectural</option>
							<option value="Paints">Paints</option>
							<option value="bolts and nuts">Bolts and Nuts</option>
							<option value="Tools">Tools</option>
							<option value="Wood">Wood</option>
							</select>        
						</div> 
						</div> <!-- MB-1 MT-1 -->
					</div> <!-- MODAL-BODY -->
					<div class="modal-footer pb-0">
						<input type="hidden" name="url" value="inventory.php">
						<input  type="submit" value="Buy" name="buy" class="form-control btn btn-primary" style="width:150px" >  <!-- INSERT ALERT -->
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div> <!-- MODAL FOOTER -->
					</form>  
				</div> <!-- MODAL-CONTENT -->
				</div> <!-- MODAL-DIALOG -->
			</div> <!-- MODAL-FADE-->
			<!-- BUY MODAL ############################################################################ -->


			<!-- ADD ITEM MODAL ############################################################################ -->

			<div class="modal fade" id="staticBackdropadd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Add Item to Supplier</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <!-- MODAL-HEADER -->
					<div class="modal-body mb-2">
						<div id ="transactionform">

							<form action = "addsupplieritem.php" method="post" id="myForm">
								<div class="mb-1 mt-1">
								<p>
								

									Supplier:

										<?php
											

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
								            <input type="text" name="supplier_Name" class="form-control" id="supplier_Name" placeholder="Enter">
								        </p> 
								        <p>
								            Supplier Contact Person:
								            <input type="text" name="supplier_ContactPerson" class="form-control"id="supplier_ContactPerson" placeholder="Enter">
								        </p>
								        <p>
								            Supplier Contact Number:
								            <input type="text" name="supplier_ContactNum" class="form-control"id="supplier_ContactNum" placeholder="Enter">
								        </p>  
								        <p>
								            Supplier Address:
								            <input type="text" name="supplier_Address" class="form-control" id="supplier_Address" placeholder="Enter">
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
											
										?>
									</p>

									<div id="additem">
										<p>
									        Item Name:
									        <input type="text" name="item_Name" id="item_Name" class="form-control" placeholder="Enter">
									    </p> 
									    <p>
									        Item Unit:
									        <input type="text" name="item_unit" id="item_unit" class="form-control" placeholder="Enter">
									    </p>
									    <p>
									        Item Brand:
									        <input type="text" name="item_Brand" id="item_Brand" class="form-control" placeholder="Enter">
									    </p>
									    
									    Category:
						    			<div>
						                    <select name="item_Category" id="item_Category" style="height:30px;" >
						                      <option value="Electrical" >Electrical</option>
						                      <option value="Plumbing">Plumbing</option>
						                      <option value="Architectural"> Architectural</option>
						                      <option value="Paints">Paints</option>
						                      <option value="bolts and nuts">Bolts and Nuts</option>
						                      <option value="Tools">Tools</option>
						                    </select>        
						                </div><br>

									</div>

									<p>Item Cost Price:<input type="number" step="0.01" name="supplierItem_CostPrice" class="form-control" placeholder="Enter"></p>

									
								</div>
								<div class="modal-footer pb-0">
									<input type="hidden" id="prevpage" name="prevpage" value="suppliertable">
									<input  type="submit" value="Submit" name="Submit" class="form-control btn btn-primary" style="width:150px" >  <!-- INSERT ALERT -->
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div> <!-- MODAL FOOTER -->
							</form>
						</div>
					
					

					</div>
					</form>
				</div>
				</div>
			</div>
			<!-- ADD ITEM MODAL ############################################################################ -->

			<!-- ADD TRANSACTION MODAL ############################################################################ -->

			<div class="modal fade" id="staticBackdropaddtrans" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Add Transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <!-- MODAL-HEADER -->
					<div class="modal-body mb-2">
						<div id ="transactionform">

							<form action = "./addtransaction.php" method="post" id="myForm">
								<div class="mb-1 mt-1">
								
									<?php
										include_once '../../env/conn.php';
								
										/*if(isset($_GET['supplier_chosen'])){
											$supplier_ID = $_GET['supplier_chosen'];					
										}else if(isset($_POST['supplier_ID'])){
											$supplier_ID = $_POST['supplier_ID'];
										}else{
											$supplier_ID = 1;
										}
										*/

									?>	
										<p>
											Supplier:
											<?php
												$query = "SELECT * from supplier where supplier_ID = ".$supplier_chosen;
													$result = mysqli_query($conn,$query);
													/*if(mysqli_num_rows($result) > 0){
														echo "<select name='supplier_ID' name='supplier_ID'>";
															while($row = mysqli_fetch_assoc($result)){
																echo "<option value='".$row['supplier_ID']."'";

																if($row['supplier_ID']==$supplier_ID){
																	echo " selected";
																}

																echo">".$row['supplier_Name']."</option>";										

															}
															echo "</select><br>";
													}
													*/
													if(mysqli_num_rows($result) > 0){
														while($row = mysqli_fetch_assoc($result)){
															echo $row['supplier_Name'];

														}
													}
													
											?>
											<input type="hidden" name="supplier_ID" class="form-control" value="<?php echo $supplier_chosen?>"></p>
										</p>

										

										<p>
											Item:
											<?php
											$query = "SELECT * from item inner join supplier_item on supplier_item.item_ID = item.item_ID where supplier_item.supplier_ID = ".$supplier_chosen;
												$result = mysqli_query($conn,$query);
												if(mysqli_num_rows($result) > 0){
													echo "<select id='item_ID' name='item_ID'>";
														while($row = mysqli_fetch_assoc($result)){
															echo "<option value='".$row['item_ID']."'>".$row['item_ID']." - ".$row['item_Name']."</option>";
														}
														echo "</select><br>";
													}
											date_default_timezone_set('Asia/Taipei');
											?>
										</p>
										<p>Item Quantity: <input type="number" name="transactionItems_Quantity" class="form-control" placeholder="Enter"></p>

										<p>Item Cost Price: <input type="number" step="0.01" name="transactionItems_CostPrice" class="form-control" placeholder="Enter"></p>
										<p>Transaction Date: <input type="datetime-local" name="transaction_Date" class="form-control" value="<?php date('yyyy-MM-ddThh:mm'); ?>" /></p>
										<p>Transaction Status: <select name="transaction_Status" id="transaction_Status">
										<option value="1">Successful</option>
										<option value="0">Failed</option>
										</select><p>
										<p>Additional Fees (optional):<input type="number" step="0.01" name="transaction_TotalPrice" class="form-control" placeholder="Enter"><p>
									
								</div>
								<div class="modal-footer pb-0">
									<input type="hidden" id="prevpage" name="prevpage" value="suppliertable">
									<input  type="submit" value="Submit" name="Submit" class="form-control btn btn-primary" style="width:150px" >  <!-- INSERT ALERT -->
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div> <!-- MODAL FOOTER -->
							</form>
						</div>
					
					

					</div>
					</form>
				</div>
				</div>
			</div>
			<!-- ADD TRANSACTION MODAL ############################################################################ -->


			<!--#################  LIST OF ITEMS #################-->

				<div id="tabs-w-content">
					  <input id="tab1" type="radio" name="tabs" checked>
					  <label for="tab1" id="tab01">Information</label>
					    
					  <input id="tab2" type="radio" name="tabs">
					  <label for="tab2" id="tab01">Items</label>
					    
					  <input id="tab3" type="radio" name="tabs">
					  <label for="tab3" id="tab01">Transactions</label>
					    
					  <section id="content1">
					  	
					     <?php					

							$sql = "SELECT * from supplier where supplier_ID=".$supplier_chosen;
							$result = $conn-> query($sql) or die($conn->error);
							if ($result-> num_rows >0) {
								while ($row = $result-> fetch_assoc()) {
									echo "<table class=\"table table-borderless\"><tr><th class='colhead'><span class='thick'><i class=\"fa fa-folder\"></i>  ID  </span></th><td>".$row["supplier_ID"]."</td></tr>";
									echo "<tr><th class='colhead'><span class='thick'><i class=\"fa fa-circle-o\"></i>  Status  </span></th><td>";
									if($row["supplier_Status"] == 0){
										echo "Inactive";
									} else{
										echo "Active";
									}
									echo "</td></tr>";
									echo "<tr><th class='colhead'><span class='thick'><i class=\"fa fa-user\"></i>  Supplier Agent  </span></th><td>".$row["supplier_ContactPerson"]."</td></tr>";
									echo "<tr><th class='colhead'><span class='thick'><i class=\"fa fa-phone\"></i>  Contact Number  </span></th><td>".$row["supplier_ContactNum"]."</td></tr>";
									echo "<tr><th class='colhead'><span class='thick'><i class=\"fa fa-map-marker\"></i>  Supplier Address  </span></th><td>".$row["supplier_Address"]."</td></tr></table>";
								}
							}
							echo "<button class=\"btn btn-success mt-3\" onclick=\"changeLoc('delete','".$supplier_chosen."')\"><i class=\"fa fa-circle-o\"></i> Change Status
							</button>";
						?>
						
					  </section>

					  <section id="content2">
					   	<div class='table-wrapper' style="overflow-y:scroll; height: 350px">
					   	<table class='table table-hover'> 
           				<thead><tr>
							<th>Item ID</th>
							<th>Name</th>
							<th>Unit</th>
							<th>Brand</th>
							<th>Category</th>
							<th>Cost Price</th>
							<th></th>
							<th></th>
							<th></th>
						</tr></thead>
							<tbody>
							<?php
								
								$sql = "SELECT * from item inner join supplier_item on item.item_ID=supplier_item.item_ID inner join supplier on supplier.supplier_ID=supplier_item.supplier_ID where supplier_item.supplier_ID = ".$supplier_chosen."";
								
								$result = $conn-> query($sql) or die($conn->error);

								if ($result-> num_rows >0) {
									while ($row = $result-> fetch_assoc()) {
										echo "<tr>
												<td>". $row["item_ID"]."</td>
												<td>". $row["item_Name"]."</td>
												<td>". $row["item_unit"]."</td>
												<td>". $row["item_Brand"]."</td>
												<td>". $row["item_Category"]."</td>
												<td>". $row["supplierItem_CostPrice"]."</td>
												<td><button class=\"btn editbtn1 p-0\" style=\"float:left;\"><i class='fas fa-edit'></i></button></td>
												<td><a style=\"color:black;\" onclick='return checkdelete()' href='deletesupplieritem.php?item_ID=".$row['item_ID']."&supplier_ID=".$supplier_chosen."'\"><button style=\"border: none; \"><i class='fas fa-trash'></i></a></button></td>";
										//echo "<td><a onclick='return checkdelete()' href='deleteitemtransactions.php?item_ID=".$row['item_ID']."&supplier_ID=".$supplier_chosen."'\"><button>Delete Item & Transactions</a></button></td>";
												
												?>
												<td>
													<form action="suppliertable.php" class="mb-1" method="post">
													<input type=hidden name=orderItemID value=<?php echo $row['item_ID']?>>
													<input type=hidden name=orderItemSupp value=<?php echo $supplier_chosen?>>
													<!--<a href="../inventory/addinventory.php"> <button class="btn-primary" name="order" type="submit">Order</button></a>
													<button type="button" class="btn btn-success editbtn p-2" style="float:left;"><i class="fa fa-shopping-cart"></i> Buy</i></button>-->
													<?php
														if($row['supplier_Status']==1){
	                                echo "<button type=\"button\" class=\"btn btn-success editbtn p-2\" style=\"float:left;\"><i class=\"fa fa-shopping-cart\"></i> Buy</i></button>";
	                            }else{
	                                echo "<button type=\"button\" class=\"btn btn-secondary p-2\" style=\"float:left;\"><i class=\"fa fa-shopping-cart\"></i> Buy</i></button>";
	                            }
                           ?>
													</form>
												</td>
										<?php
										echo"</tr>";

									}
								
								}
								else {
										
										echo "<tr><td colspan=\"7\">There are 0 results.</td></tr>";
									
								}								

							?>
						</tbody></table></div>
						<?php
							//echo "<tr><td colspan=\"11\"><button class=\"btn btn-success additembtn mt-3\" onclick=\"location.href='addsupplieritem.php?supplier_ID=".$supplier_chosen."'\">Add Item to Supplier</button></td></tr>";
							echo "<tr><td colspan=\"11\"><button class=\"btn btn-success additembtn mt-3\">Add Item to Supplier</button></td></tr>";
						?>
						<br>
							<div class="row-6 align-self-center" style="float:right;" >
	                  <form action="exportpurchases.php" method="post">
	                    <div class="align-bottom" style=" display: inline-block;">
	                      <label for="exportMonth" class="col-auto col-form-label fw-bold">Month & Year:</label>
	                    </div>
	                    <div class="align-bottom" style=" display: inline-block;">
	                      <input type="month" class="form-control" id="exportMonth" name="exportMonth">
	                    </div>
	                    <div class="align-bottom" style=" display: inline-block;">
	                    	<input type=hidden name=ExportTransactionSupp value=<?php echo $supplier_chosen?>>
	                      <button class="btn btn-success purchasesbtn " name="exportsupp" type="submit" style="float:right;"><i class='fas fa-download'></i>  Monthly Purchases</button>
	                    </div>
	                  </form>
	            </div>

					  </section>
					    
					  <section id="content3">
					  	<div class='table-wrapper' style="overflow-y:scroll; height: 350px">
					   	<table id="transaction_table" class='table table-hover'> 
           				<thead><tr>
							<th>Transaction ID</th>
							<th>Supplier ID</th>
							<th>Item ID</th>
							<th>Item Name</th>
							<th>Transaction Date</th>
							<th>Transaction Status</th>
							<th>Item Quantity</th>
							<th>Item Cost Price</th>
							<th>Item Total</th>
							<th>Transaction Total</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
							<tbody>
							<?php
								

								$sql = "SELECT * from transaction_items INNER JOIN supplier_transactions on supplier_transactions.transaction_ID = transaction_items.transaction_ID INNER JOIN item on transaction_items.item_ID = item.item_ID where supplier_ID = ".$supplier_chosen;
								$result = $conn-> query($sql) or die($conn->error);

								if ($result-> num_rows >0) {
									while ($row = $result-> fetch_assoc()) {
										echo "<tr>
												<td>". $row["transaction_ID"]."</td>
												<td>". $row["supplier_ID"]."</td>
												<td>". $row["item_ID"]."</td>
												<td>". $row["item_Name"]."</td>
												<td>". $row["transaction_Date"]."</td>
												<td>". $row["transaction_Status"]."</td>
												<td>". $row["transactionItems_Quantity"]."</td>
												<td>". $row["transactionItems_CostPrice"]."</td>
												<td>". $row["transactionItems_TotalPrice"]."</td>
												<td>". $row["transaction_TotalPrice"]."</td>
												<td><button class=\"btn editbtn2 p-0\" style=\"float:left;\" ><i class='fas fa-edit'></i></button></td>
												<td><button style=\"border: none;\"> <a style=\"color:black;\" onclick='return checkdelete()' href='deletetransaction.php?transaction_ID=".$row['transaction_ID']."'><i class='fas fa-trash'></i></button></a></td>
						
										</tr>";

									}
								
								}
								else {								
										echo "<tr><td colspan=\"11\">There are 0 results.</td></tr>";
									
								}	
							?>
						</tbody></table></div>
						<?php
							echo "<tr><td colspan=\"11\"><button class=\"btn btn-success addtransbtn mt-3\">Add Transaction</button></td></tr>";
						?><br>
							<div class="row-6 align-self-center" style="float:right;" >
	                  <form action="exportpurchases.php" method="post">
	                    <div class="align-bottom" style=" display: inline-block;">
	                      <label for="exportMonth" class="col-auto col-form-label fw-bold">Month & Year:</label>
	                    </div>
	                    <div class="align-bottom" style=" display: inline-block;">
	                      <input type="month" class="form-control" id="exportMonth" name="exportMonth">
	                    </div>
	                    <div class="align-bottom" style=" display: inline-block;">
	                    	<input type=hidden name=ExportTransactionSupp value=<?php echo $supplier_chosen?>>
	                      <button class="btn btn-success purchasesbtn " name="exportsupp" type="submit" style="float:right;"><i class='fas fa-download'></i>  Monthly Purchases</button>
	                    </div>
	                  </form>
	            </div>
					  </section>
					    

				</div>

			</div>
			
	</div>
	</main>



			<?php
				$conn -> close();

			?>


		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script>

			$('#editRetail').change(function() {
				var costPrice = $('#editCost').val();
				var retail = $('#editRetail').val();
				
				$('#editMarkup').val(Number(parseFloat(retail /costPrice).toFixed(2)));
				
			});
			$('#editMarkup').change(function() {
				var costPrice = $('#editCost').val();
				var retail = (costPrice*$('#editMarkup').val()).toFixed(1);
				retail = Math.ceil(retail*4)/4;
				$('#editRetail').val( retail);
			});

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

	        function changeLoc(loc, id) {
				if (loc == 'delete') {

					location.href=loc+"supplier.php?supplier_ID="+id+"&prevpage='suppliertable'";
				}
			}

	
        $(document).ready(function(){
            $('.editbtn').on('click',function(){
                $('#staticBackdrop').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				var retail = data[5]*1.2;
                $('#editID').val(data[0]);
                $('#editRetail').val(Math.ceil(retail*4)/4);               
                $('#editMarkup').val(1.2);
                //$('#editStock').val(data[6]);
                $('#editCategory').val(data[4]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[4];
				$('#editCost').val(data[5]);
                
                document.getElementById("labelID").innerHTML = "Item ID: " + data[0];
				document.getElementById("labelName").innerHTML = data[1];
				document.getElementById("labelBrand").innerHTML = data[3];
				document.getElementById("labelCost").innerHTML = data[5] + "/"+ data[2];
            });
        });

        $(document).ready(function(){
            $('.additembtn').on('click',function(){
                $('#staticBackdropadd').modal('show');
            });
        });

		 $(document).ready(function(){
            $('.addtransbtn').on('click',function(){
                $('#staticBackdropaddtrans').modal('show');
            });
        });

		//Edit Item Modal

		$(document).ready(function(){
              $('.editbtn1').on('click',function(){
                $('#staticBackdrop1').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edititemID').val(data[0]);
                $('#editName').val(data[1]);
                $('#editUnit').val(data[2]);
                $('#editBrand').val(data[3]);
				$('#editcostprice').val(data[5]);
				$('#item_Category').val(data[4]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[4];

              });
           });

		    //Edit Transaction Modal 

		        $(document).ready(function(){
                $('.editbtn2').on('click',function(){
                $('#staticBackdrop2').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#editTransactionID').val(data[0]);
                $('#editSupplierID').val(data[1]);
                $('#editItemID').val(data[2]);
                $('#editQuantity').val(data[6]);
                $('#editItemCost').val(data[7]);
				$('#editDate').val(data[4]);
				$('#editStatus').val(data[5]);
				$('#editTotalPrice').val(data[9]);
				const $select = document.querySelector('#editDate');
                $select.value = data[4];
                document.getElementById("labelTransactionID").innerHTML = "Transaction ID: " + data[0];
				document.getElementById("labelSupplierID").innerHTML = "Supplier ID: " + data[1];
				document.getElementById("labelItemID").innerHTML = "Item ID: " + data[2];
            });
        });


		   //Add Notif

			$(document).ready(function(){
			
			$('#staticBackdropadd').on('submit',function() {  
			$.ajax({
				url:'addsupplieritem.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Item Added!", "success");
					
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdropadd").delay(10000).fadeOut("slow");
			});
			});

			$(document).ready(function(){
			
			$('#staticBackdropaddtrans').on('submit',function() {  
			$.ajax({
				url:'addtransaction.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Transaction Added!", "success");
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdropaddtrans").delay(10000).fadeOut("slow");
			});
			});

			//Edit Notif

			$(document).ready(function(){
			
			$('#staticBackdrop1').on('submit',function() {  
			$.ajax({
				url:'editsupplieritem.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Item Updated!", "success");
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdrop1").delay(10000).fadeOut("slow");
			});
			});


			$(document).ready(function(){
			
			$('#staticBackdrop2').on('submit',function() {  
			$.ajax({
				url:'edittransaction.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Transaction Updated!", "success");
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdrop2").delay(10000).fadeOut("slow");
			});
			});

			
			//Buy Notif
			$(document).ready(function(){
			
			$('#staticBackdrop').on('submit',function() {  
			$.ajax({
				url:'../inventory/addinventory.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Item Purchased!", "success");
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdrop").delay(10000).fadeOut("slow");
			});
			});

			

			
		</script>
	</body>

</html>