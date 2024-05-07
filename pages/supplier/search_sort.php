<?php
    error_reporting(0);
    include_once '../../env/conn.php';

    // SQL QUERIES ==========================================================================================
    // FROM SEARCH TAB
    if (isset($_POST['search'])) {
        $Name = $_POST['search'];
        if ($Name!="") {    
            $sql = "SELECT * FROM supplier WHERE supplier_Name LIKE '%$Name%' OR supplier_ContactPerson LIKE '%$Name%' OR supplier_Address LIKE '%$Name%' OR supplier_Status LIKE '%$Name%'; ";
        } else {
            $sql = "SELECT * FROM supplier;"; 
        }
	// FROM SORT
    } else if (isset($_POST['selected'])) {
        $k = $_POST['selected'];
        $_SESSION['option'] = $_POST['selected'];
        if ($k == "SupplierName") {
            $sql = "SELECT * FROM supplier ORDER BY supplier_Name ASC;"; 
        } else if ($k == "ContactP") {
			$sql = "SELECT * FROM supplier ORDER BY supplier_ContactPerson ASC;";
        } else if ($k == "Address") {
			$sql = "SELECT * FROM supplier ORDER BY supplier_Address ASC;";
        } else if ($k == "ID"){
            $sql = "SELECT * FROM supplier ORDER BY supplier_ID ASC;"; 
        } else {
            $sql = "SELECT * FROM supplier"; 
        }
    // DEFAULT: BY ID    
    }  else {
            $sql = "SELECT * FROM supplier ORDER BY supplier_ID;"; 
    }  
    // END OF SQL QUERIES ==========================================================================================
    
    // SHOW RESULT OF QUERY

	$resultSupplier = mysqli_query($conn,$sql);
	if(mysqli_num_rows($resultSupplier) > 0){
		echo "<table class='table'>
		<thead>
		<tr>
			<th>Supplier ID</th>
			<th>Supplier Name</th>
      		<th>Supplier Contact Person</th>
			<th>Supplier Number</th>
			<th>Supplier Address</th>
			<th>Status</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		";
		while($row = mysqli_fetch_assoc($resultSupplier)){
			if($row['supplier_Status']==0){
				$supplier_Status="Inactive";
			}
			else{
				$supplier_Status="Active";
			}
		?>
			<tr>
				<td> <?php echo $row['supplier_ID'] ?> </td>
				<td> <?php echo $row['supplier_Name'] ?> </td>
				<td> <?php echo $row['supplier_ContactPerson'] ?> </td>
				<td> <?php echo $row['supplier_ContactNum'] ?> </td>
				<td> <?php echo $row['supplier_Address'] ?> </td>
				<td> <?php echo $supplier_Status ?> </td>
				<td>
						<button type="button" class="btn btn-outline-success editbtn" style="float:left; padding:5px;">
							Edit
						</button>
				</td>
				<td>
					<button class="btn btn-outline-primary" onclick="changeLoc('delete','<?php echo $row['supplier_ID']?>')">
						Change Status
					</button>
				</td>
				<!-- <td> <button> <a onclick='return checkdelete()' href='deletesupplier.php?supplier_ID=".$row['supplier_ID']."'> Delete</button></a></td> -->
				<td>
					<button class="btn btn-outline-danger" onclick="changeLoc('supplier','<?php echo $row['supplier_ID']?>')">
						More Info
					</button>
				</td>
			</tr>
		<?php
		}
		echo "</table>";
	}
	else echo "No results";
?>

<div class="container-fluid bg-light p-5 pt-2">
        <!-- EDIT MODAL ############################################################################ -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- MODAL-HEADER -->
                
                <form id="newform" action="editsupplier.php" method="post" class="form-inline" > 
                <div class="modal-body mb-2">   
                    <input type="hidden"  id="editID" name="editID" placeholder="Enter"> 
                    <label for="editID" id="labelID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;">Supplier ID: </label>
                    <div class="mb-1 mt-1"> 
                    <label for="editName" >Supplier Name: </label>
                    <div>
                        <input type="text" class="form-control"  id="editName" name="editName" placeholder="Enter">
                    </div> 
                    <label for="editPerson" >Supplier Contact Person: </label>
                    <div>
                        <input type="text" class="form-control"  id="editPerson" name="editPerson" placeholder="Enter">
                    </div> 
                    <label for="editNumber" >Supplier Contact Number: </label>
                    <div>
                        <input type="text" class="form-control"  id="editNumber" name="editNumber" placeholder="Enter">
                    </div> 
					<label for="editAddress" >Supplier Address: </label>
                    <div>
                        <input type="text" class="form-control"  id="editAddress" name="editAddress" placeholder="Enter">
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
        <!-- EDIT MODAL ############################################################################ -->

               

<script>
		//Edit Modal

			  $(document).ready(function(){
            $('.editbtn').on('click',function(){
                $('#staticBackdrop').modal('show');
                
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#editID').val(data[0]);
                $('#editName').val(data[1]);
                $('#editPerson').val(data[2]);
                $('#editNumber').val(data[3]);
                $('#editAddress').val(data[4]);
                document.getElementById("labelID").innerHTML = "Supplier ID: " + data[0];
            });
        });

		//Edit Notif
		$(document).ready(function(){
			
			$('#staticBackdrop').on('submit',function() {  
			$.ajax({
				url:'editsupplier.php', 
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
					swal("Success!", "Supplier Updated!", "success");
				},
				error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
				});
				$("#staticBackdrop").delay(10000).fadeOut("slow");
			});
			});

</script>
  
