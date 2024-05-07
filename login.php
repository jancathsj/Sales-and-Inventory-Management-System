<?php
$host="localhost";
$user="root";
$password="";
$db="Hardware";

session_start();
unset($_SESSION["customerID"]);
$warning = "";
$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if(isset($_POST["submit"]))
{
	$user_ID=$_POST["login_ID"];
	$user_pword=$_POST["login_pword"];
	$user_pword = md5($user_pword);

	$sql="select * from user where username='".$user_ID."' AND user_pword='".$user_pword."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row !== null && $row["user_pword"]=$user_pword)
	{	
		$customerID=$row["user_ID"];
		$customerName = $row["username"];
		$_SESSION["customerID"]= $customerID;
		$_SESSION["customerName"]= $customerName;
		//$_SESSION['login_time'] = time();
		header("location:index.php");
	}

	else
	{
		//echo "username or password incorrect";
		$warning = "Wrong username or password.";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
   <script src="myjs.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://kit.fontawesome.com/0e73a6af39.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="logincss.css">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
</head>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>


<body class = "justify-content-center x-4 py-5 my-5">
	<div class = "w-20 mx-auto text-center my-auto">
		<img src="img/logo.png" class="rounded mx-auto d-block" width="130"/> 
		<br>
		
	</div>
	<div class="w-25 mx-auto text-center" style="border-radius: 15px; margin:auto;">
	
	<div class="fs-3 fw-bold text-center"> LOGIN </div>
		<hr>
		<form action = "#" method="post" id="form" class="text-center">
			<div class="form-floating"> 
				<input type = "text" name = "login_ID" id="login_ID" class="col-sm-3 form-control "  required>
				<label for="login_ID">Username</label>
			</div>
			<div class="form-floating mt-2">
				<input type = "password" name = "login_pword" id="login_pword" class="col-sm-3 form-control "  required>
				<label for="login_pword">Password</label>
			</div>
			<div class="form-floating mt-2">
				<div class="col">
					<input type="submit" name="submit" value="login" class="btn btn-lg btn-success mt-3 w-100">
				</div>
			</div>
			<div class="text-center text-danger pt-3 mt-1" style="font-size: 13px"><?php echo $warning ?></div>
		</form>
		</div>
	</div>
</body> 
</html>
