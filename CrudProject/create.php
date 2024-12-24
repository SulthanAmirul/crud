<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = substr(preg_replace('/[^0-9]/', '', $_POST["phone"]), 0, 13);

    $conn = new mysqli("localhost", "root", "", "crud_db");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO pendaftar (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form user</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(247, 177, 177);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color:rgb(104, 76, 175);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color:rgb(104, 76, 175);
        }
        form label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>