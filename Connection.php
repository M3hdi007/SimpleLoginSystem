<?php

$ServerName="localhost";
$dbservername="root";
$pass="";
$dbname="login3";

$conn=mysqli_connect($ServerName,$dbservername,$pass,$dbname);
if (!$conn) {
	die("Connection failed");
}