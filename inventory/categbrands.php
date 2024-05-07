<?php
include_once '../../env/conn.php';
require_once '../../env/auth_check.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title> Categories and Brands </title>
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
    
 
    </head>
    <body>
        <main>
        <?php include 'navbar.php'; ?>

        <!-- NAV BAR -->
    <div class="container-fluid bg-light" style="padding-right:0;padding-left:0; padding-bottom:0">
    <nav class="navbar  px-3 py-3" style=" width:100%">
      <ul class="nav nav-tabs pb-2" style="width:100%">
        
        <li class="nav-item" style="padding-left: 2.1%">
          <a class="nav-link active" aria-current="page" href="inventory.php" ><i class="bi bi-archive-fill"></i> Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../supplier/suppliers.php"><i class="bi bi-people-fill"></i> Suppliers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../sales/sales.php"><i class="bi bi-table"></i> Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../order/order.php"><i class="bi bi-cart-fill"></i> Sales Entry</a>
        </li>

        <div class="btn-group" style="display:block; margin-left: auto; margin-right:2">
				<button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" id="dropdownUser1" aria-expanded="false">
					<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
					<strong>User</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</button>
				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start shadow"  aria-labelledby="dropdownUser1">
				<li><a class="dropdown-item" href="#">Settings</a></li>
				<li><a class="dropdown-item" href="#">Profile</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="login.php">Sign out</a></li>
				</ul>
			</div>
      </ul>
      
      
    </nav>
    <!-- END OF NAV BAR --> 
        
        <div class="container-fluid bg-light p-5 pt-2">
            <div class="row">
                <div class="col">
                    <div class="fs-1 fw-bold rounded-top bg-dark text-info px-4"> CATEGORIES </div>
                    <div class="bg-white rounded-bottom border shadow-sm overflow-auto p-4" style="max-height:500px">
                    <?php
                        $sql = "SELECT COUNT(item.item_ID) AS num, item_Category FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) GROUP BY item_Category"; 
                        $result = mysqli_query($conn,$sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck>0){
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo $row['item_Category']. ": " . $row['num']. " items <br/>";
                            }
                        }
                    ?>
                    </div>
                </div>
                <div class="col">
                    <div class="fs-1 fw-bold rounded-top bg-dark text-warning px-4"> BRANDS </div>
                    <div class="bg-white rounded-bottom border shadow-sm overflow-auto p-4" style="max-height:500px">
                    <?php
                        $sql = "SELECT COUNT(item.item_ID) AS num, item_Brand FROM item INNER JOIN inventory ON (item.item_ID = inventory.item_ID) GROUP BY item_Brand"; 
                        $result = mysqli_query($conn,$sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck>0){
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo $row['item_Brand']. ": " . $row['num']. " items <br/>";
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>          
        </div>
        </main>
    </body>
</html>
