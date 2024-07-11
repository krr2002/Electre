<?php 

$host = "localhost:21211";
$user = "u368998282_adem";
$pass = "@Spkadem24";
$database = "u368998282_adem";

$koneksi = mysqli_connect($host, $user, $pass, $database);
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
 
