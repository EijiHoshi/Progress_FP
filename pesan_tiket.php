<?php
session_start();
include 'db/db.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Variabel untuk menyimpan error atau pesan sukses
$error = '';
$success = '';

// Proses pemesanan tiket
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $tanggal_perjalanan = $_POST['tanggal_perjalanan'];
    $jenis_transportasi = $_POST['jenis_transportasi'];
    $tujuan = $_POST['tujuan'];

    // Validasi input
    if (empty($tanggal_perjalanan) || empty($jenis_transportasi) || empty($tujuan)) {
        $error = 'Semua kolom harus diisi!';
    } else {
        // Menyimpan pemesanan tiket ke database
        $query = "INSERT INTO pemesanan (user_id, tanggal_perjalanan, jenis_transportasi, tujuan) 
                  VALUES ('$user_id', '$tanggal_perjalanan', '$jenis_transportasi', '$tujuan')";

        if ($conn->query($query)) {
            $success = 'Tiket berhasil dipesan!';
        } else {
            $error = 'Gagal memesan tiket, coba lagi.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket - Alfajr</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #6a4c9c; /* Ungu gelap untuk header */
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 16px;
            margin-bottom: 5px;
        }
        input, select, button {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button {
            background-color: #6a4c9c; /* Ungu gelap untuk tombol */
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #5a3e8a; /* Ungu lebih gelap saat hover */
        }
        .message {
            text-align: center;
            margin: 10px 0;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6a4c9c; /* Warna ungu pada link */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>Pemesanan Tiket Transportasi - Alfajr</h1>
</header>

<div class="container">
    <?php if ($error): ?>
        <div class="message error"><?= $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="message success"><?= $success; ?></div>
    <?php endif; ?>

    <!-- Formulir Pemesanan Tiket -->
    <form method="post" action="">
        <label for="tanggal_perjalanan">Tanggal Perjalanan:</label>
        <input type="date" id="tanggal_perjalanan" name="tanggal_perjalanan" required>

        <label for="jenis_transportasi">Jenis Transportasi:</label>
        <select id="jenis_transportasi" name="jenis_transportasi" required>
            <option value="Bus">Bus</option>
            <option value="Kereta">Kereta</option>
            <option value="Pesawat">Pesawat</option>
            <option value="Kapal">Kapal</option>
        </select>

        <label for="tujuan">Tujuan:</label>
        <input type="text" id="tujuan" name="tujuan" required>

        <button type="submit">Pesan Tiket</button>
    </form>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</div>

</body>
</html>
