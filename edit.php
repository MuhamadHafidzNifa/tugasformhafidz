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
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <?php if (isset($_SESSION['error_message'])) { ?>
        <p><?php echo $_SESSION['error_message']; ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php } ?>
    <form method="post" style="margin-top: 20px;">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div style="margin-bottom: 10px;">
        <label for="nim" style="display: block; font-weight: bold;">NIM:</label>
        <input type="text" name="nim" id="nim" value="<?php echo $nim; ?>" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="nama" style="display: block; font-weight: bold;">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="fakultas" style="display: block; font-weight: bold;">Fakultas:</label>
        <input type="text" name="fakultas" id="fakultas" value="<?php echo $fakultas; ?>" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="jurusan" style="display: block; font-weight: bold;">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" value="<?php echo $jurusan; ?>" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="alamat" style="display: block; font-weight: bold;">Alamat:</label>
        <textarea name="alamat" id="alamat" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; resize: none;"><?php echo $alamat; ?></textarea>
    </div>
    <div style="margin-bottom: 10px;">
        <label for="jenis_kelamin" style="display: block; font-weight: bold;">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required style="padding: 8px; width: 100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            <option value="Laki-laki" <?php if ($jenis_kelamin == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected"; ?>>Perempuan</option>
        </select>
    </div>
    <div>
        <button type="submit" name="update" style="padding: 8px 12px; background-color: #4caf50; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Update</button>
    </div>
</form>

</body>
</html>
