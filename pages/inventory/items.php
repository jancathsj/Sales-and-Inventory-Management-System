<?php
include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
if(isset($_POST['edit'])>0){
    $name = $_POST['editName'];
    $ID = $_POST['editID'];
    $brand = $_POST['editBrand'];
    $categ = $_POST['item_Category'];
    $unit = $_POST['editUnit'];
    mysqli_query($conn, "UPDATE item set item_Name='$name', item_unit='$unit', item_Brand='$brand', item_Category = '$categ'
    WHERE item_ID = '$ID'");
}


?>


<!DOCTYPE html>
<html>
<head>
    <title> List of Items </title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="myjs.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  
	<!-- JQUERY/BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

  
    <script>
        
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
                $('#editUnit').val(data[2]);
                $('#editBrand').val(data[3]);
                $('#editCategory').val(data[4]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[4];
                document.getElementById("labelID").innerHTML = "Item ID: " + data[0];
            });
        });

        //Edit Notif

		$(document).ready(function(){

        $('#staticBackdrop').on('submit',function() {  
        $.ajax({
            url:'items.php', 
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
            $("#staticBackdrop").delay(10000).fadeOut("slow");
        });
        });

    </script> 
</head>
<body>
    <main>
    <?php include 'navbar.php'; ?>
        
    <div class="container-fluid bg-light p-5">
        <!-- EDIT MODAL ############################################################################ -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- MODAL-HEADER -->
                
                <form id="newform" action="items.php" method="post" class="form-inline" > 
                <div class="modal-body mb-2">   
                    <input type="hidden"  id="editID" name="editID" placeholder="Enter"> 
                    <label for="editID" id="labelID" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500;">Item ID: </label>
                    <div class="mb-1 mt-1"> 
                    <label for="editName" >Item Name: </label>
                    <div>
                        <input type="text" class="form-control"  id="editName" name="editName" placeholder="Enter">
                    </div> 
                    <label for="editUnit" >Item Unit: </label>
                    <div>
                        <input type="text" class="form-control"  id="editUnit" name="editUnit" placeholder="Enter">
                    </div> 
                    <label for="editBrand" >Brand: </label>
                    <div>
                        <input type="text" class="form-control"  id="editBrand" name="editBrand" placeholder="Enter">
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
                        </select>        
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

                            <form action = "additem.php" method="post" id="myForm">
                                <div class="mb-1 mt-1">

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

                                    <p>Item Cost Price:<input type="number" name="supplierItem_CostPrice" class="form-control" placeholder="Enter"></p>

                                    
                                </div>
                                <div class="modal-footer pb-0">
                                    <input type="hidden" id="prevpage" name="prevpage" value="items">
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
            

<div class="fs-1 fw-bold text-center pt-5"> LIST OF ITEMS </div>
<div class="card mt-3 mb-3" style="float:left; width:100%">
<?php

$sql = "SELECT * FROM item;";                                    
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
       
echo "<div class='table-wrapper p-3'><table class='table table-hover'> 
        <thead> 
        <tr>
            <th> ID </th>
            <th> Item </th>
            <th> Unit </th>
            <th> Brand </th>
            <th> Category </th>
            <th> </th>
        </tr>
        </thead>
        <tbody>";

if ($resultCheck>0){
    while ($row = mysqli_fetch_assoc($result)) {
            echo "
			<tr>
            <td>" .$row['item_ID']. "</td>  
            <td>". $row['item_Name']. "</td>  
            <td>" .$row['item_unit']. "</td>  
            <td>" .$row['item_Brand'] . "</td> 
            <td>" .$row['item_Category'] . "</td>";

                //<button type='button' class='btn editbtn pt-0' onclick=\"location.href='edititems.php?item_ID=".$row['item_ID']." ' \"><i class='fas fa-edit'></i></button>
            ?>
            <td>
                <button type="button" class="btn editbtn p-0" style="float:left; padding:5px;">
                <i class='fas fa-edit'></i>
                </button>
            </td>
            <?php    
            echo "<td> <button class='btn p-0' onclick=\"location.href='../supplier/supplieritem.php?item_ID=".$row['item_ID']." ' \"><i class='fas fa-shopping-cart'></i></button> </td>"; ?>
            <td>
                <form action="itemTransactions.php" class="mb-1" method="post">
                    <button class="btn p-0" name="more" type="submit" ><i style="font-size:15px" class="fa">&#xf0c9;</i></button>
                    <input type=hidden name=itemID1 value=<?php echo $row['item_ID']?>>
                    <input type=hidden name=itemIDName value='<?php echo $row['item_Name']?>'>
                </form>
            </td>
            </tr>
            <?php
    }
}       
mysqli_close($conn);
echo "</tbody></table></div>";

?>
</div>
<button class='btn btn-primary additembtn p-2 mt-3' type="button">Add Item </button> 
</div>
</main>

<script>

//ADD ITEM/SUPPLIER MODAL

          $(document).ready(function(){
            $('.additembtn').on('click',function(){
              $('#staticBackdropadd').modal('show');
            });
          });

          $(document).ready(function () {
              toggleFields(); 
              $("#supplier_ID").change(function () {
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

          }

	//Add Notif

    $(document).ready(function(){

    $('#staticBackdropadd').on('submit',function() {  
    $.ajax({
        url:'additem.php', 
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

</script>

</body>
</html>