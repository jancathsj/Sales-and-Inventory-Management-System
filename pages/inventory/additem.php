<!-- ADD ITEM QUERY ############################################################################ -->
    <?php
            $db = mysqli_connect("localhost","root","","Hardware");
            if(!$db)
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_POST['submit']) || isset($_POST['Submit']))
            {		
                
                $item_Name= $_POST['item_Name'];
                $item_unit= $_POST['item_unit'];
                $item_Brand= $_POST['item_Brand'];
                $item_Category= $_POST['item_Category'];

                $supplierItem_CostPrice= $_POST['supplierItem_CostPrice'];

            
                $insert = mysqli_query($db,"INSERT INTO item ". "(item_Name, item_unit, item_Brand, item_Category) ". "
                        VALUES('$item_Name', '$item_unit', '$item_Brand', '$item_Category')");


                $item_ID = $db->insert_id;

                if($_POST['supplier_ID']=="other"){

                    $supplier_Name= $_POST['supplier_Name'];
                    $supplier_ContactPerson = $_POST['supplier_ContactPerson'];
                    $supplier_ContactNum= $_POST['supplier_ContactNum'];
                    $supplier_Address= $_POST['supplier_Address'];

                    $insert = mysqli_query($db,"INSERT INTO supplier ". "(supplier_Name, supplier_ContactPerson, supplier_ContactNum, supplier_Address) ". "VALUES('$supplier_Name', '$supplier_ContactPerson', '$supplier_ContactNum', '$supplier_Address')");
                    $supplier_ID = $db->insert_id;

                }else{
                    $supplier_ID = $_POST['supplier_ID'];
                }

                $insert = mysqli_query($db,"INSERT INTO supplier_item". "(supplier_ID, item_ID, supplierItem_CostPrice)"."VALUES('$supplier_ID', '$item_ID', '$supplierItem_CostPrice')");
                        

            }
            header( "Location: ./items.php?");

    ?>  <!-- ADD ITEM QUERY ############################################################################ -->

