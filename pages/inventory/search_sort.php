<?php
    error_reporting(0);
    include_once '../../env/conn.php';
   
    
    // DELETE ITEM FROM INVENTORY
    if (isset($_POST['delete2'])) {
        //echo "delete clicked";
        $url = $_POST['url'];
        $itemID = $_POST['deleteID'];
        $deleteItem = "UPDATE inventory SET inventoryItem_Status = 0 WHERE branch_ID =1 AND item_ID = '$itemID';";
        $sqlDelete = mysqli_query($conn,$deleteItem);
        if ($sqlDelete) {
          echo "deleted";
        } else {
          echo mysqli_error($conn);
        }
        if ($url=="salability.php") {
            header("Location: ./salability.php");
        } else {
            header("Location: ./inventory.php");
        }
        
        unset($_SESSION['delete2']);
    }
    // EDIT AN ITEM FROM INVENTORY ===== THIS FUNCTION IS IN INVENTORY.PHP =================================
    if(isset($_POST['edit'])){
        $_SESSION['itemID'] = $_POST['itemID'];
        header("Location: ./editinventory.php");
        unset($_POST['edit']);
    }
    // SQL QUERIES ==========================================================================================
    /*=========== UNUSED
    // FROM SEARCH TAB
    if (isset($_POST['search'])) {
        $Name = $_POST['search'];
        $sort = $_POST['sort'];
        if ($Name!="") {    
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 AND (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR item_category LIKE '%$Name%'); ";
        } else {
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1;"; 
        }============


    // FROM SORT
    } else if (isset($_POST['selected'])) {*/
        
    if (isset($_POST['selected'])) {
        $k = $_POST['selected'];
        $c = $_POST['categSort'];
        $Name = $_POST['search'];
        $_SESSION['option'] = $_POST['selected'];
        
        if ($c!="All") {
            $addFilter = "AND item_Category = '$c' ";
        } else {
            $addFilter ="";
        }

        
        if ($Name!="") {    
            $addSearch = " AND (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR item_category LIKE '%$Name%') ";
        } else {
            $addSearch = "";
        }

        if ($k == "PriceAsc") {
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
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 " .$addFilter .$addSearch ." ORDER BY item_Stock ASC;"; 
        }
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
            $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 ORDER BY item_Stock;"; 
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
    //LOW ON STOCK -- not yet working
    if (isset($_POST['stock'])) {
        $sql = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) INNER JOIN (SELECT SUM(orderItems_Quantity) as sales_sum, item_ID as order_itemID FROM order_items GROUP BY item_ID) as orders ON (inventory.item_ID = orders.order_itemID)  ORDER BY sales_sum DESC;";
    }

    // END OF SQL QUERIES ==========================================================================================
    
    // SHOW RESULT OF QUERY
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
        
    echo "<div class='table-wrapper'><table class='table table-hover'> 
           <thead> 
            <tr>
                <th> ID </th>
                <th> Item </th>
                
                <th> Unit </th>
                <th> Brand </th>
                <th> Retail Price </th>
                <th> Markup </th>
                <th> Stock </th>
                <th> Category </th>
                ";
                if ($onSalability==true){
                    echo "<th> Sales</th>"; 
                }  
            echo "<td class='text-muted'> Last Transaction </td>
                <th> </th>
                    </tr>
                    </thead>
                     <tbody>";
            
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {
            if ($onSalability==true && $row['inventoryItem_Status']==0) {
                    echo "<tr class = 'table-secondary'>";
                } elseif ($row['item_Stock']<=10){ //LOW ON STOCK ======================================
                echo "<tr class='table-danger'>";
                //ADDING IN PENDING ORDERS===================================================================
                //if ($row['in_pending']==0) {
                    $_SESSION['pending_ItemID'] = $row['item_ID'];
                    include 'addpending.php';
               // }   // END OF ADDING IN PENDING ORDERS =====================================================
                }
                else{   //NOT LOW ON STOCK =================================================
                    echo '<tr>';
                }   
                //last transaction with item
                $ctrItemID = $row['item_ID'];
                $lastDate = mysqli_query($conn, "SELECT * FROM supplier_transactions INNER JOIN transaction_Items ON (supplier_transactions.transaction_ID = transaction_Items.transaction_ID) WHERE transaction_Status =2 AND item_ID = '$ctrItemID' ORDER BY transaction_Items.transaction_ID DESC LIMIT 1");
                $rowDate = mysqli_fetch_array($lastDate);
                $date = $rowDate['transaction_Date'];
                if (mysqli_num_rows($lastDate)) {
                    $lastCost = $rowDate['transactionItems_CostPrice'];
                    
                } else {
                    $lastCost = $row['item_RetailPrice']/$row['Item_markup'];
                }
                

                echo "<td>" .$row['item_ID']. "</td>";  
                echo "<td>". $row['item_Name']. "</td>";  
                 
                echo "<td>" .$row['item_unit']. "</td>";  
                echo "<td>" . $row['item_Brand'] . "</td>";  
                echo "<td>" . $row['item_RetailPrice']. "</td>"; 
                echo "<td>" .$row['Item_markup']. "</td>";
                // echo "<td> <input type=number name=itemStock id='itemStock' min=1 value=" .$row['item_Stock']." style='width:70px;'/> </td>";  
                echo "<td>" .$row['item_Stock']. "</td>"; 
                echo "<td>" .$row['item_Category']. "</td>";   
                if ($onSalability == true){
                    echo "<td>" .$row['sales_sum']. "</td>"; 
                }
                echo "<td class='text-muted'>". $date. "</td>";  
                echo "<td hidden>" .$lastCost ."</td>";
                ?>
                <!--DELETE AND EDIT BUTTON-->
                <td>
                    <button type="button" class="btn editbtn p-0" style="float:left;">
                        <i class='fas fa-edit'></i>
                    </button>
                </td>
                <td>
                    <button class="btn delete1btn p-0" <?php if($onSalability==true && $row['inventoryItem_Status']==0){echo 'disabled';} ?>><i class='fas fa-trash'></i></button>
                </td>
                <!--<td>
                    <form action="search_sort.php" class="mb-1" method="post">
                        
                        <button onclick='return checkdelete()' class="btn p-0" name="delete1" type="submit" <?php //if($onSalability==true && $row['inventoryItem_Status']==0){echo 'disabled';} ?>><i class='fas fa-trash'></i></button> 
                        
                        <input type=hidden name=itemID1 value=<?php //echo $row['item_ID']?>>
                    </form>
                </td>-->
                <td>
                    <!--<button class='table-see' onclick="location.href='../supplier/supplieritem.php?item_Name='<?php //echo $row['item_Name']?>' ">Suppliers</button>-->
                    <!--<?php //echo "<a href=\"../supplier/supplieritem.php?item_Name='".$row['item_Name']."'\">"; ?>-->
                    <a href="../supplier/supplieritem.php?item_ID=<?php echo $row['item_ID']; ?>" >
                        <button class="btn p-0"  ><i class='fas fa-shopping-cart'></i></button>
                    </a>
                </td>   
                <td>
                    <form action="itemTransactions.php" class="mb-1" method="post">
                        <button class="btn p-0" name="more" type="submit" ><i style="font-size:15px" class="fa">&#xf0c9;</i></button>
                        <input type=hidden name=itemID1 value=<?php echo $row['item_ID']?>>
                        <input type=hidden name=itemIDName value='<?php echo $row['item_Name']?>'>
                    </form>
                </td> 
            </tr>
            
        <?php  
        } // END OF WHILE
    } // END OF RESULTCHECK
    
    echo "</tbody></table></div>";
    $onSalability == false;
?>




<script>
        function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
        }
</script>


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
                $('#editCost').val(data[9]);
                $('#editStock').val(data[6]);
                $('#editCategory').val(data[7]);
                const $select = document.querySelector('#item_Category');
                $select.value = data[7];
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
           

           function checkdelete(){
                return confirm('Are you sure you want to delete this record?');
            }
         </script>
