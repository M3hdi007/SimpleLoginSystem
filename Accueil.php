<?php
session_start();
if (!isset($_SESSION['user'])) {
	header('location:LoginPage.php');
}
echo "welcome Mr ".$_SESSION['user'];