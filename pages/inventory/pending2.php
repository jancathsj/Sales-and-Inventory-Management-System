<?php

include_once '../../env/conn.php';

//EDIT BUTTON IN PENDING ORDERS
//if (isset($_POST['edit'])) {
    if(isset($_POST['changeQuantity'])){
        //$quantity = $_POST['quant'];
        $quantity = $_POST['changeQuantity'];
        $updateItemID=$_POST['itemID'];
        $updateitemTrans = $_POST['transID'];
        $cost = $_POST['cost'];
        $total =$quantity*$cost;
        //EDIT ITEM QUANTITY
        $updateItem = "UPDATE transaction_Items SET transactionItems_Quantity = '$quantity', transactionItems_TotalPrice = '$total' WHERE item_ID = '$updateItemID' AND transaction_ID = '$updateitemTrans';";
        $sqlupdateItem = mysqli_query($conn,$updateItem);
      
        $result = mysqli_query($conn, "SELECT SUM(transactionItems_TotalPrice) AS transTotal FROM transaction_items WHERE transaction_ID = '$updateitemTrans'");
        $row = mysqli_fetch_array($result);
        $totalPrice = $row['transTotal'];

        //UPDATE TRANSACTION TOTAL PRICE
        $updateItem = "UPDATE supplier_transactions SET transaction_TotalPrice = '$totalPrice' WHERE transaction_ID = '$updateitemTrans';";
        $sqlupdateItem = mysqli_query($conn,$updateItem);
      
        if ($sqlupdateItem) {
          echo "Total: " .$totalPrice;
        } else {
          echo mysqli_error($conn);
        } 
      }

      //EDIT BUTTON IN TO BE DELIVERED
//if (isset($_POST['editDeli'])) {
  if (isset($_POST['deliQuant'])){
    $deliQuantity = $_POST['deliQuant'];
    $deliUpdateItemID=$_POST['deliItemID'];
    $deliUpdateitemTrans = $_POST['deliTransID'];
    $deliCost = $_POST['deliCost'];
    $total = $deliQuantity*$deliCost;
    //UPDATE QUANTITY, COST PRICE AND TOTAL
    $updateItem = "UPDATE transaction_Items SET transactionItems_Quantity = '$deliQuantity', transactionItems_CostPrice = '$deliCost', transactionItems_TotalPrice = '$total'  WHERE item_ID = '$deliUpdateItemID' AND transaction_ID = '$deliUpdateitemTrans';";
    $sqlupdateItem = mysqli_query($conn,$updateItem);


    $result = mysqli_query($conn, "SELECT SUM(transactionItems_TotalPrice) AS transTotal FROM transaction_items WHERE transaction_ID = '$deliUpdateitemTrans'");
    $row = mysqli_fetch_array($result);
    $totalPrice = $row['transTotal'];

    //UPDATE TRANSACTION TOTAL PRICE
    $updateItem = "UPDATE supplier_transactions SET transaction_TotalPrice = '$totalPrice' WHERE transaction_ID = '$deliUpdateitemTrans';";
    $sqlupdateItem = mysqli_query($conn,$updateItem);
    if ($sqlupdateItem) {
        echo "Total: " .$totalPrice;
    } else {
      echo mysqli_error($conn);
    } 
}


?>