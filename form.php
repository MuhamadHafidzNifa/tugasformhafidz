<?php
session_start();
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $fakultas = $_POST['fakultas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    $sql = "INSERT INTO mahasiswa (nim, nama, fakultas, jurusan, alamat, jenis_kelamin) VALUES ('$nim', '$nama', '$fakultas', '$jurusan', '$alamat', '$jenis_kelamin')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data berhasil ditambahkan";
        header("Location: form.php");
        exit();
    } else {
        $_SESSION['success_message'] = "Data gagal ditambahkan";
        header("Location: form.php");
        exit();
    }
}

?>

<?php

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form by Hafidz Nifa</title>
    <link rel="shortcut icon" href="Logo Unpam Berwarna.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .input-description {
            color: #6c757d; /* Warna teks untuk deskripsi */
            opacity: 0.9;
            font-size: 12px;
            font-style:normal;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group button[type="submit"],
        .form-group button[type="reset"] {
            padding: 8px 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button[type="reset"] {
            background-color: #f44336;
            margin-left: 10px;
        }

        .form-group button[type="reset"] a {
            text-decoration: none;
            color: #fff;
        }

        .form-group button[type="reset"] a:hover {
            text-decoration: underline;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 2px solid #000;
            border-radius: 15px;
        }

        figcaption {
            font-size: 18px;
            background-color: blueviolet;
            color: white;
            padding: 3px 3px;
            text-align: center;
            border: 3px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form bikinan Muhamad Hafidz Nifa yang dibantu oleh Naufal Pambudi dan ChatGPT</h1>
        <?php if (isset($success_message)) { ?>
            <h2><?php echo $success_message; ?></h2>
        <?php } ?>
        <div class="form-container">
            <h2>Formulir Mahasiswa</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input name="nim" id="nim" type="text" placeholder="Masukkan NIM Kamu" required>
                    <small class="input-description"> * Hanya menerima input berupa angka</small>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input name="nama" id="nama" type="text" placeholder="Masukkan Nama Kamu" required>
                </div>
                <div class="form-group">
                    <label for="fakultas">Fakultas</label>
                    <input name="fakultas" id="fakultas" type="text" placeholder="Contoh: Teknik" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input name="jurusan" id="jurusan" type="text" placeholder="Contoh: Informatika" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" style="resize: none;" placeholder="Masukkan Alamat Kamu" required></textarea>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Submit Disini</button>
                    <button type="reset"><a href="form.php">Reset</a></button>
                </div>
            </form>
        </div>
        <div class="image-container">
            <img src="ja.jpg" alt="Gambar" width="600">
            <figcaption>Jannibatur Aiman</figcaption>
        </div>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Fitur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM mahasiswa";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $row["nim"]; ?></td>
                            <td><?php echo $row["nama"]; ?></td>
                            <td><?php echo $row["fakultas"]; ?></td>
                            <td><?php echo $row["jurusan"]; ?></td>
                            <td><?php echo $row["alamat"]; ?></td>
                            <td><?php echo $row["jenis_kelamin"]; ?></td>
                            <td>
    <form method="post" action="delete.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit">Hapus</button>
    </form>
    <br>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit">Edit</button>
    </form>
</td>

                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="6">Data di Database Kosong</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body
