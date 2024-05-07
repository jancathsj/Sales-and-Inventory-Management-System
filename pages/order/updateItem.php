<?php
    include_once '../../env/conn.php';

    $id = $qty = $price = $total = $totalPrice = $recentID = "";
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case "update":
                //variables
                if(isset($_GET['itemID']) && isset($_POST['qty'])) {
                    $id = $_GET['itemID'];
                    $qty = $_POST['qty'];

                    $sqlSearch = "SELECT * FROM cart WHERE itemID='$id'";
                    $resSearch = mysqli_query($conn, $sqlSearch);
                    $countSearch = mysqli_num_rows($resSearch);

                    if ($countSearch >= 1){ //if there's match, update
                        $rowSearch = mysqli_fetch_assoc($resSearch);
                        $price = $rowSearch['itemPrice'];

                        $total = $qty * $price;
                        $sqlUpdate = "UPDATE cart SET quantity='$qty', itemTotalP='$total' WHERE itemID='$id'";
                        $resUpdate = mysqli_query($conn, $sqlUpdate);
                        
                        if($resUpdate) {
                            header("location: order.php?update=q");
                        }
                    }
                }
                break;
            case "total":
                $sqlSum = "SELECT SUM(itemTotalP) AS totalPrice FROM cart";
                $resSum = mysqli_query($conn, $sqlSum);
                $countSum = mysqli_num_rows($resSum);
        
                if($countSum >= 1) {
                    $rowSum = mysqli_fetch_assoc($resSum);
                    $totalPrice = $rowSum['totalPrice'];
        
                    echo $totalPrice;
                }
    
                break;
            case "order":
                    $date = date('Y-m-d H:i:s');
                    $totalPrice = $_POST['total'];
                    
                    //insert into orders
                    $sqlOrder = "INSERT INTO orders (order_Date, order_Total)
                                VALUES ('$date','$totalPrice')";
                    $resOrder = mysqli_query($conn, $sqlOrder); 

                    //if isnerted
                    if ($resOrder){
                         //get recent id
                        $sqlID = "SELECT order_ID AS id FROM orders WHERE order_ID = @@Identity";
                        $resID = mysqli_query($conn, $sqlID);
                        $rowID = mysqli_fetch_assoc($resID);
                        $recentID = $rowID['id'];

                        //retrieve items from cart
                        $sqlItems = "SELECT * FROM cart c
                                INNER JOIN inventory i ON (c.itemID = i.item_ID)";
                        $resItems = mysqli_query($conn, $sqlItems);

                        //transfer items from cart to order_items
                        while($rowItems = mysqli_fetch_assoc($resItems)) {
                            $id = $rowItems['itemID'];
                            $qty = $rowItems['quantity'];
                            $itemTotal = $rowItems['itemTotalP'];
  
                            //store to order_items
                            $sqlOrderItems = "INSERT INTO order_items (item_ID, order_ID, orderItems_Quantity, orderItems_TotalPrice)
                            VALUES ('$id','$recentID', '$qty', '$itemTotal')";
                            $resOrderItems = mysqli_query($conn, $sqlOrderItems);

                            $stock = $rowItems['item_Stock'] - $qty;
                            $sqlStock = "UPDATE inventory SET item_Stock = '$stock' WHERE item_ID = '$id'";
                            $resStock = mysqli_query($conn, $sqlStock);
                        }
                        
                        $sqlEmpty = "TRUNCATE TABLE cart";
                        if(mysqli_query($conn, $sqlEmpty)) {
                            header("location: order.php?update=a");
                        }
                    }
                

                break;
            case "delete":
                $sqlEmpty = "TRUNCATE TABLE cart";
                if(mysqli_query($conn, $sqlEmpty)) {
                    header("location: order.php");
                }
        }
    }
?>