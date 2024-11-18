<?php
include 'db/db.php';

// Proses pendaftaran
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Menyimpan data pengguna ke database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
    if ($conn->query($query)) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Alfajr</title>
</head>
<body>
    <h1>Daftar</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Masuk di sini</a>.</p>
</body>
</html>
