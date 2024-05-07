<?php
    error_reporting(0);
    include_once '../../env/conn.php';
    
    if (isset($_POST['selected'])) {
        //$k = $_POST['selected'];
        //$c = $_POST['categSort'];
        $Name = $_POST['search'];
        //$_SESSION['option'] = $_POST['selected'];
        
        /*if ($c!="All") {
            $addFilter = "AND item_Category = '$c' ";
        } else {
            $addFilter ="";
        }*/

        
        if ($Name!="") {    
            $addSearch = " AND (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR item_category LIKE '%$Name%') ";
        } else {
            $addSearch = "";
        }

        $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ;"; 
        /*if ($k == "PriceAsc") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY item_RetailPrice ASC;"; 
        } else if ($k == "PriceDesc") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY item_RetailPrice DESC;"; 
        } else if ($k == "item_Stock") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY $k ASC;"; 
        } else if ($k == "Category") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY  item_category,item_Name ASC;"; 
        } else if ($k == "ID"){
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY inventory.item_ID;"; 
        } else if ($k == "Salability"){
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY sales_sum DESC;"; 
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ;"; 
        }*/
    /* UNUSED===================
    // FROM CATEGORY  
    } else if (isset($_POST['category'])) {
        $category= $_POST['category'];
        if ($category=='All') {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 ";
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  item_category = '$category' AND  inventoryItem_Status = 1";
        } =======================*/
    // DEFAULT: BY ID    
    }  else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 ORDER BY inventory.item_ID;"; 
    }  

    // ON SALABILITY
    if (isset($_POST['category1'])) {
        $category= $_POST['category1'];
        $onSalability = true;
        if ($category=='All') {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY sales_sum DESC;";
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID) WHERE item_Category = '$category'  ORDER BY sales_sum DESC;";
        }
    } elseif (isset($_POST['search1'])) {
        $Name = $_POST['search1'];
        $onSalability = true;
        if ($Name!="") {    
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID) WHERE  (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR item_category LIKE '%$Name%'); ";
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY sales_sum DESC;"; 
        
        }
    } else if (isset($_POST['selected1'])) {
        $k = $_POST['selected1'];
        $onSalability = true;
        if ($k == "PriceAsc") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID) ORDER BY item_RetailPrice ASC;"; 
        } else if ($k == "PriceDesc") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY item_RetailPrice DESC;"; 
        } else if ($k == "item_Stock") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY $k ASC;"; 
        } else if ($k == "Category") {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY  item_category,item_Name ASC;"; 
        } else if ($k == "ID"){
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY inventory.item_ID;"; 
        } else if ($k == "Salability"){
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY sales_sum DESC;"; 
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY sales_sum DESC;"; 
        }
    }

    // END OF SQL QUERIES ==========================================================================================
    
    // SHOW RESULT OF QUERY
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    
    $i = 1; $counter = 0; $r = 1;
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['item_ID'];
            $name = $row['item_Name'];
            $price = $row['item_RetailPrice'];
            $unit = $row['item_unit'];
            $stocks = $row['item_Stock'];
?>
            <!-- item -->
            <div class="col">
                <form method="POST" action="order.php?action=addCart">
                <div class="row">
                    <div class="col-md-9 bg-dark text-light p-3">
                        <input type="hidden" name="itemAdd" value="<?php echo $id ?>" aria-describedby="button-addon2">
                        <p class="fw-bold text-start mb-1"> <?php echo $name; ?> </p>
                        <div class="row">
                            <div class="col-6 text-start"><?php echo $price.'/'.$unit; ?></div>
                            <div class="col-6 text-start">Stocks: <?php echo $stocks; ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 ps-0">
                        <button type="submit" class="btn btn-outline-success w-100 h-100 rounded-end">
                            <i class="bi bi-cart"></i>
                        </button>
                    </div>
                </div> 
                </form>
            </div>
<?php
            $i++;

            if ($r == 5) {
                $r = 1;
            }
            if (++$counter == $resultCheck) {
                while ($r != 5){
                    while ($i != 3) {
                        echo '<div class="col">
                        <form method="" action="">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="hidden" value="" aria-describedby="button-addon2">
                                <p class="fw-bold text-start mb-1"></p>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6"></div>
                                </div>
                            </div>
                            <div class="col-md-3 ps-0">
                               
                            </div>
                        </div> 
                        </form>
                        </div>';
    
                        $i++;
                    }
                    echo "<div class='w-100'></div>";
                    $i = 1;
                    $r++;

                }
            } else if ($i == 3) {
                echo "<div class='w-100'></div>";
                $i = 1;
                $r++;
            }
        }
    }
?>
