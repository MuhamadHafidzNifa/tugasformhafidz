<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil id dari data yang akan dihapus
    $id = $_POST['id'];

    // Buat dan jalankan query DELETE
    $sql = "DELETE FROM mahasiswa WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data berhasil dihapus";
    } else {
        $_SESSION['success_message'] = "Data gagal dihapus";
    }
}

// Redirect kembali ke halaman form
header("Location: form.php");
exit();
?>
