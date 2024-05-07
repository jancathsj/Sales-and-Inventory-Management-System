<?php
error_reporting(0);
session_start();
include_once 'env/conn.php';
require_once 'auth_check.php';

$result = mysqli_query($conn, "SELECT SUM(orderItems_TotalPrice) AS totalSum, COUNT(item_ID) AS totalItems, order_Date FROM order_items INNER JOIN orders on orders.order_ID = order_items.order_ID ");
$row = mysqli_fetch_array($result);
$totalItems = $row['totalItems'];
$totalSum = $row['totalSum'];

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

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Hardware Store </title>
	<!-- CSS -->
	<link rel="stylesheet" href="index.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>

	<!-- JQUERY/BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

	<script type="text/javascript">
		$(document).ready(function() {
			clockUpdate();
			setInterval(clockUpdate, 1000);
		});

		function clockUpdate() {
			var date = new Date();
			var ampm = 'AM';
			function addZero(x) {
				if (x<10) {
					return x = '0'+x;
				} else {
					return x;
				}
			}

			function twelveHour(x) {
				if (x>12) {
					ampm = 'PM';
					return x = x-12;
				} else if (x==0) {
					ampm = 'AM';
					return x = 12;
				} else {
					ampm = 'AM';
					if (x==12) {
						ampm = 'PM';
					}
					return x;
				}
			}

			var h = addZero(twelveHour(date.getHours()));
			var m = addZero(date.getMinutes());
			var s = addZero(date.getSeconds());

			const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
			const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
			var da = weekday[date.getUTCDay()];
			var mo = month[date.getUTCMonth()];
			var d = date.getDate();
			var y = date.getFullYear();

			$('.clock').text(h + ':' + m + ':' + s + ' ' + ampm);
			$('.day').text(da);
			$('.date').text(mo + ' ' + d + ', ' + y);
		}
	</script>
</head>	
<body>

	<main>
	
	<!------------ SIDEBAR ----------->
	<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100" style="width: 280px;">
		<a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
		<img src="img/logo.png" class="me-2" width="40"/>
		<span class="fs-3"> Hardware Store </span>
		</a>
		<hr class="mb-1">
	
		<div style="height:70%;">
		<!-- MENUS -->
		<div class="accordion accordion-flush" id="accordionFlushExample" >
			<div class="accordion-item bg-dark">
				<h2 class="accordion-header" id="flush-headingOne">
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
				<i class="bi bi-archive" style="margin-right: 8px;"></i>	Inventory 
				</button>
				</h2>
				<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul>
						<a href="pages/inventory/inventory.php"><li class='dropdown-item text-white'><i class="bi bi-archive" style="margin-right: 8px;"></i>Inventory </li></a>
						<a href="pages/inventory/salability.php" ><li class='dropdown-item text-white'><i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>Salability</li></a>
						<a href="pages/inventory/items.php" ><li class='dropdown-item text-white'><i class="bi bi-collection" style="margin-right: 8px;"></i>All Items</li></a>
						<a href="pages/inventory/returnitem.php" ><li class='dropdown-item text-white'><i class="bi bi-arrow-return-left" style="margin-right: 8px;"></i>Return Items </li></a>
						<a href="pages/inventory/archive.php" ><li class='dropdown-item text-white'><i class="bi bi-trash" style="margin-right: 8px;"></i>Trash </li></a>

					</ul>
				</div>
				</div>
			</div>
			<div class="accordion-item bg-dark">
				<h2 class="accordion-header" id="flush-headingTwo">
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
				<i class="bi bi-people-fill" style="margin-right: 8px;"></i>	Suppliers
				</button>
				</h2>
				<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul>
						<a href="pages/supplier/suppliers.php" ><li class='dropdown-item text-white'><i class="bi bi-people-fill" style="margin-right: 8px;"></i>Suppliers </li></a>
						<a href="pages/supplier/supplieritem.php" ><li class='dropdown-item text-white'><i class="bi bi-collection" style="margin-right: 8px;"></i>Supplier Items </li></a>
					</ul>
				</div>
				</div>
			</div>
			<div class="accordion-item bg-dark">
				<h2 class="accordion-header" id="flush-headingThree">
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
				<i class="bi bi-table" style="margin-right: 8px;"></i> 	Reports
				</button>
				</h2>
				<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul >
						<a href="pages/sales/sales.php" ><li class='dropdown-item text-white' ><i class="bi bi-table" style="margin-right: 8px;"></i>Sales </li></a>
					</ul>
				</div>
				</div>
			</div>

			<div class="accordion-item bg-dark">
				<h2 class="accordion-header" id="flush-headingFour">
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
				<i class="bi bi-newspaper" style="margin-right: 8px;"></i>	Transactions
				</button>
				</h2>
				<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul >
						<a href="pages/inventory/pending.php" ><li class='dropdown-item text-white'><i class="bi bi-clock" style="margin-right: 8px;"></i>Pending </li></a>
						<a href="pages/inventory/transactions.php"  ><li class='dropdown-item text-white'><i class="bi bi-newspaper" style="margin-right: 8px;"></i>Transactions</li></a> 
					</ul>
				</div>
				</div>
			</div>
			<div class="accordion-item bg-dark">
			<h2 class="accordion-header" id="flush-headingFour">
				<!--<button class="accordion-button collapsed bg-dark text-white" type="button" onclick="window.location.href='pages/order/order.php'" >
					<i class="bi bi-cart-fill" style="margin-right: 8px;"></i> Sales Entry
				</button>-->
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
					<i class="bi bi-cart-fill" style="margin-right: 8px;"></i> Sales Entry
				</button>
			</h2>
			<div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul >
						<a href="pages/order/order.php" ><li class='dropdown-item text-white'><i class="bi bi-cart-fill" style="margin-right: 8px;"></i>Sales Entry </li></a>
					</ul>
				</div>
				</div>
			</div>

		</div>
		
		<!-- END OF MENUS -->
		</div>
		<div style="height:38%;">
		<hr class="mb-1">
		<!------ REMINDER ------>
		<ul class="nav nav-pills flex-column mb-auto">
			<li class="nav-item">
				<p class="fw-bold fs-5 fst-italic mb-0"> Reminders </p>
				<!-- SHOW LOW ON STOCKS ITEMS AND PENDING DELIVERIES-->
			<?php
				//LOW ON STOCKS	
				$sql = "SELECT * FROM inventory INNER JOIN item ON (inventory.item_ID = item.item_ID) WHERE inventoryItem_Status = 1 AND item_Stock<=10";
				$result = mysqli_query($conn,$sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck>0){ 
					echo '<small class="text-warning mt-3 pb-2">Low on Stocks</small>';
					echo "<div class='table-wrapper' style='height:auto; max-height:60px;' id='style-1'>";
					echo '<div class="container flex-column mb-auto gap-2">';
					while ($row = mysqli_fetch_assoc($result)) {	
			?>
						<div class="rounded p-2 py-1 row mb-2" style="background-color: #343a40;" id="reminder">
							<div class="col-9 px-0 text-muted" >
								<a href="pages/inventory/inventory.php" class="text-light"><?php echo $row['item_Name'] ?></a>
							</div>
							<div class="col px-0 text-danger text-end">
								<?php echo $row['item_Stock'] .$row['item_unit'] ?>
							</div>
						</div>
			<?php
					}
					echo '</div>';
					echo '</div>';
				}

				//PENDING ORDERS
				$sql1 = "SELECT * FROM supplier_Transactions  INNER JOIN supplier ON (supplier.supplier_ID = supplier_Transactions.supplier_ID ) WHERE transaction_Status = 0";
				$result1 = mysqli_query($conn,$sql1);
				$resultCheck1 = mysqli_num_rows($result1);
				if ($resultCheck1>0){ 
					
					echo '<small class="text-warning mt-3 pb-2">Pending Orders</small>';
					echo "<div class='table-wrapper' style='height:auto; max-height:60px;' id='style-1'>";
					echo '<div class="container flex-column mb-auto gap-2">';
					while ($row1 = mysqli_fetch_assoc($result1)) {	
			?>
						<div class="rounded p-2 py-1 row mb-2" style="background-color: #343a40;" id="reminder">
							<div class="col-9 px-0">
								<a href="pages/inventory/pending.php" class="text-light"><?php echo $row1['transaction_ID'] .': ' .$row1['supplier_Name'] ?></a>
							</div>
							<div class="col px-0 text-danger text-end">
								<?php echo number_format($row1['transaction_TotalPrice'],2) ?>
							</div>
						</div>
			<?php
					  	}
			
					echo '</div>';
					echo "</div>";
				}

				//PENDING DELIVERIES 	
				$sql1 = "SELECT * FROM supplier_Transactions  INNER JOIN supplier ON (supplier.supplier_ID = supplier_Transactions.supplier_ID ) WHERE transaction_Status = 1";
				$result1 = mysqli_query($conn,$sql1);
				$resultCheck1 = mysqli_num_rows($result1);
				if ($resultCheck1>0){ 
					echo '<small class="text-warning mt-3 pb-2">Deliveries</small>';
					echo "<div class='table-wrapper' style='height:auto; max-height:60px;' id='style-1'>";
					echo '<div class="container flex-column mb-auto gap-2">';
					while ($row1 = mysqli_fetch_assoc($result1)) {	
			?>
						<div class="rounded p-2 py-1 row mb-2" style="background-color: #343a40;" id="reminder">
							<div class="col-9 px-0">
								<a href="pages/inventory/pending.php" class="text-light"><?php echo $row1['transaction_ID'] .': ' .$row1['supplier_Name'] ?></a>
							</div>
							<div class="col px-0 text-danger text-end">
								<?php echo number_format($row1['transaction_TotalPrice'],2) ?>
							</div>
						</div>
			<?php
					}
					echo '</div>';
					echo '</div>';
				}
				?>
				
			</li>
		</ul>

		<!------ END OF REMINDER ------>
			</div>
		<!------ USER FUNCTIONS ------>
		<hr>
		<div class="dropdown">
			<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
				<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
				<strong><?php echo $_SESSION["customerName"]; ?></strong>
			</a>
			<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
				<li><a class="dropdown-item" href="#">Settings</a></li>
				<li><a class="dropdown-item" href="#">Profile</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="login.php">Sign out</a></li>
			</ul>
		</div>
		<!------ END OF USER FUNCTIONS ------>
	</div>
	<!------------ END OF SIDEBAR ----------->

	<!----------- RIGHT SIDE ------------>
	<div class="container-fluid bg-light w-100 h-100">
		
		
		<!------ TITLE ------>
		<div class="row justify-content-md-center mt-5">
			<div class="row">
				<div class="col position-relative">
				
					<div class="text-center fs-1"> Welcome, <strong><?php echo $_SESSION["customerName"]; ?></strong> </div>
				</div>
			</div>
			<div class="row">
				<div class="col position-relative">
					<!-- TIME AND DATE -->
					<div class="col text-center align-self-center">
							<div class="fs-5">
								<span class="clock fw-bold ml-3"> <i class="bi bi-clock"></i> 00:00:00 </span>
								<span class="day fst-italic"> <i class="bi bi-calendar3"></i> Day </span>
								<span class="date"> Date </span>
							</div>
					</div>
					<!-- END OF TIME AND DATE -->
				</div>
			</div>
		</div>

		<div class="row navbar-expand-md px-3 mt-3 mb-0" style="height:20%">
			<ul class="navbar-nav d-flex">
				<li class="nav-item flex-fill">
					<a class="nav-link d-grid h-75" href="pages/inventory/inventory.php">
						<button class="btn btn-primary fs-5 shadow-sm"><i class="bi bi-archive-fill"></i><br>Inventory</button>
					</a>
				</li>
				
				<li class="nav-item flex-fill">
					<a class="nav-link d-grid h-75" href="pages/supplier/suppliers.php">
						<button class="btn btn-success fs-5 shadow-sm"><i class="bi bi-people-fill"></i><br>Suppliers</button>
					</a>
				</li>
				
				<li class="nav-item flex-fill">
					<a class="nav-link d-grid h-75" href="pages/sales/sales.php">
						<button class="btn btn-danger fs-5 shadow-sm"><i class="bi bi-table"></i><br>Reports</button>
					</a>
				</li>
				<li class="nav-item flex-fill">
					<a class="nav-link d-grid h-75" href="pages/inventory/transactions.php">
						<button class="btn btn-info fs-5 shadow-sm"><i class="bi bi-newspaper"></i><br>Transactions</button>
					</a>
				</li>
				<li class="nav-item flex-fill">
					<a class="nav-link d-grid h-75" href="pages/order/order.php">
						<button class="btn btn-warning fs-5 shadow-sm"><i class="bi bi-cart-fill"></i><br>Sales Entry</button>
					</a>
				</li>
				
			</ul>
		</div>
		
		
		<?php
		?>
		<!------ ORDERED FROM SUPPLIERS ------>
		<div class="row px-3 mt-1" style="height:50%">
			<div class="col">
				<span class="fs-5 pb-1 fw-bold"> Pending Purchases  </span>(from Suppliers)
				<hr class="mt-1 ">
				<div class="bg-dark mt-2 rounded shadow-sm table-hover">
					<div class="row text-center text-light border-bottom p-2">
						<div class="col-2">Transaction ID</div>
						<div class="col-2">Supplier ID</div>
						<div class="col-3">Supplier Name</div>
						<div class="col-3">Transaction Date</div>
						<div class="col-2">Total Price</div>
					</div>
					<div style="overflow-y:scroll; overflow-x:hidden; max-height: 65%;">
					<?php 

					$sql = "SELECT * FROM supplier_transactions INNER JOIN supplier ON (supplier_transactions.supplier_ID = supplier.supplier_ID) WHERE transaction_Status =0 ;";   
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
						
					?>	
						<div class="row bg-white text-center border-bottom p-2" onclick="location.href='pages/inventory/pending.php'"> 
							<div class="col-2 fw-bold "><?php echo $ID ?></div> 
							<div class="col-2 "><?php echo $supplier ?></div>
							<div class="col-3 "><?php echo $supplierName ?></div>
							<div class="col-3 "><?php echo $transacDate ?></div>
							<div class="col-2 "><?php echo $total ?></div>
						</div>
					<?php
						$i++; 
					}
				}
					?>
					</div>
				</div>
			</div>
		</div>
				
		<!------ END OF SUPPLIERS ------>
		<!-- MONTHLY SALES -->

		
		<a class="d-grid p-0 mt-auto " href="env/backup.php" >
			<button class="btn btn-dark w-25"><i class="bi bi-save"></i> Backup Database</button>
		</a>
	</div>
	</main>



</body>
</html>
