<?php
session_start();
include 'db/db.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil riwayat pemesanan tiket pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM pemesanan WHERE user_id = '$user_id' ORDER BY tanggal_perjalanan DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Alfajr</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #6a4c9c; /* Warna ungu */
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin: 20px 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6a4c9c; /* Ungu gelap */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #6a4c9c; /* Warna ungu pada link */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
        .message a {
            color: #6a4c9c;
        }
        footer {
            background-color: #6a4c9c;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Riwayat Pemesanan Tiket - Alfajr</h1>
</header>

<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Perjalanan</th>
                    <th>Jenis Transportasi</th>
                    <th>Tujuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tanggal_perjalanan'] ?></td>
                        <td><?= $row['jenis_transportasi'] ?></td>
                        <td><?= $row['tujuan'] ?></td>
                        <td>
                            <!-- Tambahkan action jika diperlukan, misalnya untuk mengedit atau membatalkan pemesanan -->
                            <a href="edit_pemesanan.php?id=<?= $row['id'] ?>">Edit</a> |
                            <a href="hapus_pemesanan.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="message">Anda belum memiliki riwayat pemesanan tiket. <a href="pesan_tiket.php">Pesan tiket sekarang</a>.</p>
    <?php endif; ?>

    <div class="message">
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y'); ?> Travel Alfajr. Semua Hak Dilindungi.</p>
</footer>

</body>
</html>
