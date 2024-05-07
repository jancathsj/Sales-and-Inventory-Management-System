<?php
    error_reporting(0);
    include_once '../../env/conn.php';
    
    // DELETE ITEM FROM SUPPLIER ITEM
    if (isset($_POST['delete1'])) {
        echo "delete clicked";
        $itemID = $_POST['itemID1'];
        $supplierID = $_POST['supplierID1'];
        $deleteItem = "delete from supplier_item where item_ID= ".$itemID." and supplier_ID=".$supplierID.";";
        $sqlDelete = mysqli_query($conn,$deleteItem);
        if ($sqlDelete) {
          echo "deleted";
        } else {
          echo mysqli_error($conn);
        }
        header("Location: ./supplieritem.php");
        unset($_SESSION['delete1']);
    }
    // EDIT AN ITEM FROM SUPPLIER ITEM
    if(isset($_POST['edit'])){

        $_SESSION['itemID'] = $_POST['edititemID'];
        $_SESSION['supplierID'] = $_POST['editsupplierID'];

        header("Location: ./editsupplieranditem.php");
        unset($_POST['edit']);
    }





    // SQL QUERIES ==========================================================================================
    // FROM SEARCH TAB

    if (isset($_POST['search']) && !isset($_POST['selected']) && !isset($_POST['stats'])) {
        $Name = $_POST['search'];

        if ($Name!="") {    
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%'); ";
        } else {
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY item.item_ID;";  
        }
    // FROM SORT
    } else if (isset($_POST['selected']) && !isset($_POST['search']) && !isset($_POST['stats'])) {
        $k = $_POST['selected'];
        $_SESSION['option'] = $_POST['selected'];
        
        if ($k == "PriceAsc") {
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY supplier_item.supplierItem_CostPrice ASC;";
        } else if ($k == "PriceDesc") {
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY supplier_item.supplierItem_CostPrice DESC;"; 
        } else if ($k == "ItemID"){
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY item.item_ID ;";
        } else if ($k == "SupplierID"){
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY supplier.supplier_ID ;";
        } else {
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ORDER BY item.item_ID ;";
        }

        
    }else if(isset($_POST['stats']) && !isset($_POST['search']) && !isset($_POST['selected'])){
        if($_POST['stats']=="all"){
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) ;";
            
        }else if($_POST['stats']=="inactive"){
            $status = 0;
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) where supplier_Status = ".$status.";";
        }else{
            $status = 1;
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) where supplier_Status = ".$status.";";
            
        }
        
    }
    else if (isset($_POST['selected']) && isset($_POST['search']) && isset($_POST['stats'])) {
        $Name = $_POST['search'];
        $k = $_POST['selected'];
        $_SESSION['option'] = $_POST['selected'];

        if($_POST['stats']=="inactive" || $_POST['stats']=="active"){
            if($_POST['stats']=="inactive"){
                $status = 0;
            }else if($_POST['stats']=="active"){
                $status = 1;
            }
        }
        
        if ($k == "PriceAsc") {
            if($_POST['stats']=="all"){
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') ORDER BY supplier_item.supplierItem_CostPrice ASC;";
            }else{
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') AND supplier_Status = ".$status." ORDER BY supplier_item.supplierItem_CostPrice ASC;";
            }


            
        } else if ($k == "PriceDesc") {
            if($_POST['stats']=="all"){
               $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') ORDER BY supplier_item.supplierItem_CostPrice DESC;"; 
            }else{
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') AND supplier_Status = ".$status." ORDER BY supplier_item.supplierItem_CostPrice DESC;"; 
            }

        } else if ($k == "ItemID"){
            if($_POST['stats']=="all"){
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') ORDER BY item.item_ID ;";
            }else{
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') AND supplier_Status = ".$status." ORDER BY item.item_ID ;";
            }
        } else if ($k == "SupplierID"){
            if($_POST['stats']=="all"){
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') ORDER BY supplier.supplier_ID ;";
            }else{
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') AND supplier_Status = ".$status." ORDER BY supplier.supplier_ID ;";
            }
        } else {
            if($_POST['stats']=="all"){
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%')  ORDER BY item.item_ID ;";
            }else{
                $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) WHERE (item_Name LIKE '%$Name%' OR item_Brand LIKE '%$Name%' OR supplier_Name LIKE '%$Name%') AND supplier_Status = ".$status." ORDER BY item.item_ID ;";
            }
        }

    }   // DEFAULT: BY ID
    else {
            $status = 1;
            $sql = "SELECT * FROM supplier_item INNER JOIN item ON (item.item_ID = supplier_item.item_ID) INNER JOIN supplier ON (supplier_item.supplier_ID = supplier.supplier_ID) AND supplier_Status = ".$status." ORDER BY item.item_ID ;"; 
    }  

    
    // END OF SQL QUERIES ==========================================================================================
    
    // SHOW RESULT OF QUERY
    $result = mysqli_query($conn,$sql) or die($conn->error);
    $resultCheck = mysqli_num_rows($result);
        
    echo "<html><div class='table-wrapper' style=\"overflow-y:scroll; height: 450px\"><table class='table table-hover'> 
           <thead> 
            <tr>
                <th> Item ID </th>
                <th> Item </th>
                <th> Unit </th>
                <th> Brand </th>
                <th> Category </th>
                <th> Supplier ID </th>
                <th> Supplier </th>
                <th> Supplier Status </th>
                <th> Cost Price </th>
                ";

            echo "<th> </th>
                    <th> </th>
                    </tr>
                    </thead>
                     <tbody>";
            
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {

                echo "<td>" .$row['item_ID']. "</td>";  
                echo "<td>". $row['item_Name']. "</td>";
                echo "<td>" . $row['item_unit'] . "</td>";  
                echo "<td>" . $row['item_Brand'] . "</td>"; 
                echo "<td>" . $row['item_Category'] . "</td>";  
                echo "<td>" . $row['supplier_ID']. "</td>"; 
                echo "<td>" . $row['supplier_Name']. "</td>";
                if($row['supplier_Status']==1){
                    $status="Active";
                }else{
                    $status="Inactive";
                }
                echo "<td>" .$status. "</td>"; 
                echo "<td>" .$row['supplierItem_CostPrice']. "</td>"; 

                ?>
                <!--DELETE AND EDIT BUTTON-->
                <td style="width:100px;"> <button type="button" class="btn editbtn" style="float:left;"> <i class='fas fa-edit'></i> </button>
                    <form action="search_sort_item.php" class="mb-1" method="post">
                        <button class="btn" onclick='return checkdelete()' name="delete1" type="submit" style="float:right; padding-left:0px;"><i class='fas fa-trash'></i></button>
                        <input type=hidden name=itemID1 value=<?php echo $row['item_ID']?>>
                        <input type=hidden name=supplierID1 value=<?php echo $row['supplier_ID']?>>
                        
                    </form>
                </td>
                <td>
                    <form action="supplieritem.php" class="mb-1" method="post">
                        <input type=hidden name=orderItemID value=<?php echo $row['item_ID']?>>
                        <input type=hidden name=orderItemSupp value=<?php echo $row['supplier_ID']?>>
                        <!--<a href="../inventory/addinventory.php"> <button class="btn-primary" name="order" type="submit">Order</button></a>-->
                        <?php
                            if($row['supplier_Status']==1){
                                echo "<button type=\"button\" class=\"btn btn-success buybtn p-2\" style=\"float:left;\"><i class=\"fa fa-shopping-cart\"></i> Buy</i></button>";
                            }else{
                                echo "<button type=\"button\" class=\"btn btn-secondary p-2\" style=\"float:left;\"><i class=\"fa fa-shopping-cart\"></i> Buy</i></button>";
                            }
                        ?>
                        
                    </form>
                </td>    
            </tr>
            
        <?php  
        } // END OF WHILE
    } // END OF RESULTCHECK
    echo "</tbody></table></div>";
?>

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

            function checkdelete(){
                return confirm('Are you sure you want to delete this record?');
            }

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
         </script></html>
