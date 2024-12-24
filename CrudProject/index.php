<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>

        <form id="searchForm" action="index.php" method="GET" class="d-flex mb-3" style="max-width: 400px;">
            <input class="form-control me-2" type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "crud_db");

                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $conn->real_escape_string($_GET['search']);
                        $sql = "SELECT * FROM pendaftar WHERE name LIKE '%$search%'";
                    } else {
                        $sql = "SELECT * FROM pendaftar";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row["id"]) . "</td>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td>" . htmlspecialchars($row["phone"]) . "</td>
                                <td>
                                    <a href='update.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'><i class='bi bi-pencil-fill'></i> Edit</a>
                                    <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i> Hapus</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada hasil ditemukan.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            var searchInput = document.getElementById('searchInput').value.trim();
            if (searchInput === "") {
                e.preventDefault();
                window.location.href = 'index.php';
            }
        });
    </script>
</body>
</html>
