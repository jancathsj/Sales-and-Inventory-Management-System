<?php
include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
$n=0;
$from_date='2022-01-01';
$to_date=date("Y-m-d");

  $sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 ;";   
  $result = mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);
?>
<!DOCTYPE html><html class=''>
<head>
  <title> Transactions </title>
  <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
  <script type="text/javascript" src="inventory.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>

    <!-- CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  
	<!-- JQUERY/BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
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
<body>
  <main>
  <?php include 'navbar.php'; ?>
  

        
  <div class="container-fluid bg-light p-5 pt-2">
    <br>
    <span class="fs-1 fw-bold"> TRANSACTIONS </span>
    <p> Completed and undelivered transactions are shown here</p>
                       

    <div class = "container">

      <form action="transactions.php" method="GET">
        <div class="row pb-3 mb-3">
          <div class="col-md-3">        
            <div class="form-group">          
              <label>From </label>
              <input type="date" name="from_date" id="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } else {
                echo '2022-01-01';
              } ?>" class="form-control" onchange="transactionDate()">
            </div>          
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>To </label>
              <input type="date" name="to_date" id="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } else {echo date("Y-m-d");} ?>" class="form-control" onchange="transactionDate()" min="2022-01-01">
            </div>
          </div>
          <div class="col-md-3">        
            <div class="form-group">        
              <label></label> <br>        
              <button type="submit" class="form-control" style="color:black; background-color:#7393B3" style="background-color:#7393B3">Filter</button>
            </div>               
          </div>
          <div class="col-md-3">        
            <div class="form-group">        
              <label></label> <br>        
              <div class="dropdown">
                <button class="btn btn-success dropdown-toggle form-control" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Download</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item text-dark" href="export.php?exportTransactions=all#">All Transactions</a></li>
                  <li><a class="dropdown-item text-dark" href="export.php?exportTransactions=month#">Transactions for this Month</a></li>
                  <li><a class="dropdown-item text-dark" href="export.php?exportTransactions=range&from=<?php echo $from_date?>&to=<?php echo $to_date?>#" id=exportRange onclick="changeRange()">Transactions in Date Range</a></li>
                </ul>
              </div>
            </div>               
          </div>
        </div>              
      </form> 

      <div class='table-wrapper' style="height:550px;">
      <?php  
        if (isset($_GET['from_date'])) {
          $from_date = $_GET['from_date'];
          $to_date = $_GET['to_date'];
          $sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 AND transaction_Date BETWEEN '$from_date' AND '$to_date';";  
          unset($_GET['from_date']);
          unset($_GET['to_date']);
        } else {
          $sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status !=0 ;";
        }

           
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
          if ($resultCheck>0){
              while ($row = mysqli_fetch_assoc($result)) {
                $n++;
                $ID = $row['transaction_ID'];  
                $supplier = $row['supplier_ID'];
                $supplierName = $row['supplier_Name'];
                $transacDate = $row['transaction_Date'];   
                $total = $row['transaction_TotalPrice'];
                $status = $row['transaction_Status'];
               /* if ($status == 1) {
                  $status = 'undelivered';
                  echo "<div class='panel panel-info'>";
              } else{
                  $status = 'completed';
                  echo "<div class='panel panel-success'>";
              }*/
        
        ?>

        <section class="accordion">
          
              <input type="checkbox" name="collapse" id="collapse<?php echo $n?>" >
              <h2 class="handle">
                <label for="collapse<?php echo $n?>" > <?php echo "Transaction ID: ".$ID; ?> 
                &emsp; &emsp; &emsp; &emsp; Supplier: <?php echo $supplierName; ?>
                <div style="float:right; width:30px;">
                  <form action="export.php" method="post">
                    <input type=hidden name=ExportTransactionID value=<?php echo $ID?>>
                    <input type=hidden name=ExportTransactionSupp value=<?php echo $supplier?>>
                    <button class="btn" name="export" type="submit" style="float:right;"><i class='fas fa-download'></i></button>
                  </form>
                </div>
                <?php if ($status==1) {
                  echo '<span style="float:right;padding-top:8px;padding-right:30px; color:#AA2A2A">undelivered</span>';
                }?>
                
                </br> <span style="padding-left:27px; font-weight: 100;">Date: <?php echo $transacDate; ?></span>
                &nbsp; &nbsp; &nbsp; Total: <?php echo $total;?>
                </label>
              </h2>
        
        <div class="content">
          <?php echo "<table class='table'> 
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
                        echo "<tr>"; 
                        echo "<td>" .$row1['item_ID']. "</td>";  
                        echo "<td>". $row1['item_Name']. "</td>";  
                        echo "<td>" .$row1['item_Brand']. "</td>";  
                        echo "<td>" . $row1['item_unit'] . "</td>";  
                        echo "<td>" . $row1['transactionItems_Quantity']. "</td>"; 
                        echo "<td>" .$row1['transactionItems_CostPrice']. "</td>";
                        echo "<td>" .$row1['transactionItems_TotalPrice']. "</td>";       
                        echo "</tr>"; 

                      }
                    } 

                    echo "</table>"; ?>
          </div>
        </section>

      <?php } 
      }?>
      </div>
  </div> <!-- end container -->

</div> <!-- END CONTENT -->
    </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>