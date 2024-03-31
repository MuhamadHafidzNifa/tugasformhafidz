<?php
session_start();

// Periksa apakah form login telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa kredensial
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Anda dapat memeriksa kredensial ke database di sini
    // Misalnya, jika menggunakan tabel 'users':
    // SELECT * FROM users WHERE username = '$username' AND password = '$password'
    // Jika kredensial cocok, maka atur sesi dan arahkan ke halaman lain

    // Contoh sederhana:
    if ($username === "admin" && $password === "12345") {
        // Atur sesi
        $_SESSION['username'] = $username;
        // Redirect ke halaman lain
        header("Location: form.php");
        exit(); // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
    } else {
        echo "Username atau password salah.";
    }
}
?>
