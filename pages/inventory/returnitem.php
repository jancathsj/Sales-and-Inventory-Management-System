<?php
error_reporting(0);
include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
?>
<?php
if (isset($_POST['delete1'])) {
        echo "delete clicked";
        $returnID = $_POST['returnID1'];
        //$supplierID = $_POST['supplierID1'];
        $deleteItem = "delete from return_item where return_ID= ".$returnID.";";
        $sqlDelete = mysqli_query($conn,$deleteItem);
        if ($sqlDelete) {
          echo "deleted";
        } else {
          echo mysqli_error($conn);
        }
        header("Location: ./returnitem.php");
        unset($_SESSION['delete1']);
  }

if(isset($_POST['edit'])){
    //$name = $_POST['editName'];
    $ID = $_POST['editID'];
	//$Name = $_POST['editName'];
    $quan = $_POST['editQuan'];
    $reason = $_POST['editReason'];
    $date = $_POST['editDate'];
	$url = "Location: ./" .$_POST['url'];
    $updateStatus= "UPDATE return_item set item_ReturnedQuan='$quan', item_Reason='$reason', itemReturn_Date='$date'
    WHERE return_ID = '$ID'";
	$sqlUpdate = mysqli_query($conn,$updateStatus);
	if($sqlUpdate){
		//echo "Update in inventory success <br/>";
	}
	else {
    echo mysqli_error($conn);
  } 
  unset($_POST['edit']);
    //echo "Record Edited Successfully";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Return Items </title>
	
	<script src="myjs.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="returnstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
	
	
	<script>
	
        
        $(document).ready(function(){
            $('.editbtn').on('click',function(){
                $('#staticBackdrop').modal('show');
                
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				let date = new Date(data[5]);
				//alert(date);
                $('#editID').val(data[0]);
				
				$('#editQuan').val(data[3]);
				$('#editName').val(data[2]);
                $('#editDate').val(date);
				$('#editReason').val(data[4]);
				const $select = document.querySelector('#editReason');
                $select.value = data[4];
                //$('#editCategory').val(data[4]);
                
                document.getElementById("labelID").innerHTML = "Item ID: " + data[1];
				//document.getElementById("labelName").innerHTML = "Item ID: " + data[2];

            });
        });
		
		function EditReason() {
		var d = document.getElementById("editTReason");
		var displaytext=d.options[d.selectedIndex].text;
		document.getElementById("editReason").value=displaytext;
} 

    </script> 
</head>
<body>
<main>
<div class="nav"> 
    <?php include 'navbar.php'; ?>
    </div> 
<?php
include_once '../../env/conn.php';

error_reporting(0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$db = mysqli_connect("localhost","root","","VSJM");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
	$item_ID = $_POST['item_Name'];
	$item_ReturnedQuan = $_POST['item_ReturnedQuan'];
	$item_Reason = $_POST['item_Reason'];
	$itemReturn_Date = $_POST['itemReturn_Date'];
	$insert = mysqli_query($db,"INSERT INTO return_item ". "(item_ID, item_ReturnedQuan, item_Reason, itemReturn_Date) ". "
			  VALUES('$item_ID', '$item_ReturnedQuan', '$item_Reason', '$itemReturn_Date')");
			  
	if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {
        echo "";
    }

}
?>

<div class="container-fluid bg-light p-5">
        <!-- EDIT MODAL ############################################################################ -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Return Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- MODAL-HEADER -->
                
                <form id="newform" action="returnitem.php" method="post" class="form-inline" > 
                <div class="modal-body mb-2">   
                    <input type="hidden"  id="editID" name="editID" placeholder="Enter"> 
                    <label for="editID" id="labelID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;"> ID: </label>
					
					
					
                    <div class="mb-1 mt-1"> 
					<label for="editQuan" >Returned Qty:: </label>
                    <div>
                        <input type="text" class="form-control"  id="editQuan" name="editQuan" placeholder="Enter">
                    </div> 
                    <label for="editTReason" >Item Reason: </label>
                    <div>
                        <select name="editTReason" id="editTReason" style="height:30px;" onchange="EditReason();">
						
							<option value="Excess quantity" >Excess quantity</option>
							<option value="Item has a defect">Item has a defect</option>
							<option value="Wrong item/s bought"> Wrong item/s bought </option>
							<option value="Wrong size bought"> Wrong size bougth </option>
							<option value=""> Others </option>
						</select>    
                    </div> 
					<label for="editReason" >Other Reason: </label>
                    <div>
						<input type="text" class="form-control"  id="editReason" name="editReason" placeholder="Enter">
					</div>
					<!-- <div>
					<input type="text" class="form-control"  id="editReason" name="editReason" placeholder="Enter">
                    </div> -->
                    <label for="editDate" >Date: </label>
                    <div>
                        <input type="datetime-local" class="form-control"  id="editDate" name="editDate" placeholder="Enter">
                    </div> 
                    </div> <!-- MB-1 MT-1 -->
                </div> <!-- MODAL-BODY -->
                <div class="modal-footer pb-0">
                    <input type="hidden" name="url" value="returnitem.php">
                    <input  type="submit" value="Update" name="edit" class="form-control btn btn-primary" style="width:150px" > 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> <!-- MODAL FOOTER -->
                </form>  
            </div> <!-- MODAL-CONTENT -->
            </div> <!-- MODAL-DIALOG -->
        </div> <!-- MODAL-FADE-->
        <!-- EDIT MODAL ############################################################################ -->
		
		 <!-- NOTIFICATION MODAL ############################################################################ -->
        <div class="modal fade modal-auto-clear" id="notif" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body mb-2">
                    <?php
                        if($_SESSION['updated'] == 'success'){
                            echo "Item updated successfully.";
                        } elseif ($_SESSION['updated'] = 'error') {
                            echo "There is an error updating the item.";
                        }
                    ?>

                </div> <!-- MODAL-BODY -->

            </div> <!-- MODAL-CONTENT -->
            </div> <!-- MODAL-DIALOG -->
        </div> <!-- MODAL-FADE-->
        <!-- EDIT MODAL ############################################################################ -->
<div class="container-fluid bg-light p-2.75">
	<div class="row">
		<div class="col-7" style="overflow-y: scroll; height: 680px;">
			<?php
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "VSJM";
			$conn = mysqli_connect($server, $user, $pass, $db);
				
			if(!$conn) die(mysqli_error($conn));
			$sql = "SELECT * FROM item INNER JOIN return_item ON(item.item_ID = return_item.item_ID);";                                    
			$result = mysqli_query($conn,$sql);
			$resultCheck = mysqli_num_rows($result);			
				
			echo "<table> 
					<tr>
						<th> Return ID </th>
						<th> Item ID </th>
						<th> Item Name </th>
						<th> Returned Quantity </th>
						<th> Reason </th>
						<th> Date of Return </th>
						<th> </th>
						<th> </th>
					</tr>";

			if ($resultCheck>0){
				while ($row = mysqli_fetch_assoc($result)) {
						echo "
						<tr>
						<td>" .$row['return_ID']. "</td>  
						<td>" .$row['item_ID']. "</td>
						<td>" .$row['item_Name']. "</td>
						<td>" .$row['item_ReturnedQuan']. "</td>  
						<td>" .$row['item_Reason'] . "</td> 
						<td>" .$row['itemReturn_Date'] . "</td> 
						";
						?>
						<td>
                    <button type="button" class="btn editbtn p-0" style="float:left;">
                        <i class='fas fa-edit'></i>
                    </button>
                </td>
				<td>
                    <form action="returnitem.php" class="mb-1" method="post">
                        <button class="btn" onclick='return checkdelete()' name="delete1" type="submit" style="float:right; padding-left:0px;"><i class='fas fa-trash'></i></button>
                        <input type=hidden name=returnID1 value=<?php echo $row['return_ID']?>>
                        
                        
                    </form>
                </td>    
                
						<?php
						
				}
			}       
			mysqli_close($conn);
			echo "</table>";
			?>
			<!--DELETE AND EDIT BUTTON-->
                
		</div>
		
	
	
	<div class="col bg-white border shadow-sm p-5" style="border-radius: 10px">
	<div class="fs-3 fw-bold text-center"> RETURN ITEM </div>
		<hr>
		<form action = "./returnitem.php" method="post" id="form" onsubmit="return confirm('Are you sure you want to submit this form?');">
			<div class="form-group row"> 
				<label for="item_Name" class="col-5 col-form-label fw-bold">Item ID:</label>
				<?php
						$server = "localhost:3306";
								$user = "root";
								$pass = "";
								$db = "VSJM";
								$conn = mysqli_connect($server, $user, $pass, $db);
								if(!$conn) die(mysqli_error($conn));
						$query = "SELECT * from item";
						$result = mysqli_query($conn,$query);
									if(mysqli_num_rows($result) > 0){
									?>
										<select name="item_Name" id="item" class="col-sm-10 form-select w-50" required>
									<?php
											while($row = mysqli_fetch_assoc($result)){
												echo "<option value='".$row['item_ID']."'>"
												.$row['item_ID']."</option>";
											}
											echo "</select><br>";
										}
								mysqli_close($conn);
					?>
			</div>
			<div class="form-group row mt-2">
				<label for="item_ReturnedQuan" class="col-5 col-form-label fw-bold">Returned Qty:</label>
				<input type = "text" name = "item_ReturnedQuan" id="item_ReturnedQuan" class="col-sm-10 form-control w-50"  required>
			</div>
			<div class="form-group row mt-2">
					<label for="item_TReason" class="col-5 col-form-label fw-bold">Reason:</label>
				<select name="item_TReason" id="item_TReason" class="col-sm-10 form-select w-50" onchange="Reason();" required >
				
				<option value="" id="reason">--Select Reason--</option>
				<option value="Excess quantity" >Excess quantity</option>
				<option value="Item has a defect">Item has a defect</option>
				<option value="Wrong item/s bought"> Wrong item/s bought </option>
				<option value="Wrong size bought"> Wrong size bougth </option>
				<option value=""> Others </option>
				</select>
			</div>
			<div class="form-group row mt-2">
				<label for="item_Reason" class="col-5 col-form-label fw-bold">Other Reason:</label>
				<input type="text" name= "item_Reason" id="item_Reason"  class="col-sm-10 form-control w-50"  required>
			</div>
			
			<div class="form-group row mt-2">
				<label for="itemReturn_Date" class="col-5 col-form-label fw-bold">Date of Return:</label>
				
					 <input type="datetime-local" name="itemReturn_Date" id="itemReturn_Date" class="col-sm-10 form-control w-50" required>
			</div>
			
			<div class="form-group row">
				<div class="col">
					<input type="submit" name="submit" value="submit" class="btn btn-lg btn-success mt-3 w-100">
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
</main>
<script type="text/javascript">
function Reason() {
	var d = document.getElementById("item_TReason");
	var displaytext=d.options[d.selectedIndex].text;
	document.getElementById("item_Reason").value=displaytext;
}  

const now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById('itemReturn_Date').value = now.toISOString().slice(0, 16);

function checkdelete(){
    return confirm('Are you sure you want to delete this record?');
}

	//Edit Notif

	$(document).ready(function(){

	$('#staticBackdrop').on('submit',function() {  
	$.ajax({
		url:'returnitem.php', 
		data:$(this).serialize(),
		type:'POST',
		success:function(data){
			console.log(data);
			swal("Success!", "Return Item Updated!", "success");
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
