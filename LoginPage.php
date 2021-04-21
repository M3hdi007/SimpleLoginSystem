<?php
include_once 'Connection.php';
$Signuperror="";
$loginerror="";
if (isset($_GET['Sign'])&&$_GET['Sign']=="true") {
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) ) {
	if ($_POST['password']!==$_POST['password2']) {
		$Signuperror="passwords non edientical";
	}
	else 
	{
		if (trim($_POST['username'])==""||trim($_POST['email'])==""||trim($_POST['password'])==""||trim($_POST['password2'])=="") {
			$Signuperror= "Please fill the form";
		}
		else
		{
			$sql="INSERT INTO `users`(`username`, `Email`, `password`) VALUES ('".$_POST['username']."','".$_POST['email']."','".$_POST['password']."')";
			$resultat=mysqli_query($conn,$sql);
			if ($resultat) {
				session_start();
			$_SESSION['user']=$_POST['username'];
				header("location:Accueil.php");
			}
			else
			{
				$Signuperror="User Already Registerd , Please change your infos";
			}
		}
	}
	}
}
	else if (isset($_GET['login'])&&$_GET['login']=="true") {
		$sql="SELECT * FROM `users` WHERE (username='".$_POST['username']."' and password='".$_POST['password']."') or (Email='".$_POST['username']."' and password='".$_POST['password']."')";
		$resultat=mysqli_query($conn,$sql);
		$counter=0;
		while ($row=mysqli_fetch_row($resultat)) {
			session_start();
			$_SESSION['user']=$row[1];
			header('location:Accueil.php');
			//echo $row["username"];
		}
		if ($counter==0) {
			$loginerror="User does not exist";
		}
		
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="LoginCss.css">
	<title>LoginPage</title>
</head>
<body>
<div class="Header">
	
</div>

<div class="Middle">
	<form method="POST" action="LoginPage.php?Sign=true">
		<h2>Sign In</h2>
		<input type="text" name="username" placeholder="Username">
		<input type="text" name="email" placeholder="email123@gmail.com">
		<input type="password" name="password" placeholder="password">
		<input type="password" name="password2" placeholder="retype password">
		<input type="submit"  class="btn" name="submit" value="Sign in">
		<?php
             if (trim($Signuperror)!="") {
             	echo "<div class='Siignup'>";
             	echo "<p>";
             	echo $Signuperror;
             	echo "</p>";
             	echo "</div>";
             }
		?>

	</form>
	
</div>

<div class="Middle">
	<form method="POST" action="LoginPage.php?login=true">
		<h2>Log In</h2>
		<input type="text" name="username" placeholder="Username or Email ...">
		<input type="password" name="password" placeholder="password">
		<input type="submit"  class="btn" name="submit" value="Sign in">
		<?php
             if (trim($loginerror)!="") {
             	echo "<div class='Siignup'>";
             	echo "<p>";
             	echo $loginerror;
             	echo "</p>";
             	echo "</div>";
             }
		?>
	</form>
	
</div>

<div class="Footer">
	
</div>

</body>
</html>