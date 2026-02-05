<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Default password Laragon/XAMPP biasanya kosong
$db   = 'p3';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
