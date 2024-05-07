<?php

include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
$n=0;
$k=0;
$empty = false;
//ORDER BUTTON IN PENDING ORDERS
if (isset($_POST['order'])) {
  $transID=$_POST['transaction'];
  //UPDATE TRANSACTION_STATUS TO 1 (ORDERED ALREADY)
  $updateStatusTrans = "UPDATE supplier_transactions SET transaction_Status=1 WHERE transaction_ID = '$transID';";
  $sqlUpdateTrans = mysqli_query($conn,$updateStatusTrans);
  if ($sqlUpdateTrans) {
    //echo "Update in supplier transactions Success </br>";
  } else {
    echo mysqli_error($conn);
  } //END OF UPDATING TRANSACTION STATUS
}

//REMOVE BUTTON IN PENDING ORDERS
if (isset($_POST['delete'])) {
  $deleteItemID=$_POST['itemID'];
  $deleteitemTrans = $_POST['transID'];
  //DELETE ITEM FROM PENDING TRANSACTION
  $deleteItem = "DELETE FROM transaction_Items WHERE item_ID = '$deleteItemID' AND transaction_ID = '$deleteitemTrans';";
  $sqldeleteItem = mysqli_query($conn,$deleteItem);
  //SET ITEM TO BE NOT IN PENDING ORDERS
  $deleteItem = "UPDATE inventory SET in_pending=0 WHERE item_ID='$deleteItemID';";
  $sqldeleteItem = mysqli_query($conn,$deleteItem);
  if ($sqldeleteItem) {
    //echo "Update in supplier transactions Success </br>";
  } else {
    echo mysqli_error($conn);
  } 
}



// IF delivered BUTTON IS SET FOR EACH TRANSACTION
if(isset($_POST['deliver'])){ 
  $transID=$_POST['transaction'];
  //INSERT ALERT HERE: SUMTH LIKE 'HAVE YOU CHECKED ALL ITEMS?'
  if(!empty($_POST['check_list'])){ 
  //GET ALL ITEMS IN GIVEN TRANSACTION ID
  $getitems = "SELECT * FROM transaction_Items WHERE transaction_ID = '$transID';";
  $resultItems = mysqli_query($conn,$getitems);
  $resultCheckItems = mysqli_num_rows($resultItems);
  if ($resultCheckItems>0){
    while ($rowitems = mysqli_fetch_assoc($resultItems)) {
      $transItem = $rowitems["item_ID"];

      //CHECKLIST OF DELIVERED ITEMS 
               
        if (!in_array($transItem, $_POST['check_list'])) {
          //echo $transItem." not checked";
          //REMOVE UNCHECKED ITEM FROM TRANSACTION
          $unchecked = "DELETE FROM transaction_Items WHERE item_ID='$transItem' AND transaction_ID = '$transID';";
          $sqlunchecked = mysqli_query($conn,$unchecked);
          //SET ITEM TO BE NOT IN PENDING
          $unchecked = "UPDATE inventory SET in_pending=0 WHERE item_ID='$transItem';";
          $sqlunchecked = mysqli_query($conn,$unchecked);
           //echo ($transItem." not in array");
          continue;
         
        }// END OF CHECKLIST
       
      $transQuant = $rowitems["transactionItems_Quantity"];
      $CostTrans =$rowitems["transactionItems_CostPrice"];
      //UPDATING ITEMS IN INVENTORY
      $inventoryItem = "SELECT * FROM inventory WHERE item_ID = '$transItem'";
      $resultInventory = mysqli_query($conn,$inventoryItem);
      $resultCheckInventory = mysqli_num_rows($resultInventory);
      if($resultCheckInventory>0){
        while ($rowinventory = mysqli_fetch_assoc($resultInventory)) {
          // SETTING OF NEW PRICE BASED ON NEW COSTPRICE
          $currentPrice = $rowinventory['item_RetailPrice'];
          //$newPrice = $CostTrans+($CostTrans*$rowinventory['Item_markup']/100);
          $newPrice = $CostTrans*$rowinventory['Item_markup'];
          if($currentPrice> $newPrice){
            $newPrice = $currentPrice;
          } 
        } // END OF SETTING NEW PRICE
        // IF ITEM IS ALREADY IN INVENTORY
        $updateStatus = "UPDATE inventory SET in_pending=0, inventoryItem_Status=1, item_Stock = item_Stock + '$transQuant', item_RetailPrice = '$newPrice'   WHERE item_ID = '$transItem';";
        $sqlUpdate = mysqli_query($conn,$updateStatus);
        if ($sqlUpdate) {
         // echo "Update in inventory success <br/>";
        } else {
          echo mysqli_error($conn);
        } //END OF ITEM IS ALREADY IN INVENTORY

      } else {  //ELSE, INSERT NEW ITEM IN INVENTORY
        $markup = $_SESSION['addInventory_markup']; //to be edited, insert modal here for item cetegory and markup
        $newPrice = $CostTrans*$markup;
        $insert = "INSERT INTO inventory(branch_ID, item_ID, item_Stock, item_RetailPrice, Item_markup, in_pending, inventoryItem_Status)
        VALUES (1, '$transItem', '$transQuant', '$newPrice', $markup, 0, 1);";
        $sqlInsert = mysqli_query($conn, $insert);
      } //END OF INSERTING NEW ITEM  
    } //END OF RESULTITEMS WHILE LOOP
  }//END OF GETTING ALL ITEMS
        
  //UPDATE TRANSACTION_STATUS TO 2 (DELIVERED ALREADY)
  $updateStatusTrans = "UPDATE supplier_transactions SET transaction_Status=2, transaction_TotalPrice = (SELECT SUM(transactionItems_TotalPrice) FROM transaction_items WHERE transaction_ID = '$transID' ) WHERE transaction_ID = '$transID';";
  $sqlUpdateTrans = mysqli_query($conn,$updateStatusTrans);
  if ($sqlUpdateTrans) {
    //echo "Update in supplier transactions Success </br>";  
  } else {
    echo mysqli_error($conn);
  } //END OF UPDATING TRANSACTION STATUS
} else {//END OF CHECKLIST NOT EMPTY 
  //INSERT ALERT HERE: SUMTH LIKE 'NO ITEMS ARE CHECKED. CHECK OR CANCEL THE DELIVERY'
  //echo "<script>alert('No items are checked'); </script>";
  $empty = true;
}
}// END OF DELIVER BUTTON SET

// CANCEL BUTTON IN TO BE DELIVERED
if(isset($_POST['cancel'])){
  $transID=$_POST['transaction'];
  $getitems = "SELECT * FROM transaction_Items INNER JOIN inventory ON (transaction_Items.item_ID = inventory.item_ID) WHERE transaction_ID = '$transID';";
  $resultItems = mysqli_query($conn,$getitems);
  $resultCheckItems = mysqli_num_rows($resultItems);
  if ($resultCheckItems>0){
    while ($rowitems = mysqli_fetch_assoc($resultItems)) {
      $cancelItem = $rowitems['item_ID'];
      $updatePending = "UPDATE inventory SET in_pending=0 WHERE item_ID='$cancelItem';";
      $sqlUpdatePending = mysqli_query($conn,$updatePending);
    }
  }
  $updatePending = "DELETE FROM transaction_Items WHERE transaction_ID = '$transID';";
  $sqlUpdatePending = mysqli_query($conn,$updatePending);
  $updatePending = "DELETE FROM supplier_Transactions WHERE transaction_ID = '$transID';";
  $sqlUpdatePending = mysqli_query($conn,$updatePending);


}

?>

<!DOCTYPE html>
<html>
<head>
<title> Pending </title>
    <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
    <script type="text/javascript" src="inventory.js"></script>
    <!--<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>-->
    <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
    
    <!-- JQUERY/BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

    <!-- CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  
	

  <style>
    .panel-heading .colpsible-panel:after {
        
        font-family: 'Glyphicons Halflings'; 
        content: "\e114";    
        float: right;        
        color: #408080;         
    }
    .panel-heading .colpsible-panel.collapsed:after {
        content: "\e080"; 
    }
  </style>
</head>
<body >
    <main >
    <?php include 'navbar.php'; ?>
    

      <!-- EMPTY MODAL ############################################################################ -->
       <div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog panel-danger" style="top:25%; width:25%;">
          <div class="modal-content ">
            <div class="modal-header ">
              <h5 class="modal-title" id="confirmDeleteLabel">No Items are Checked.</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- MODAL-HEADER -->
            
            <form id="deleteform" action="search_sort.php" method="post" class="form-inline" > 
              <div class="modal-body mb-2">   
                <input type="hidden"  id="deleteID" name="deleteID" placeholder="Enter"> 
                  <label >Please make sure you have checked all items that are delivered. If you want to cancel this delivery, click on the delete button. </label>          <br/>         
              </div> <!-- MODAL-BODY -->
            </form>  
          </div> <!-- MODAL-CONTENT -->
        </div> <!-- MODAL-DIALOG -->
      </div> <!-- MODAL-FADE-->
      <!-- EMPTY MODAL ############################################################################ -->
  
    <!-- END OF NAV BAR --> 

    <div class="container-fluid bg-light p-5 pt-2">
      <br>
    <p class="fs-1 fw-bold mb-3"> PENDING ORDERS</p>

    <!-- TO BE PURCHASED CARD -->
    <div class="card" style="width: 49%; min-height:70%; float:left;">
      <div class="card-header bg-dark text-white">
        <h3 class="card-title">To be Purchased</h3>
      </div>
      <div class="card-body">
        <!--<p class="card-text">Items that are not yet ordered from suppliers.</p>-->
        <?php //SHOW PENDING TRANSACTIONS
          $sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status =0 ;";   
          $result = mysqli_query($conn,$sql);
          $resultCheck = mysqli_num_rows($result); ?>

          <!-- PANELS -->
          <div class = "container" style="width: 100%; height:600px;">
          <div class='table-wrapper' style="height:590px;">
              <?php 
                if ($resultCheck>0){
                  while ($row = mysqli_fetch_assoc($result)) {
                    $n++;
                    $ID = $row['transaction_ID'];  
                    $supplier = $row['supplier_ID'];
                    $supplierName = $row['supplier_Name'];
                    $transacDate = $row['transaction_Date'];   
                    $total = $row['transaction_TotalPrice'];                
                     ?>
                    <!-- PANEL HEADING -->
                    <section class="accordion">
                        <input type="checkbox" name="collapse" id="collapse<?php echo $n?>" >
                        <h2 class="handle">
                            <label for="collapse<?php echo $n?>"> <?php echo "Transaction ID: ".$ID; ?> 
                            
                            <div style="float:right; width:25%; min-width:130px;">
                              <!-- EXPORT BUTTON -->
                              <form action="export.php" method="post">
                                  <input type=hidden name=ExportTransactionID value=<?php echo $ID?>>
                                  <input type=hidden name=ExportTransactionSupp value=<?php echo $supplier?>>
                                  <button class="btn" name="export" type="submit" style="float:right;"><i class='fas fa-download'></i></button>
                              </form>
                              <!--ORDER BUTTON-->
                              <form action="pending.php" class="mb-1" method="post">
                                  <input type=hidden name=transaction value=<?php echo $ID?>>
                                  <button onclick='return checkdelete()' class="btn " name="cancel" type="submit" style="float:right;" ><i class='fas fa-times'></i></button>
                                  <button onclick='return check()' class="btn " name="order" type="submit" style="float:right;"><i class='fas fa-check'></i></button>
                              </form>
                            
                            </div>
                            &emsp; &emsp;  Supplier: <?php echo $supplierName; ?>
                            </br> <span style="padding-left:27px; font-weight: 100;" id=transTotal<?php echo $ID;?> >Total: <?php echo $total;?></span>
                            
                            </label>  
                      </h2>
                     
                      
                    
                    <div class="content">
                         <?php 
                        
                          echo "<table class='table'> 
                                  <tr> 
                                    <th> ID </th>
                                    <th> Item </th>
                                    <th> Brand </th>
                                    <th> unit </th>
                                    <th> Quantity </th>
                                    <th> Unit Price </th>
                                    <th> Total Price </th>
                                    <th> </th>
                                  </tr>";

                          //SHOW ITEMS IN THE TRANSACTION
                          $sql1 = "SELECT * FROM transaction_Items INNER JOIN item ON (transaction_Items.item_ID = item.item_ID) WHERE transaction_ID = '$ID' ;";   
                          $result1 = mysqli_query($conn,$sql1);
                          $resultCheck1 = mysqli_num_rows($result1);
                          
                          if ($resultCheck1>0){
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                              $item = $row1['item_ID'];
                              echo '<form action="pending.php" class="mb-1" method="post">';
                              echo "  <tr>"; 
                              echo "    <td>" .$row1['item_ID']. "</td>";  
                              echo "    <td>". $row1['item_Name']. "</td>";  
                              echo "    <td>" .$row1['item_Brand']. "</td>";  
                              echo "    <td>" . $row1['item_unit'] . "</td>";  

                              echo "    <td><input type=number name=quant id=quant" .$ID .$item  ." value=" . $row1['transactionItems_Quantity']. " style='width:50px;' onchange='notif(".$ID ."," .$item ."," .$total .")'></td>"; 
                              echo "    <td>" .$row1['transactionItems_CostPrice']. "</td>";
                              echo "    <td id=total".$ID .$item .">" .$row1['transactionItems_TotalPrice']. "</td>";   ?>
                                        <td>
                                          <!-- REMOVE AND EDIT BUTTON-->
                                          <input type=hidden name=itemID id= itemID value=<?php echo $item?>>
                                          <input type=hidden name=itemCost id= itemCost<?php echo $ID.$item?> value=<?php echo $row1['transactionItems_CostPrice']?>>
                                          <input type=hidden name=transID id=transID value=<?php echo $ID?>>
                                          <button onclick='checkItem()' class="btn" name="delete" type="submit" ><i class='fas fa-trash'></i></button>
                                          <!--
                                          <button class="btn-primary" name="edit" type="submit" >Edit</button> -->                    
                                        </td>      
                                      </tr>
                                    </form> <?php
                            } // END OF RESULT1 WHILE LOOP
                          } //END OF RESULTCHECK1
                          echo "</table>";
                          echo "<a style='color:cadetblue;' href='../supplier/suppliertable.php?supplier_ID=".$supplier."'>Add Items</a>";?>
              
                      </div> <!-- END OF CONTENT -->
                    </section>
                  <?php
                  } 
                }?>  
              </div> <!-- END TABLE-WRAPPER -->
          </div><!-- END CONTAINER -->
      </div> <!-- END CARD BODY -->  
    </div> <!-- END CARD -->

    

  <!-------------DELIVERED CARD --------------->
  <div class="card" style="width: 49%;min-height:70%; float:right;">
    <div class="card-header bg-dark text-white">
      <h3 class="card-title">For Delivery</h3>
    </div>
    <div class="card-body">
      <?php
        $sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status =1 ;";   
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); ?>
      <div class = "container" style="width: 100%; height: 600px;">
      <div class='table-wrapper' style="height:590px;">
          <?php 
            if ($resultCheck>0){
              while ($row = mysqli_fetch_assoc($result)) {
                $k++;
                $ID = $row['transaction_ID'];  
                $supplier = $row['supplier_ID'];
                $supplierName = $row['supplier_Name'];
                $transacDate = $row['transaction_Date'];   
                $total = $row['transaction_TotalPrice'];
                ?>

                <form action="pending.php" class="mb-1" method="post">
                  <section class="accordion" id=<?php echo $ID?>>
                        <input type="checkbox" name="collapse" id="#collapseDeli<?php echo $k?>" >
                        <h2 class="handle">
                            <label for="#collapseDeli<?php echo $k?>"> <?php echo "Transaction ID: ".$ID; ?> 
                            <div style="float:right; width:15%; min-width:80px;">
                            <!--DELIVERED BUTTON-->
                            <input type=hidden name=transaction value=<?php echo $ID?>>
                            <button  onclick='return checkdelete2()' class="btn" name="cancel" type="submit" style="float:right;"><i class='fas fa-times'></i></button>
                            <button  onclick='return check2()'class="btn " name="deliver" type="submit" style="float:right;"><i class='fas fa-check'></i></button>
                            
                            </div>
                            &emsp; &emsp; &emsp; &emsp; Supplier: <?php echo $supplierName; ?>
                            </br> <span style="padding-left:27px; font-weight: 100;">Date: <?php echo $transacDate; ?></span>
                &nbsp; &nbsp; &nbsp; <span id=transTotal<?php echo $ID;?> >Total: <?php echo $total;?></span>


                            </label>
                        </h2>
                    
                    <div class="content">
                    <?php 
                      
                        echo "<table class='table' style='width:100%;'> 
                                <tr> 
                                  <th> ID </th>
                                  <th> Item </th>
                                  <th> Brand </th>
                                  <th> unit </th>
                                  <th> Quantity </th>
                                  <th> Unit Price </th>
                                  <th> Total Price </th>
                                  <th class='font-weight-light' style=' font-weight:normal;'>delivered <br/><input type='checkbox' onClick='toggle(this)' /> <span class='text-muted' style='font-size:10px; font-weight:normal; padding:0px;'>Select All</span> </th>
                                </tr>";
                        //SHOW ITEMS IN TRANSACTIONS
                        $sql1 = "SELECT * FROM transaction_Items INNER JOIN item ON (transaction_Items.item_ID = item.item_ID) WHERE transaction_ID = '$ID' ;";   
                        $result1 = mysqli_query($conn,$sql1);
                        $resultCheck1 = mysqli_num_rows($result1);

                        if ($resultCheck1>0){
                          while ($row1 = mysqli_fetch_assoc($result1)) {
                            $item = $row1['item_ID'];
                            echo "<tr>"; 
                            echo "<td>" .$row1['item_ID']. "</td>";  
                            echo "<td>". $row1['item_Name']. "</td>";  
                            echo "<td>" .$row1['item_Brand']. "</td>";  
                            echo "<td>" . $row1['item_unit'] . "</td>";  
                            echo "<td><input type=number name=deliQuant  id=deliQuant".$ID .$item  ." value=" . $row1['transactionItems_Quantity']. " style='width:50px;' onchange='notif1(".$ID. ",".$item.")'></td>"; 
                            echo "<td><input type=number name=deliCost id=deliCost".$ID .$item  ."  value=" .$row1['transactionItems_CostPrice']. " style='width:50px;' onchange='notif1(".$ID. ",".$item.")'></td>";
                            echo "<td id=total".$ID .$item  ." > " .$row1['transactionItems_TotalPrice']. "</td>";   ?>
                            <td>
                              <input type=hidden name=deliItemID id=deliItemID value=<?php echo $item?>>
                              <input type=hidden name=deliTransID id=deliTransID value=<?php echo $ID?>>
                              <!--<button class="btn-primary" name="editDeli" type="submit" >Edit</button> </td><td>  EDIT BUTTON -->
                              <input type="checkbox" name="check_list[]" value="<?php echo $row1['item_ID']?>"> <!-- CHECKLIST -->
                            </td>    
                          </tr><?php
                          }
                        } 
                      echo "</table>";?>
                      </form>
                    </div>
                    </section>
                <?php
                  } 
                }?>  
            </div> <!-- END TABLE-WRAPPER -->
          </div><!-- END CONTAINER -->
      </div> <!-- END CARD BODY -->  
    </div> <!-- END CARD -->
  </div> <!-- END CONTENT -->
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script language="JavaScript">
  function edit(){
    alert("hi");
  }
  function toggle(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }

 
  function checkdelete(){
      return confirm('Are you sure you want to delete this transaction?');
  }

  function check(){
      return confirm('Are you sure you want to proceed with this transaction?');
  }

  function checkItem(){
      return confirm('Are you sure you want to delete this item?');
  }

  function checkdelete2(){
      return confirm('Are you sure you want to delete this transaction?');
  }

  function check2(){
      return confirm('Have you check all items delivered?');
  }

 
</script>

</body>
</html>

<?php
 
 if ($empty==true) {
   echo "<script>$(document).ready(function(){
     $('#confirmDelete').modal('show'); });</script>";
 }
?>