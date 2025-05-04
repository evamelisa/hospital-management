<?php

//konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "hospital_management";

// membuat koneksi ko database menggunakan MySQLi
$conn = mysqli_connect($host, $username, $password, $database);

// mengeceek apakah koneksi berhasil
if ($conn->connect_error) {
    // menampilkan pesan error jika gagal koneksi
    die("Database gagal terkoneksi: " . $conn->connect_error);
}

// jika koneksi berhasil, script akan terus berjalan tanpa pesan error
?>