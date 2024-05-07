
<?php  
    $servername = "localhost";
    $username = "root";
    $dbname = "Hardware";
    //create conection
    $conn = new mysqli($servername, $username, "", $dbname);

    //check connection
    if($conn -> connect_errno){
		die("ERROR: Could not connect. " . mysqli_connect_error());
		exit();
	}

    //backup database
    date_default_timezone_set("Asia/Manila");
    if (file_exists("C:/Users/User1/HardwareStore/Database")) {
        $filename = $dbname."_".date("F_d_Y")."@".date("g_ia").uniqid("_",false); 
        $folder = "C:\\xampp\htdocs\CMSC-128-portfolio\Files\Database\\".$filename.".sql";
        $command = "C:\\xampp\mysql\bin\mysqldump -u root " .$dbname ."> " .$folder;
        echo $command;
        exec($command);
        header("location: ../index.php");
    } else {
        mkdir("C:/Users/User1/HardwareStore/Database");
    }
    
?>