<?php
		$url = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		$in = $c = $t = $s = $it = $r = $p = $a = 'text-white';
		$s = $si = 'text-white';
		if ($url == 'suppliers.php' || $url == 'editsupplier.php' || $url == 'suppliertable.php') {
			$s = 'active';
		} else if ($url == 'supplieritem.php') {
			$si = 'active';
		} else if ($url == 'inventory.php') {
			$in = 'active';
		} else if ($url == 'pending.php') {
			$p = 'active';
		} else if ($url == 'transactions.php') {
			$t = 'active';
		} else if ($url == 'salability.php') {
			$sa = 'active';
		} else if ($url == 'items.php') {
			$it = 'active';
		} else if ($url == 'returnitem.php') {
			$r = 'active';
		} else if ($url == 'pending.php') {
			$p = 'active';
		} else if ($url == 'archive.php') {
			$a = 'active';
		} else if ($url == 'sales.php') {
			$sales = 'active';
		} else if ($url == 'order.php') {
			$o = 'active';
		}
   ?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
	<!-- CSS -->
	<link rel="stylesheet" href="navbar.css" />


</head>

<main>
	
	<!------------ SIDEBAR ----------->
	<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100" style="width: 280px;">
		<a href="../../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
		<img src="../../img/logo.png" class="me-2" width="40"/>
		<span class="fs-3"> Hardware Store</span>
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
						<a href="../inventory/inventory.php"><li class='dropdown-item text-white <?php echo $in ?>'><i class="bi bi-archive" style="margin-right: 8px;"></i>Inventory </li></a>
						<a href="../inventory/salability.php" ><li class='dropdown-item text-white <?php echo $sa ?>'><i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>Salability</li></a>
						<a href="../inventory/items.php" ><li class='dropdown-item text-white <?php echo $it ?>'><i class="bi bi-collection" style="margin-right: 8px;"></i>All Items</li></a>
						<a href="../inventory/returnitem.php" ><li class='dropdown-item text-white <?php echo $r ?>'><i class="bi bi-arrow-return-left" style="margin-right: 8px;"></i>Return Items </li></a>
						<a href="../inventory/archive.php" ><li class='dropdown-item text-white <?php echo $a ?>'><i class="bi bi-trash" style="margin-right: 8px;"></i>Trash </li></a>

					</ul>
				</div>
				</div>
			</div>
			<div class="accordion-item bg-dark">
				<h2 class="accordion-header" id="flush-headingTwo">
				<button class="accordion-button collapsed bg-dark text-white p-2 m-0 " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
				<i class="bi bi-people-fill " style="margin-right: 8px;"></i>	Suppliers
				</button>
				</h2>
				<div id="flush-collapseTwo" class="accordion-collapse <?php if(!$s || !$si){echo 'collapse';} ?>" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body p-1 m-0 pb-0">
					<ul>
						<a href="suppliers.php" ><li class='dropdown-item text-white <?php echo $s ?>'><i class="bi bi-people-fill" style="margin-right: 8px;"></i>Suppliers </li></a>
						<a href="supplieritem.php" ><li class='dropdown-item text-white <?php echo $si ?>'><i class="bi bi-collection" style="margin-right: 8px;"></i>Supplier Items </li></a>
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
						<a href="../sales/sales.php" ><li class='dropdown-item text-white <?php echo $sales ?>' ><i class="bi bi-table" style="margin-right: 8px;"></i>Sales </li></a>
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
						<a href="../inventory/pending.php" ><li class='dropdown-item text-white <?php echo $p ?>'><i class="bi bi-clock" style="margin-right: 8px;"></i>Pending </li></a>
						<a href="../inventory/transactions.php"  ><li class='dropdown-item text-white <?php echo $t ?>'><i class="bi bi-newspaper" style="margin-right: 8px;"></i>Transactions</li></a> 
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
						<a href="../order/order.php" ><li class='dropdown-item text-white <?php echo $o ?>'><i class="bi bi-cart-fill" style="margin-right: 8px;"></i>Sales Entry </li></a>
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
								<a href="../inventory/inventory.php" class="text-light"><?php echo $row['item_Name'] ?></a>
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
								<a href="../inventory/pending.php" class="text-light"><?php echo $row1['transaction_ID'] .': ' .$row1['supplier_Name'] ?></a>
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
								<a href="../inventory/pending.php" class="text-light"><?php echo $row1['transaction_ID'] .': ' .$row1['supplier_Name'] ?></a>
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
		<!-- <a class="nav-link d-grid p-0 mt-auto" href="env/backup.php" >
			<button class="btn btn-light"><i class="bi bi-save"></i> Backup Database</button>
		</a> -->
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
				<li><a class="dropdown-item" href="../../login.php">Sign out</a></li>
			</ul>
		</div>
		<!------ END OF USER FUNCTIONS ------>
	</div>
	<!------------ END OF SIDEBAR ----------->
</main>
	

</html>
