<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style.css?ts=<?=time()?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

      <!-- CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<!-- JQUERY/BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


<?php 
include "conn.php";
require_once '../../env/auth_check.php';

$result = mysqli_query($conn, "SELECT SUM(orderItems_TotalPrice) AS totalSum, COUNT(item_ID) AS totalItems, order_Date FROM order_items INNER JOIN orders on orders.order_ID = order_items.order_ID");
$row = mysqli_fetch_array($result);
$totalItems = $row['totalItems'];
$totalSum = $row['totalSum'];
?>

<body>
<main>
    <div class="nav"> 
        <?php include 'navbar.php'; ?>
    </div>   

    

    <div class="container-fluid bg-light p-5 pt-2 mb-0">
         <br>
      <!--  <div id="head">
            Heading -->
            <div id="inventoryHead" >
                <span class="fs-1 fw-bold"> SALES</span>
            </div> 

            
            <!--<div id="group">-->
            <div class='row mt-0'>
                <div class="p-0 mb-3 rounded border shadow-sm">
                    <div class="pl-2 pb-1 pt-1 card-header" >
                        <small style="font-weight:bold;">Sales Reports</small>
                    </div>
                <!-- SALES INFO 
                <div class="p-3 bg-white rounded border rounded shadow-sm" id="weekly">
                    <strong> NUMBER OF SALES </strong> <br/>
                    <span class="text-primary fs-3"><?php echo $totalItems;?> <i class="fas fa-coins pt-2" style="float:right;"></i></span> <br/>
                    <strong> REVENUE </strong> <br/>
                    <span class="text-primary fs-3"> Php <?php echo number_format($totalSum,2);?><i class='fas fa-wallet pt-2' style="float:right;"></i></span> 
                </div>-->

                <!-- Buttons 
                <div id="exportBtn">-->
                <!-- Download Sales Report Excel File -->
                <div class='row p-2'>
                    <div class="col-md-3">
                        <div class="form-group">
                            <form action="export.php" method="post">
                                <label></label> <br> 
                                <button class="btn btn-success w-100" name="export" type="submit" ><i class='fas fa-download'></i> Export Sales</button> 
                            </form>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <!--summary button -->
                            <label></label> <br> 
                            <button class="btn btn-primary dropdown-toggle w-100" name="export" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" ><i class='fas fa-download' ></i> Summary</button>   
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-black" href="pdf_DailyReport.php"  target="_blank">Daily Sales</a></li>
                                <li><a class="dropdown-item text-black" href="pdf_WeeklyReport.php"  target="_blank">Weekly Sales</a></li>
                                <li><a class="dropdown-item text-black" href="pdf_MonthlyReport.php"  target="_blank">Monthly Sales</a></li>
                                <li><a class="dropdown-item text-black" href="pdf_QuarterlyReport.php" target="_blank">Quarterly Sales</a></li>
                                <li><a class="dropdown-item text-black" href="pdf_TodaysReport.php?from_date=<?php echo date('Y-m-d'); ?>&to_date=<?php echo date('Y-m-d'); ?>" target="_blank">Sales Today</a></li>
                                <li><button class="dropdown-item text-black" type="submit" form="customReport_Form">Sales in Date Range</button></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <!-- Summaries in PDF -->
                            <form action="pdf_CustomReport.php" method="GET" target="_blank" id="customReport_Form">
                                <div class='row'>
                                    <div class='col'>
                                        <div class="form-group">   
                                            <label style="padding-top:1px;"><small>From </small> </label>      
                                            <input type="date" name="from_date" id="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } else {
                                            echo '2022-01-01';
                                            } ?>" class="form-control" onchange="transactionDate()" >
                                        </div>     
                                    </div>
                                    
                                    <div class='col'>
                                        <div class="form-group">
                                            <label style="padding-top:1px;"><small>To</small> </label>
                                            <input type="date" name="to_date" id="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } else {echo date("Y-m-d");} ?>" class="form-control" onchange="transactionDate()" min="2022-01-01" >
                                        </div>
                                    </div>
                                </div>
                            </form>  
                               
                        </div>
                    </div>
                
                </div><!--end row-->
                    

                    


                <!--</div>  END OF exportBtn-->
            </div><!-- END OF group -->
        <!--</div> END OF head -->


        <!-- Daily Sales Table -->
        <div class="card mt-0" style="float:left; width:100%;">
            <div class="card-body">
                <div class= "container1">
                    <table class="table pr-3">
                        <?php     
                           $sql = "select distinct item_NAME from item order by item_NAME";
                            $result = mysqli_query($conn, $sql);
                            if (isset($_GET['to_date1'])) {
                                $from_date = $_GET['to_date1'];
                                $to_date = $_GET['to_date1'];
                                $to_date = date('Y-m-d', strtotime($_GET['to_date1'].'+1 day'));
                                //unset($_GET['to_date']);
                            } else {
                                $from_date = date("Y-m-d");
                                $to_date = date("Y-m-d",strtotime('+1 day'));
                            }         
                        ?>
                        <thead>
                            <h5>
                            <?php 
                                $labelDate2=date_create($from_date);
                                $labelDate2 = date_format($labelDate2,"F d, Y");
                            ?> 
                            Sales<?php echo " (".$labelDate2.")"; ?>
                            <!-- FILTER DATE -->
                            <div style="float:right; width:50%; padding-right:15px;">
                                <form action="sales.php" method="GET">
                                    <div class="row pb-2 mb-2">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="date" name="to_date1" id="to_date1" value="<?php if(isset($_GET['to_date1'])){ echo $_GET['to_date1']; } else {echo date("Y-m-d");} ?>" class="form-control" onchange="transactionDate()" min="2022-01-01">
                                            </div>
                                        </div>
                                        <div class="col-md-4">        
                                            <div class="form-group">              
                                                <button type="submit" class="form-control" style="color:black; background-color:#7393B3" style="background-color:#7393B3">Filter</button>
                                            </div>               
                                        </div>
                                    </div>                             
                                </form> 
                            </div>
                            </h5>
                            <!-- TOTAL SALES INFO -->
                                <?php
                                    $result = mysqli_query($conn, "SELECT SUM(orderItems_TotalPrice) AS totalSum, COUNT(item_ID) AS totalItems, order_Date FROM order_items INNER JOIN orders on orders.order_ID = order_items.order_ID 
                                    WHERE order_Date BETWEEN '$from_date' AND '$to_date' ");
                                    $row = mysqli_fetch_array($result);
                                    $totalItems_Day = $row['totalItems'];
                                    $totalSum_Day = $row['totalSum'];
                                ?>
                                <p class="text-info"> Number of Sales: <?php echo $totalItems_Day; ?>  &nbsp;<i class="fas fa-coins pt-2" ></i></span> 
                                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                Revenue: Php <?php  echo number_format($totalSum_Day,2); ?> &nbsp;<i class='fas fa-wallet pt-2' ></i></span></p>
                                <!-- END TOTAL SALES INFO -->

                                <tr>
                                    <th>Order Date</th>
                                    <th>Order ID</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Item Unit</th>
                                    <th>Item Brand</th>
                                    <th>Quantity</th>
                                    <th>Order Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 


                                    $sql = "SELECT item.item_ID, item.item_Name, item.item_unit, item.item_Brand, order_items.order_ID, order_items.orderItems_Quantity, order_items.orderItems_TotalPrice, orders.order_Date, orders.order_Total 
                                            FROM item 
                                            INNER JOIN order_items on order_items.item_ID = item.item_ID 
                                            INNER JOIN orders on orders.order_ID = order_items.order_ID 
                                            WHERE orders.order_Date BETWEEN '$from_date' AND '$to_date'";
                                    $result = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['order_Date']; ?></td>
                                                <td><?= $row['order_ID']; ?></td>
                                                <td><?= $row['item_ID']; ?></td>
                                                <td><?= $row['item_Name']; ?></td>
                                                <td><?= $row['item_unit']; ?></td>
                                                <td><?= $row['item_Brand']; ?></td>
                                                <td><?= $row['orderItems_Quantity']; ?></td>
                                                <td><?= $row['orderItems_TotalPrice']; ?></td>
                                                
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found"; 
                                        ?>
                                        </br>
                                        <?php
                                        //echo $to_date;
                                    }
                                
                            ?>
                            </tbody>
                        </table>
                    </div><!-- container1 -->
                </div><!-- card-body -->
            </div><!-- card -->

    </div> <!-- container-fluid -->
                             
 </main>

<?php //CHART QUERIES
    //THIS WEEK
    $days = array(0,0,0,0,0,0);
    $date = date("Y-m-d");
    $week=date_create($date);
    $week = date_format($week,"W");
    $sql = "SELECT SUM(order_Total) AS orderTotal, order_Date FROM orders WHERE WEEK(order_Date) = '$week' GROUP BY order_Date;";                                    
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $index=date_create($row['order_Date']);
            $index = date_format($index,"w");
            $days[$index] = $row['orderTotal'];
        }
    }

    //AVERAGE DAILY SALES MONTHLY
    $months = array(0,0,0,0,0,0,0,0,0,0,0,0);
    $date = date("Y-m-d");
    $year=date_create($date);
    $year = date_format($year,"Y");
    $sql = "SELECT AVG(daily) AS daily, orderDate FROM (SELECT SUM(order_Total) as daily, order_Date AS orderDate FROM orders WHERE YEAR(order_Date)='$year' GROUP BY order_Date) AS average GROUP BY MONTH(orderDate);";                                    
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $index=date_create($row['orderDate']);
            $index = date_format($index,"m");
            $index = intval(ltrim($index, '0'));
            $months[$index-1] = $row['daily'];
        }
    }

?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
