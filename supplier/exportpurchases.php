<?php 
    include_once '../../env/conn.php';
    $output = '';

    if (isset($_POST['export']) || isset($_POST['exportsupp'])) {
        
        $query_date = $_POST['exportMonth'];
        $date = new DateTime($query_date);
        //First day of month
        $date->modify('first day of this month');
        $firstday= $date->format('Y/m/d H:i:s');
        //Last day of month
        $date->modify('last day of this month');
        $lastday=$date->setTime(23,59,59);
        $lastday= $date->format('Y/m/d H:i:s');
        $month = date_format($date,"m");
        $year = date_format($date,"Y");

        if(isset($_POST['exportsupp'])){
            $supplier= $_POST['ExportTransactionSupp'];

            $sql1 = "SELECT * from transaction_items INNER JOIN supplier_transactions on supplier_transactions.transaction_ID = transaction_items.transaction_ID INNER JOIN item on transaction_items.item_ID = item.item_ID JOIN supplier on supplier.supplier_ID = supplier_transactions.supplier_ID where YEAR(supplier_transactions.transaction_Date) = ".$year." AND MONTH(supplier_transactions.transaction_Date) = ".$month." AND supplier_transactions.supplier_ID = ".$supplier;
        }
        else{
            $sql1 = "SELECT * from transaction_items INNER JOIN supplier_transactions on supplier_transactions.transaction_ID = transaction_items.transaction_ID INNER JOIN item on transaction_items.item_ID = item.item_ID JOIN supplier on supplier.supplier_ID = supplier_transactions.supplier_ID where YEAR(supplier_transactions.transaction_Date) = ".$year." AND MONTH(supplier_transactions.transaction_Date) = ".$month;
        }
        
        //supplier_transactions.transaction_Date BETWEEN ".$firstday." AND ".$lastday;  
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $transaction_ID = $row1['transaction_ID'];
                $supplier_Name = $row1['supplier_Name'];
                $supplier_Address = $row1['supplier_Address'];
                $supplier_ContactPerson = $row1['supplier_ContactPerson'];
                $supplier_ContactNum = $row1['supplier_ContactNum'];
                $item_Name = $row1['item_Name'];
                $item_Brand = $row1['item_Brand'];
                $transaction_Date = $row1['transaction_Date'];
                $transactionItems_Quantity = $row1['transactionItems_Quantity'];
                $transactionItems_TotalPrice = $row1['transactionItems_TotalPrice'];
                $transaction_TotalPrice = $row1['transaction_TotalPrice'];
                $transactionItems_CostPrice = $row1['transactionItems_CostPrice'];
            }
        }


        if(isset($_POST['exportsupp'])){
            $sql2 ="SELECT * from supplier where supplier_ID = ".$supplier;
            $result2 = mysqli_query($conn,$sql2);
            $resultCheck2 = mysqli_num_rows($result2);
            if ($resultCheck2>0){
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $supplier_Name = $row2['supplier_Name'];
                    $supplier_Address = $row2['supplier_Address'];
                    $supplier_ContactPerson = $row2['supplier_ContactPerson'];
                    $supplier_ContactNum = $row2['supplier_ContactNum'];
                }
            }
            $output .= "<table class='table' bordered='1'>
                            <tr>
                                <th> Monthly Purchases (".$query_date.") </th>
                            </tr>
                            <tr>
                                <td> Hardware Store </td>
                            </tr>
                            <tr>
                                <td> Date: </td>
                                <td>". $firstday ." to ".$lastday."</td>
                            </tr>
                        
                             <tr>
                                <td> Supplier: </td>
                                <td>". $supplier_Name ."</td>
                            </tr>
                            <tr>
                                <td> Contact Person: </td>
                                <td>". $supplier_ContactPerson ."</td>
                                <td> Contact No.: </td>
                                <td>". $supplier_ContactNum ."</td>
                            </tr>
                            <tr>
                                <td> Address: </td>
                                <td>". $supplier_Address ."</td>
                            </tr>

                            <tr>
                                
                            </tr>
                            <tr> 
                                <th> Transaction ID </th>
                                <th> Item </th>
                                <th> Brand </th>
                                <th> Transaction Date </th>
                                <th> Unit Price </th>
                                <th> Quantity </th>
                                <th> Total Unit Price </th>
                                <th> Total Transaction Price </th>
                            </tr>";

            
             $sql1 = "SELECT * from transaction_items INNER JOIN supplier_transactions on supplier_transactions.transaction_ID = transaction_items.transaction_ID INNER JOIN item on transaction_items.item_ID = item.item_ID JOIN supplier on supplier.supplier_ID = supplier_transactions.supplier_ID where YEAR(supplier_transactions.transaction_Date) = ".$year." AND MONTH(supplier_transactions.transaction_Date) = ".$month." AND supplier_transactions.supplier_ID = ".$supplier;

        }
        else{
            $output .= "<table class='table' bordered='1'>
                            <tr>
                                <th> Monthly Purchases (".$query_date.") </th>
                            </tr>
                            <tr>
                                <td> Hardware Store </td>
                            </tr>
                            <tr>
                                <td> Date: </td>
                                <td>". $firstday ." to ".$lastday."</td>
                            </tr>
                            <tr>
                                
                            </tr>

                            <tr> 
                                <th> Transaction ID </th>
                                <th> Supplier </th>
                                <th> Item </th>
                                <th> Brand </th>
                                <th> Transaction Date </th>
                                <th> Unit Price </th>
                                <th> Quantity </th>
                                <th> Total Unit Price </th>
                                <th> Total Transaction Price </th>
                            </tr>";

             $sql1 = "SELECT * from transaction_items INNER JOIN supplier_transactions on supplier_transactions.transaction_ID = transaction_items.transaction_ID INNER JOIN item on transaction_items.item_ID = item.item_ID JOIN supplier on supplier.supplier_ID = supplier_transactions.supplier_ID where YEAR(supplier_transactions.transaction_Date) = ".$year." AND MONTH(supplier_transactions.transaction_Date) = ".$month;
        }
         
        
        

        
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $output .= "<tr>"; 
                $output .= "<td>" .$row1['transaction_ID']. "</td>";
                if(isset($_POST['export'])){
                    $output .= "<td>". $row1['supplier_Name']. "</td>";
                    
                }
                $output .="<td>" . $row1['item_Name'] . "</td>"; 
                $output .="<td>" . $row1['item_Brand'] . "</td>"; 
                $output .="<td>" . $row1['transaction_Date'] . "</td>";  
                $output .= "<td>" . $row1['transactionItems_CostPrice']. "</td>"; 
                $output .= "<td>" .$row1['transactionItems_Quantity']. "</td>";
                $output .= "<td>" .$row1['transactionItems_TotalPrice']. "</td>";
                $output .= "<td>" .$row1['transaction_TotalPrice']. "</td>";      
                $output .= "</tr>"; 

            }
        }else{
            $output .= "<td>No purchases for this month.</td>";
        } 
        
        $output .= "</table>"; 
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=HardwareStore_Trans' .$query_date. '.xls' );
        echo $output;
        


    } 
?>