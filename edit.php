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
    $id = $_POST['id'];
    // Ambil data mahasiswa berdasarkan id
    $sql = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nim = $row['nim'];
        $nama = $row['nama'];
        $fakultas = $row['fakultas'];
        $jurusan = $row['jurusan'];
        $alamat = $row['alamat'];
        $jenis_kelamin = $row['jenis_kelamin'];
    } else {
        $_SESSION['error_message'] = "Data tidak ditemukan";
        header("Location: form.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $fakultas = $_POST['fakultas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id = $_POST['id'];

    $sql = "UPDATE mahasiswa SET nim='$nim', nama='$nama', fakultas='$fakultas', jurusan='$jurusan', alamat='$alamat', jenis_kelamin='$jenis_kelamin' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Data berhasil diperbarui";
        header("Location: form.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat memperbarui data: " . $conn->error;
        header("Location: edit.php?id=$id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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
            text-align: center; /* Pusatkan teks di dalam kontainer */
        }
        h1 {
            color: #333;
            text-align: center; /* Hapus margin atas untuk menjaga jarak dari tepi atas kontainer */
        }
        .form-container {
            margin-bottom: 20px;
        }
        /* Gaya lainnya seperti yang sebelumnya */
    </style>
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <?php if (isset($_SESSION['error_message'])) { ?>
        <p><?php echo $_SESSION['error_message']; ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php } ?>
    <form method="post" style="margin-top: 20px; max-width: 500px; margin-left: auto; margin-right: auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div style="margin-bottom: 20px;">
        <label for="nim" style="display: block; font-weight: bold; margin-bottom: 5px;">NIM:</label>
        <input type="text" name="nim" id="nim" value="<?php echo $nim; ?>" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 20px;">
        <label for="nama" style="display: block; font-weight: bold; margin-bottom: 5px;">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 20px;">
        <label for="fakultas" style="display: block; font-weight: bold; margin-bottom: 5px;">Fakultas:</label>
        <input type="text" name="fakultas" id="fakultas" value="<?php echo $fakultas; ?>" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 20px;">
        <label for="jurusan" style="display: block; font-weight: bold; margin-bottom: 5px;">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" value="<?php echo $jurusan; ?>" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 20px;">
        <label for="alamat" style="display: block; font-weight: bold; margin-bottom: 5px;">Alamat:</label>
        <textarea name="alamat" id="alamat" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; resize: none;"><?php echo $alamat; ?></textarea>
    </div>
    <div style="margin-bottom: 20px;">
        <label for="jenis_kelamin" style="display: block; font-weight: bold; margin-bottom: 5px;">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required style="padding: 10px; width: calc(100% - 20px); border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            <option value="Laki-laki" <?php if ($jenis_kelamin == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected"; ?>>Perempuan</option>
        </select>
    </div>
    <div style="text-align: center;">
    <button type="submit" name="update" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
    <button type="submit" style="padding: 10px 20px; background-color: blueviolet; color: white; border: none; border-radius: 4px; cursor: pointer;"><a href="form.php" style="text-decoration: none; color: white;">Cancel</a></button>
</div>

</form>
</body>
</html>
