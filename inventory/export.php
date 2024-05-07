<?php 
    include_once '../../env/conn.php';
    $output = '';

    if (isset($_POST['export'])) {
        $ID = $_POST['ExportTransactionID'];
        $supplier = $_POST['ExportTransactionSupp'];

        $sql1 = "SELECT * FROM supplier  INNER JOIN supplier_transactions ON (supplier_transactions.supplier_ID = supplier.supplier_ID ) WHERE supplier.supplier_ID='$supplier' AND transaction_ID = '$ID';";   
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $supplierName = $row1['supplier_Name'];
                $supplierContactPerson = $row1['supplier_ContactPerson'];
                $supplierContactNum = $row1['supplier_ContactNum'];
                $supplierAddress = $row1['supplier_Address'];
                $transactionDate = $row1['transaction_Date'];
                $transactionTotalPrice = $row1['transaction_TotalPrice'];
                $transactionStatus = $row1['transaction_Status'];
            }
        }



         $output .= "<table class='table' bordered='1'> 
                            <tr>
                                <td> Supplier: </td>
                                <td>". $supplierName ."</td>
                            </tr>
                            <tr>
                                <td> Contact Person: </td>
                                <td>". $supplierContactPerson ."</td>
                                <td> No.: </td>
                                <td>". $supplierContactNum ."</td>
                            </tr>
                            <tr>
                                <td> Address: </td>
                                <td>". $supplierAddress ."</td>
                            </tr>
                            <tr>
                                <td> Date: </td>
                                <td>". $transactionDate ."</td>
                            </tr>
                            <tr>
                                
                            </tr>

                            <tr> 
                                <th> ID </th>
                                <th> Item </th>
                                <th> Brand </th>
                                <th> unit </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Total Price </th>
                            </tr>";

        $sql1 = "SELECT * FROM transaction_Items INNER JOIN item ON (transaction_Items.item_ID = item.item_ID) WHERE transaction_ID = '$ID' ;";   
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $output .= "<tr>"; 
                $output .= "<td>" .$row1['item_ID']. "</td>";  
                $output .= "<td>". $row1['item_Name']. "</td>";  
                $output .= "<td>" .$row1['item_Brand']. "</td>";  
                $output .="<td>" . $row1['item_unit'] . "</td>";  
                $output .= "<td>" . $row1['transactionItems_Quantity']. "</td>"; 
                $output .= "<td>" .$row1['transactionItems_CostPrice']. "</td>";
                $output .= "<td>" .$row1['transactionItems_TotalPrice']. "</td>";       
                $output .= "</tr>"; 

            }
        } 
        $output .= "<tr> </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total: </td>
                        <td>". $transactionTotalPrice . "</td>

                    </tr>";
        $output .= "</table>"; 
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$supplierName . '_Trans' .$ID. '.xls' );
        echo $output;
        


    } elseif (isset($_POST['exportItems'])) {
        
         $output .= "<table class='table' bordered='1'> 
                            <tr> 
                                <th> ID </th>
                                <th> Item </th>
                                <th> Unit </th>
                                <th> Brand </th>
                                <th> Stock </th>
                            </tr>";

        $sql1 = "SELECT * FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) WHERE  inventoryItem_Status = 1 ORDER BY inventory.item_ID;";   
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $output .= "<tr>"; 
                $output .= "<td>" .$row1['item_ID']. "</td>";  
                $output .= "<td>". $row1['item_Name']. "</td>";  
                $output .="<td>" . $row1['item_unit'] . "</td>"; 
                $output .= "<td>" .$row1['item_Brand']. "</td>";  
                $output .= "<td>". $row1['item_Stock']. "</td>";       
                $output .= "</tr>"; 

            }
        } 
        
        $output .= "</table>"; 
        $date = date("m-d-Y");
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=VSJM_inventory(' .$date .').xls');
        echo $output;
        


    } elseif (isset($_GET['exportTransactions'])) {
        $type = $_GET['exportTransactions'];

        if ($type=='all') {
            $sql1 = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 ;";
            $filename = 'VSJM_All_Trans@'.date("F_d_Y"). '.xls';
        } elseif ($type=='month') {
            $year = date("Y");
            $month = date("m");
            $sql1 = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 AND YEAR(supplier_transactions.transaction_Date) = '$year' AND MONTH(supplier_transactions.transaction_Date) = '$month';"; 
            $filename = 'VSJM_' .date("F") .'_Trans@'.date("F_d_Y"). '.xls';
        } elseif ($type=='range') {
            $from_date = $_GET['from'];
            $to_date = $_GET['to'];
            $sql1 = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 AND transaction_Date BETWEEN '$from_date' AND '$to_date';"; 
            $filename = 'VSJM_' .$from_date .'_to_' .$to_date .'_Trans@'.date("F_d_Y"). '.xls';
        }  
        $result1 = mysqli_query($conn,$sql1);
        $resultCheck1 = mysqli_num_rows($result1);            
                    
        if ($resultCheck1>0){
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $supplierName = $row1['supplier_Name'];
                $supplierContactPerson = $row1['supplier_ContactPerson'];
                $supplierContactNum = $row1['supplier_ContactNum'];
                $supplierAddress = $row1['supplier_Address'];
                $transactionDate = $row1['transaction_Date'];
                $transactionTotalPrice = $row1['transaction_TotalPrice'];
                $transactionStatus = $row1['transaction_Status'];
                $ID = $row1['transaction_ID'];

                $output .= "<table class='table' bordered='1'> 
                            <tr>
                                <td> Supplier: </td>
                                <td>". $supplierName ."</td>
                            </tr>
                            <tr>
                                <td> Contact Person: </td>
                                <td>". $supplierContactPerson ."</td>
                                <td> No.: </td>
                                <td>". $supplierContactNum ."</td>
                            </tr>
                            <tr>
                                <td> Address: </td>
                                <td>". $supplierAddress ."</td>
                            </tr>
                            <tr>
                                <td> Date: </td>
                                <td>". $transactionDate ."</td>
                            </tr>
                            <tr>
                                
                            </tr>

                            <tr> 
                                <th> ID </th>
                                <th> Item </th>
                                <th> Brand </th>
                                <th> unit </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Total Price </th>
                            </tr>";

                $sql2 = "SELECT * FROM transaction_Items INNER JOIN item ON (transaction_Items.item_ID = item.item_ID) WHERE transaction_ID = '$ID' ;";   
                $result2 = mysqli_query($conn,$sql2);
                $resultCheck2 = mysqli_num_rows($result2);            
                            
                if ($resultCheck2>0){
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $output .= "<tr>"; 
                        $output .= "<td>" .$row2['item_ID']. "</td>";  
                        $output .= "<td>". $row2['item_Name']. "</td>";  
                        $output .= "<td>" .$row2['item_Brand']. "</td>";  
                        $output .="<td>" . $row2['item_unit'] . "</td>";  
                        $output .= "<td>" . $row2['transactionItems_Quantity']. "</td>"; 
                        $output .= "<td>" .$row2['transactionItems_CostPrice']. "</td>";
                        $output .= "<td>" .$row2['transactionItems_TotalPrice']. "</td>";       
                        $output .= "</tr>"; 

                    }
                } 
                $output .= "<tr> </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total: </td>
                                <td>". $transactionTotalPrice . "</td>

                            </tr>";
                $output .= "</table>"; 

            }
        }



        
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$filename);
        echo $output;

    }
?>