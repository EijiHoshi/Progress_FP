<?php
session_start();
include 'db/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfajr - Pemesanan Tiket Transportasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #6a4c9c; /* Ungu lebih gelap untuk header */
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            margin: 20px;
            text-align: center;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #6a4c9c; /* Warna ungu pada tautan */
        }
        nav a:hover {
            color: #C3B1E1; /* Warna ungu muda saat hover */
        }
        .dashboard {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .dashboard h2 {
            color: #333;
        }
        footer {
            background-color: #C3B1E1; /* Warna ungu muda */
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang di Alfajr</h1>
    </header>

    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Home</a>
            <a href="pesan_tiket.php">Pesan Tiket</a>
            <a href="logout.php">Keluar</a>
        <?php else: ?>
            <a href="login.php">Masuk</a> | <a href="register.php">Daftar</a>
        <?php endif; ?>
    </nav>

    <div class="dashboard">
        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Dashboard Pengguna</h2>
            <p>Halo, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Pengguna'; ?>!</p>
            <p>Selamat datang di dashboard pemesanan tiket Transportasi AlFajr. Anda bisa memesan tiket perjalanan atau melihat riwayat pemesanan Anda.</p>
            
            <h3>Pilih Aksi</h3>
            <ul>
                <li><a href="pesan_tiket.php">Pesan Tiket</a></li>
                <li><a href="riwayat_pemesanan.php">Lihat Riwayat Pemesanan</a></li>
            </ul>
        <?php else: ?>
            <h2>Anda Belum Masuk</h2>
            <p>Silakan <a href="login.php">Masuk</a> atau <a href="register.php">Daftar</a> untuk melanjutkan pemesanan tiket.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> Travel Alfajr. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
