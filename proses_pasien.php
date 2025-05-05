<?php
// menghubungkan file konfigurasi database
include 'config.php';

// memulai sesi PHP
session_start();

// menangani form untuk menambahkan catatan baru
if (isset($_POST['simpan'])) {
    // mendapatkan data dari form
    $nama_pasien = $_POST["nama_pasien"];
    $gender = $_POST["gender"]; 
    $tgl_lahir = $_POST["tgl_lahir"];
    $meetingDate = $_POST["meetingDate"];
    $meetingTime = $_POST["meetingTime"];

    // menggabungkan tanggal dan waktu
    $tanggalPertemuan = $meetingDate . ' ' . $meetingTime;

    // menyimpan data ke database
    $query = "INSERT INTO pasien (nama_pasien, gender, tgl_lahir, tgl_pertemuan)
                    VALUES ('$nama_pasien', '$gender', '$tgl_lahir', '$tgl_pertemuan')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => 'Data pasien berhasil disimpan!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal menyimpan data pasien: ' . mysqli_error($conn)];
    }

// arahkan ke halaman dashboard
header("Location: dashboard.php");
exit();
}

// mengecek form update data pasien
if (isset($_POST['update'])) {
    $pasienId = $_POST['pasien_id'];
    $nama_pasien = $_POST["nama_pasien"];
    $gender = $_POST["gender"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $meetingDate = $_POST["meetingDate"];
    $meetingTime = $_POST["meetingTime"];

    // menggabungkan tanggal dan jam
    $tanggalPertemuan = $meetingDate . ' ' . $meetingTime . ' ';

    // mengUpdate data di database
    $query = "UPDATE pasien 
              SET nama_pasien='$nama_pasien', gender='$gender', tgl_lahir='$tgl_lahir', tgl_pertemuan='$tgl_pertemuan'
              WHERE pasien_id='$pasienId'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => 'Data berhasil diupdate!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal mengupdate data: ' . mysqli_error($conn)];
    }

    header("Location: dashboard.php");
    exit();
}

// mengecek form delete data pasien
if (isset($_POST['delete'])) {
    $pasienId = $_POST['pasien_id'];

    // hapus data dari database
    $query = "DELETE FROM pasien WHERE pasien_id='$pasienId'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => 'Data berhasil dihapus!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal menghapus data: ' . mysqli_error($conn)];
    }

    header("Location: dashboard.php");
    exit();
}
?>