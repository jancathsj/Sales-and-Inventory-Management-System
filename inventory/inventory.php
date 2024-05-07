<?php
error_reporting(0);
include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
$result = mysqli_query($conn, "SELECT SUM(item_Stock) AS totalItems, SUM(item_RetailPrice*item_Stock) AS totalValue FROM inventory WHERE inventoryItem_Status = 1");
$row = mysqli_fetch_array($result);

$totalItems = $row['totalItems'];
$totalValue = $row['totalValue'];

$result = mysqli_query($conn, "SELECT SUM(transaction_TotalPrice) AS cost FROM `supplier_transactions`WHERE transaction_Status=2");
$row = mysqli_fetch_array($result);

$totalCost = $row['totalCost'];


if (isset($_POST['edit'])) { //UPDATING INVENTORY
  //echo $_POST['editID'];
  $itemID = $_POST['editID'];
  $item_Name =$_POST['editName'];
  $item_Unit =$_POST['editUnit'];
  $item_Brand =$_POST['editBrand'];
  $item_Retail =$_POST['editRetail'];
  $item_Markup =$_POST['editMarkup'];
  $item_Stock =$_POST['editStock'];
  $item_Category = $_POST['item_Category'];
  $url = "Location: ./" .$_POST['url'];

  if($item_Stock<=10){
    $pend = 1;
  } else{
    $pend =0;
  }

  $updateStatus = "UPDATE inventory SET in_pending=$pend, item_Stock = '$item_Stock', item_RetailPrice = '$item_Retail', Item_markup = '$item_Markup' WHERE item_ID = '$itemID' AND branch_ID=1;";
  $sqlUpdate = mysqli_query($conn,$updateStatus);
  $updateStatus = "UPDATE item SET item_Name = '$item_Name', item_unit='$item_Unit', item_Brand ='$item_Brand', item_Category = '$item_Category' WHERE item_ID = '$itemID';";
  $sqlUpdate = mysqli_query($conn,$updateStatus);
  if ($sqlUpdate) {
    //echo "Update in inventory success <br/>";
  } else {
    echo mysqli_error($conn);
  } 
  unset($_POST['edit']);
  //header($url);
  //header("Location: ./inventory.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <title> Inventory </title>
  <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
  <script type="text/javascript" src="inventory.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
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
                $('#editRetail').val(data[4]);
                $('#editMarkup').val(data[5]);
                $('#editStock').val(data[6]);
                $('#editCategory').val(data[7]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[7];
                $('#editCost').val(data[9]);
                $('#hiddenRetail').val(data[4]);
                $('#hiddenmarkup').val(data[5]);
                document.getElementById("labelID").innerHTML = "Item ID: " + data[0];
            });

            $('.delete1btn').on('click',function(){
                $('#confirmDelete').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#deleteID').val(data[0]);
                document.getElementById("deleteName").innerHTML = data[1] ;

            });

        });

    </script> 
</head>
  <body> 
    <main>
    <div class="nav"> 
    <?php include 'navbar.php'; ?>
    </div>   

    <div class="container-fluid bg-light p-5 pt-2">
      <!-- EDIT MODAL ############################################################################ -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- MODAL-HEADER -->
            
            <form id="newform" action="inventory.php" method="post" class="form-inline" > 
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
                  <label for="editRetail" >Retail Price: </label>
                  <div>
                    <input type="number" step="0.25" class="form-control"  id="editRetail" name="editRetail" placeholder="Enter">
                    <input type="hidden" step="0.25" class="form-control"  id="hiddenRetail" name="hiddenRetail" placeholder="Enter">
                  </div> 
                  <input type="hidden" step="0.01" class="form-control"  id="editCost" name="editCost" placeholder="Enter">
                  <label for="editMarkup" >Markup: </label>
                  <div>
                    <input type="number" step="0.01" class="form-control"  id="editMarkup" name="editMarkup" placeholder="Enter">
                    <input type="hidden" step="0.01" class="form-control"  id="hiddenmarkup" name="hiddenmarkup" placeholder="Enter">
                  </div> 
                  <label for="editStock" >Number of Stocks: </label>
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
                  <input  type="submit" value="Update" name="edit" class="form-control btn btn-primary" style="width:150px" > 
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div> <!-- MODAL FOOTER -->
            </form>  
          </div> <!-- MODAL-CONTENT -->
        </div> <!-- MODAL-DIALOG -->
      </div> <!-- MODAL-FADE-->
      <!-- EDIT MODAL ############################################################################ -->

      <!-- DELETE MODAL ############################################################################ -->
      <div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" style="top:25%;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteLabel">Delete Item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- MODAL-HEADER -->
            
            <form id="deleteform" action="search_sort.php" method="post" class="form-inline" > 
              <div class="modal-body mb-2">   
                <input type="hidden"  id="deleteID" name="deleteID" placeholder="Enter"> 
                  <label >Are you sure you want to delete <strong id="deleteName" name="deleteName"> item </strong>? This item will be moved to trash. </label>                  
              </div> <!-- MODAL-BODY -->
              <div class="modal-footer pb-0">
                  <input type="hidden" name="url" value="inventory.php">
                  <input  type="submit" value="Delete" name="delete2" class="form-control btn btn-primary" style="width:150px" > 
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div> <!-- MODAL FOOTER -->
            </form>  
          </div> <!-- MODAL-CONTENT -->
        </div> <!-- MODAL-DIALOG -->
      </div> <!-- MODAL-FADE-->
      <!-- DELETE MODAL ############################################################################ -->


      <div id="inventoryHead" class="row mt-3" >
        <div class="col-7">
          <span class="fs-1 fw-bold"> INVENTORY </span>
        </div>

      </div> <!-- END OF INVENTORY HEAD -->
      
        <div id="filters" class="row mt-3">
          <!-- CHOOSING CATEGORY -->
          <div id="categoryContainer" class="col-7"> 
            <div class="form-group row">
              <label for="categ" class="col-auto col-form-label fw-bold">Category:</label>
              <select name="categ" id="categ" class="col-sm-10 form-select w-25" onchange="sort()">
                <option value="All" selected >All</option>
                <option value="Architectural"> Architectural</option>
                <option value="Electrical"> Electrical</option>
                <option value="Plumbing"> Plumbing</option>
                <option value="Tools">Tools</option>
                <option value="bolts and nuts">Bolts and Nuts</option>
                <option value="Paints">Paints and Accessories</option>
                <option value="Wood">Wood</option>
              </select> 

              <label for="sort" class="col-auto col-form-label fw-bold">Sort by:</label>
              <select name="sort" id="sort" class="col-sm-10 form-select w-25" onchange="sort()">
                <option value="item_Stock" selected >Stocks</option>
                <option value="ID" >ID</option>
                <option value="Category">Category</option>
                <option value="PriceAsc"> <span>&#8593;</span>Price</option>
                <option value="PriceDesc"> <span>&#8595;</span>Price</option>
                <option value="Salability">Salability</option>
              </select> <!-- END OF SORTING -->
            </div>
          </div>
          <!-- END OF CATEGORY CONTAINER -->
            
          <!-- SEARCH TAB -->
          <div id="searchSortContainer" class="col">
            <div class="form-group row">
              <div class="col">
                <input type="text" id="search" class="form-control w-100" autocomplete="off" onkeyup="search()" placeholder="Search for items, brand, category...">
              </div>
              <!-- SORTING -->
              </div>
          </div>
        </div> <!-- END OF FILTERS -->
      
        <!-- DISPLAY LIST OF ITEMS IN INVENTORY -->
        <div class="card mt-3 mb-3" style="float:left; width:100%">
        <div id="display" class="p-3" style="padding-bottom:0">
            <?php include "search_sort.php";
                  include 'addpending.php';
                  ?>
        </div>
        </div> <!-- END OF DISPLAY -->

        <div class="mt-2" >
          <div style="color:red; float:left;">*Items highlighted are Low on Stocks</div> 
          
          <!-- ADD NEW ITEM IN INVENTORY BUTTON -->
          <button class="btn btn-dark"style="float:right; " type="button" onclick="location.href='../supplier/suppliers.php'">New Item</button>
          <!-- DOWNLOAD ITEMS IN INVENTORY -->
          <form action="export.php" method="post">
            <button class="btn btn-success" style="float:right; margin-right:10px" name="exportItems" type="submit" >Export Inventory</button>
          </form>
        </div>

    </div> <!-- END OF CONTENT -->



    </div>

    </div>
    </main>

    <!-- Simultaneous editing of retail and markup -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
      $('#editRetail').change(function() {
          //var retail = $('#hiddenRetail').val(); 
          //var markup = $('#hiddenmarkup').val();
          retail = $('#editRetail').val();
          var costPrice = $('#editCost').val();
          if (costPrice!="") {
            
            var newmarkup = Number(parseFloat(retail/costPrice).toFixed(2));
            $('#editMarkup').val(newmarkup);
          }
          //$('#editMarkup').val((retail - costPrice)/costPrice);
          //alert(newmarkup);
          
          //$('#hiddenRetail').val($('#editRetail').val());
         // alert($('#editMarkup').val());
      });
      $('#editMarkup').change(function() {
          var retail = $('#editRetail').val();
          var markup = $('#editmarkup').val();
          var costPrice = $('#editCost').val();
          if (costPrice!="") {
            retail = (costPrice*$('#editMarkup').val()).toFixed(1);
            retail = Math.ceil(retail*4)/4;    
            $('#editRetail').val(retail);
          }
          
      });

      //Edit Notif
      $(document).ready(function(){
      $('#staticBackdrop').on('submit',function() {  
      $.ajax({
        url:'inventory.php', 
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

      //Delete Notif
      $('#confirmDelete').on('submit',function() {  
      $.ajax({
        url:'search_sort.php', 
        data:$(this).serialize(),
        type:'POST',
        success:function(data){
          console.log(data);
          swal("Deleted!", "Item moved to trash.", "success");
        },
        error:function(data){
          swal("Oops...", "Something went wrong :(", "error");
        }
        });
        $("#confirmDelete").delay(10000).fadeOut("slow");
      });

      });
      
    </script>



  </body>
</html>
