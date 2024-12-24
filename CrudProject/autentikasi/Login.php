<?php
include "../koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Perbaikan di sini
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // Perbaikan di sini
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['username'] = $username;
            echo "Login Berhasil"; // Menambahkan titik koma di sini
            exit;
        } else {
            echo "Password salah";
        }
    } else {
        echo "Username tidak ditemukan";
    }

    $stmt->close();
}

$conn->close();
?>