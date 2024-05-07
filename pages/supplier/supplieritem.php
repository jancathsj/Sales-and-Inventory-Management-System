<?php
  error_reporting(0);
  include_once '../../env/conn.php';
  require_once '../../env/auth_check.php';
  
  if(isset($_POST['order'])){
        $_SESSION['orderItemID'] = $_POST['orderItemID'];
        $_SESSION['orderItemSupp'] = $_POST['orderItemSupp'];
          header("Location: ../inventory/addinventory.php");
        unset($_POST['edit']);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Suppliers </title>
    <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> -->
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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- JQUERY/BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    
  </head>

  
  <body>
    <main>
    <div class="nav"> 
    <?php include 'navbar.php'; ?>
    </div>   

    
    <div class="container-fluid bg-light p-5 pt-2">
      <div class="row justify-content-md-center">
        <div class="row">
          <div class="col position-relative">
            <br>
            <div class="text-center fs-1 fw-bold"> SUPPLIER ITEMS </div>
          </div>
        </div>
      </div>
      <!-- EDIT MODAL ############################################################################ -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Item & Supplier</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- MODAL-HEADER -->
            
            <form id="newform" action="editsupplieranditem.php" method="post" class="form-inline" > 
              <div class="modal-body mb-2">   

                <!--<input type="hidden"  id="edititemID" name="edititemID" placeholder="Enter"> -->
                <div style="display:flex; flex-direction: row; align-items: center;">
                  <label for="edititemID" style="border:0; background-color: transparent; font-size: 1.35em; color:black; font-weight: 500;">Item ID: </label>
                  <span><input type="text" class="form-control" id="edititemID" name="edititemID" style="font-size: 1.35em; color:black; font-weight: 500;" readonly></span>
                </div>
                <div style="display:flex; flex-direction: row; align-items: center;">
                  <label for="editsupplierID" id="labelsupplierID" style="border:0; background-color: transparent; font-size: 1.35em; color:black; font-weight: 500;">Supplier ID: </label>
                  <span><input type="text" class="form-control" id="editsupplierID" name="editsupplierID" style="font-size: 1.35em; color:black; font-weight: 500;" readonly></span>
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
                  <label for="editsupplier" >Supplier Name: </label>
                  <div>
                    <input type="text" class="form-control"  id="editsupplier" name="editsupplier" placeholder="Enter">
                  </div> 
                  
                  <label for="editstatus" >Supplier Status: </label>
                  <div>
                    <select name="editstatus" id="editstatus" style="height:30px;" >
                      <option value="1" >Active</option>
                      <option value="0" >Inactive</option>
                    </select>        
                  </div> 
                  <label for="editcostprice">Cost Price: </label>
                  <div>
                    <input type="number" step="any" class="form-control"  id="editcostprice" name="editcostprice" placeholder="Enter">
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
      <!-- EDIT MODAL ############################################################################ -->

      <!-- BUY MODAL ############################################################################ -->

            <div class="modal fade" id="staticBackdropbuy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Buy Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <!-- MODAL-HEADER -->
                    
                    <form id="newform" action="../inventory/addinventory.php" method="post" class="form-inline" > 
                    <div class="modal-body mb-2">

                        <?php
                          
                        ?>
                        
                        <input type="hidden"  id="editID1" name="editID1" placeholder="Enter">
                        <input type="hidden"  id="editsuppID1" name="editsuppID1" placeholder="Enter">
                        
                        <label for="editID1" id="labelID1" style="border:0; background-color: transparent; font-size: 1em; color:black; font-weight: 400;padding:0px;">Item ID: </label> </br>

                        <label for="editsuppID1" id="labelsuppID1" style="border:0; background-color: transparent; font-size: 1em; color:black; font-weight: 400;padding:0px;">Supplier ID: </label> </br>

                        <label for="editName1" id="labelName1" style="border:0; background-color: transparent; font-size: 1.5em; color:black; font-weight: 500;"></label>
                        <div>
                            <label  id="labelBrand1" style="border:0; background-color: transparent; font-size: 1em; color:black; font-weight: 500;"></label>
                        </div>
                        <div class="mb-1 mt-1">
                         
                        
                        <div>
                            <label id="labelCost1" style="border:0; background-color: transparent; font-size: 1.25em; color:black; font-weight: 500; padding-bottom:5px; color:#D8172B;"></label>
                            <input type="hidden"  id="editCost1" name="editCost1" placeholder="Enter">
                        </div> 
                        
                        <label for="editRetail1" >Retail Price: </label>
                        <div>
                            <input type="number" step="0.25" class="form-control"  id="editRetail1" name="editRetail1" placeholder="Enter">
                            <input type="hidden" step="0.25" class="form-control"  id="hiddenRetail" name="hiddenRetail" placeholder="Enter">
                        </div> 
                        
                        <label for="editMarkup1" >Markup: </label>
                        <div>
                            <input type="number" step="0.01" class="form-control"  id="editMarkup1" name="editMarkup1" placeholder="Enter">
                            <input type="hidden" step="0.01" class="form-control"  id="hiddenmarkup" name="hiddenmarkup" placeholder="Enter">
                        </div> 
                        <label for="editStock1" >Quantity: </label>
                        <div>
                            <input type="number" step="any" class="form-control"  id="editStock1" name="editStock1" placeholder="Enter">
                        </div> 
                        <label for="item_Category1" >Category: </label>
                        <div>
                            <select name="item_Category1" id="item_Category1" style="height:30px;" >
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
                        <input  type="submit" value="Buy" name="buy1" class="form-control btn btn-primary" style="width:150px" >  <!-- INSERT ALERT -->
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

                  <p>Item Cost Price:<input type="text" name="supplierItem_CostPrice" class="form-control" placeholder="Enter"></p>

                  
                </div>
                <div class="modal-footer pb-0">
                  <input type="hidden" id="prevpage" name="prevpage" value="supplieritem">
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


      <div id="supplierHead"> 
          
      <!-- END OF INVENTORY HEAD -->
      
       <!-- <div id="filters">-->
            
          <!-- SEARCH TAB -->
        <div class="row justify-content-md-center">
          <div class="form-group row mt-2 justify-content-md-center">
          <!--<div id="searchSortContainer">-->

            <!-- STATUS -->
            <label for="sort" class="col-auto col-form-label fw-bold">Status:</label>
            <select name="stat" id="stat" class="col-sm-10 form-select w-auto">
              <option value="all">All</option>
              <option value="active" selected>Active</option>
              <option value="inactive">Inactive</option>
            </select> <!-- END OF SORTING -->



            <!-- SORTING -->
            <label for="sort" class="col-auto col-form-label fw-bold">Sort by:</label>
            <select name="sort" id="sort" class="col-sm-10 form-select w-auto">
              <option value="ItemID" selected>Item ID</option>
              <option value="SupplierID">Supplier ID</option>
              <option value="PriceAsc"> <span>&#8593;</span>Price</option>
              <option value="PriceDesc"> <span>&#8595;</span>Price</option>
            </select> <!-- END OF SORTING -->

            <div class="col-5">
              <input type="text" id="search" class="form-control w-100" autocomplete="off" placeholder="Search for Items, Brand, Supplier..." <?php if(isset($_GET['item_ID'])){
                 
                  $query = "SELECT * from item where item_ID =".$_GET['item_ID'];
                    $result = mysqli_query($conn,$query);
                      if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                          echo" value='".$row['item_Name']."' ";
                        }
                      }
                 
               }
             ?> >
            </div>
                        
          <!--</div>--> <!-- END OF SEARCHSORT CONTAINER -->
          </div>
        </div> 
      <!--</div> END OF FILTERS -->
      
        <!-- DISPLAY LIST OF ITEMS IN INVENTORY -->
        <div id="display">
            <?php include 'search_sort_item.php'; ?>
        </div> <!-- END OF DISPLAY -->

        <div id="filters">
          <!-- ADD NEW ITEM IN INVENTORY BUTTON -->
          <button class="btn btn-success additembtn" style="display: inline-block;" type="button" >Add Item/Supplier</button>
           <div class="row-6 align-self-center" style="float:right;" >
                
                  <form action="exportpurchases.php" method="post">
                    <div class="align-bottom" style=" display: inline-block;">
                      <label for="exportMonth" class="col-auto col-form-label fw-bold">Month & Year:</label>
                    </div>
                    <div class="align-bottom" style=" display: inline-block;">
                      <input type="month" class="form-control" id="exportMonth" name="exportMonth">
                    </div>
                    <div class="align-bottom" style=" display: inline-block;">
                      <button class="btn btn-success purchasesbtn " name="export" type="submit" style="float:right;"><i class='fas fa-download'></i>  Monthly Purchases</button>
                    </div>
                  </form>
            </div>
        </div>

    </div>
  </div>

  </main><!-- END OF CONTENT -->

         <script>
           $(document).ready(function(){
              $('.editbtn').on('click',function(){
                $('#staticBackdrop').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edititemID').val(data[0]);
                $('#editName').val(data[1]);
                $('#editUnit').val(data[2]);
                $('#editBrand').val(data[3]);
                $('#editsupplierID').val(data[5]);
                $('#editsupplier').val(data[6]);
                $('#editstatus').val(data[7]);
                $('#editcostprice').val(data[8]);
                $('#item_Category').val(data[4]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[4];


                const $select1 = document.querySelector('#editstatus');
                $select1.value = data[7];
                
                
              });
           });

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

              $("#item_ID").change(function () {
                  toggleFields();
              });
        
          });

          $('#editRetail1').change(function() {
            var costPrice = $('#editCost1').val();
            var retail = $('#editRetail1').val();
            
            $('#editMarkup1').val(Number(parseFloat(retail /costPrice).toFixed(2)));
            
          });
          $('#editMarkup1').change(function() {
            var costPrice = $('#editCost1').val();
            var retail = (costPrice*$('#editMarkup1').val()).toFixed(1);
            retail = Math.ceil(retail*4)/4;
            $('#editRetail1').val( retail);
          });

          $(document).ready(function(){
              $('.buybtn').on('click',function(){
                  $('#staticBackdropbuy').modal('show');
                  $tr = $(this).closest('tr');

                  var data = $tr.children("td").map(function () {
                      return $(this).text();
                  }).get();

                  console.log(data);
                  var retail = data[8]*1.2;
                  $('#editID1').val(data[0]);
                  $('#editsuppID1').val(data[5]);
                  $('#editRetail1').val(Math.ceil(retail*4)/4);               
                  $('#editMarkup1').val(1.2);
                  //$('#editStock').val(data[6]);
                  $('#item_Category1').val(data[4]);
                  const $select2 = document.querySelector('#item_Category1');
                  $select2.value = data[4];
                  $('#editCost1').val(data[8]);
                  
                  document.getElementById("labelID1").innerHTML = "Item ID: " + data[0];
                  document.getElementById("labelsuppID1").innerHTML = "Supplier ID: " + data[5];
                  document.getElementById("labelName1").innerHTML = data[1];
                  document.getElementById("labelBrand1").innerHTML = data[3];
                  document.getElementById("labelCost1").innerHTML = data[8] + "/"+ data[2];
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

          //SEARCH AND SORT JS

           function fill(Value) {
              $('#search').val(Value);
              $('#display').hide();
           }


          function edit(){
              $('#staticBackdrop').modal('show');
              alert("hi");
          }


          //CHECK SUPPLIERS FROM THE ITEM LIST IN INVENTORY
          $(window).on('load', function() {
                  var input = $("#search").val();
                  var option = $("#sort").find(":selected").val();
                  sessionStorage.setItem("selectedOption", option);
                  var optionValue = $("#sort").selectedIndex;

                  var statoption= "all";

                      $.ajax({
                          type: "POST",
                          url: "search_sort_item.php",
                          data: {
                              search: input,
                              selected: option,
                              stats: statoption
                          },
                          success: function(data) {
                              $("#display").html(data);
                          }
                      });
          });

          //SEARCH AND SORT BY
          $(document).ready(function(){

            $("#stat").change(function() {
                  var input = $("#search").val();
                  var option = $("#sort").find(":selected").val();
                  sessionStorage.setItem("selectedOption", option);
                  var optionValue = $("#sort").selectedIndex;

                  var statoption= $("#stat").find(":selected").val();
                  sessionStorage.setItem("selectedOption", statoption);
                  var statoptionValue = $("#stat").selectedIndex;

                      $.ajax({
                          type: "POST",
                          url: "search_sort_item.php",
                          data: {
                              search: input,
                              selected: option,
                              stats: statoption
                          },
                          success: function(data) {
                              $("#display").html(data);
                          }
                      });

              });

              $("#search").keyup(function() {
                  var input = $("#search").val();
                  var option = $("#sort").find(":selected").val();
                  sessionStorage.setItem("selectedOption", option);
                  var optionValue = $("#sort").selectedIndex;

                  var statoption= $("#stat").find(":selected").val();
                  sessionStorage.setItem("selectedOption", statoption);
                  var statoptionValue = $("#stat").selectedIndex;

                      $.ajax({
                          type: "POST",
                          url: "search_sort_item.php",
                          data: {
                              search: input,
                              selected: option,
                              stats: statoption
                          },
                          success: function(data) {
                              $("#display").html(data);
                          }
                      });

              });

              $("#sort").change(function(){
                  var input = $("#search").val();
                  var option = $("#sort").find(":selected").val();
                  sessionStorage.setItem("selectedOption", option);
                  var optionValue = $("#sort").selectedIndex;

                  var statoption= $("#stat").find(":selected").val();
                  sessionStorage.setItem("selectedOption", statoption);
                  var statoptionValue = $("#stat").selectedIndex;

                  $.ajax({
                      type: "POST",
                      url: "search_sort_item.php",
                      data: {
                          search: input,
                          selected: option,
                          stats: statoption
                      },
                      success: function(data) { 
                          $("#display").html(data);
                      }
                  });
                  
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

          	//Edit Notif

          $(document).ready(function(){

          $('#staticBackdrop').on('submit',function() {  
          $.ajax({
            url:'editsupplieranditem.php', 
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
              console.log(data);
              swal("Success!", "Item and Supplier Updated!", "success");
            },
            error:function(data){
              swal("Oops...", "Something went wrong :(", "error");
            }
            });
            $("#staticBackdrop").delay(10000).fadeOut("slow");
          });
          });

          //Buy Notif

          $(document).ready(function(){

          $('#staticBackdropbuy').on('submit',function() {  
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
            $("#staticBackdropbuy").delay(10000).fadeOut("slow");
          });
          });


          

         </script>   

  </body>
</html>