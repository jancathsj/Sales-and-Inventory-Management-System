<!DOCTYPE html>
<html>
<head>
  <title>Add Records in Database</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
</head>
<body>

<?php


$db = mysqli_connect("localhost","root","","Hardware");

			if(!$db)
			{
				die("Connection failed: " . mysqli_connect_error());
			}

			if(isset($_POST['submit']))
			{		
			
			$supplier_Name= $_POST['supplier_Name'];
			$supplier_ContactPerson = $_POST['supplier_ContactPerson'];
			$supplier_ContactNum= $_POST['supplier_ContactNum'];
			$supplier_Address= $_POST['supplier_Address'];
		

			$insert = mysqli_query($db,"INSERT INTO supplier ". "(supplier_Name, supplier_ContactPerson,
					supplier_ContactNum, supplier_Address) ". "
					VALUES('$supplier_Name', '$supplier_ContactPerson', '$supplier_ContactNum', '$supplier_Address')");
					
			}
			
               
    if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {
        header( "Location: ./suppliers.php?");
        exit;
    }


mysqli_close($db); // Close connection

?>

<!-- ------------------------ No supplier ID, autoincrement  --------------------------- -->

<h3>Fill the Form</h3>

<form action="./addsupplier.php" method="post">
    <p>
        Supplier Name:
        <input type="text" name="supplier_Name" id="supplier_Name" required>
    </p> 
    <p>
        Supplier Contact Person:
        <input type="text" name="supplier_ContactPerson" id="supplier_ContactPerson" required>
    </p>
    <p>
        Supplier Contact Number:
        <input type="text" name="supplier_ContactNum" id="supplier_ContactNum" required>
    </p>  
    <p>
        Supplier Address:
        <input type="text" name="supplier_Address" id="supplier_Address" required>
    </p>
   
  
  
  <input type="submit" name="submit" value="Submit">
  <button type="button" onclick="location.href='./suppliers.php'">Go back </button>
</form>

</body>
</html>


