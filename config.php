<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_toko2837";  // itu nama database saya 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengatur charset ke utf8 untuk mendukung karakter non-ASCII
$conn->set_charset("utf8");
