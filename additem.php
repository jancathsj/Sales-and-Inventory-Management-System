<!DOCTYPE html>
<html>
<head>
  <title>Add Records in Database</title>
</head>
<body>

<?php


$db = mysqli_connect("localhost","root","","VSJM");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}



if(isset($_POST['submit']))
{		
    
    
    $item_Name= $_POST['item_Name'];
    $item_unit= $_POST['item_unit'];
    $item_Brand= $_POST['item_Brand'];
   

    $insert = mysqli_query($db,"INSERT INTO item ". "(item_Name, item_unit,
              item_Brand) ". "
			  VALUES('$item_Name', '$item_unit', '$item_Brand')");
			
               
    if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {
        echo "Records added successfully.";
    }
}

mysqli_close($db); // Close connection
?>

<!-- ------------------------ walang supplier ID, autoincrement ? --------------------------- -->

<h3>Fill the Form</h3>

<form action="./additem.php" method="post">
    <p>
        Item Name:
        <input type="text" name="item_Name" id="item_Name" required>
    </p> 
    <p>
        Item Unit:
        <input type="text" name="item_unit" id="item_unit" required>
    </p>
    <p>
        Item Brand:
        <input type="text" name="item_Brand" id="item_Brand" required>
    </p>  
    
   
  
  
  <input type="submit" name="submit" value="Submit">
  <button type="button" onclick="location.href='./inventory.php'">Go back </button>
</form>

</body>
</html>

