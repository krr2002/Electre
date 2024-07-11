<?php
session_start();
require_once("konek-db.php");
require_once("functions.php");
require_once('includes/init-setting.php');

// Deklarasi variabel untuk menampung data awal
$periode_aktif = $pengaturan['periode_aktif'];
$page = "";
?>