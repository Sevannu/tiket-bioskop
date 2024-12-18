<?php 
require_once "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= deskripsi; ?>">
    <meta name="author" content="<?= admin; ?>">
    <title><?= nama; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
</head>

<body>
    <?php include "header.phtml"; ?>

    <!-- Page Content -->
    <div class="container">
        <h1 class="my-4">Selamat Datang di <?= nama; ?></h1>

        <!-- Portfolio Section -->
        <h2>Film Yang Sedang Tayang</h2>
        <div class="row">
            <?php
            // Query untuk mendapatkan data film yang sedang tayang
            $query = "SELECT film.id_film, film.judul, film.image, tayang.jam1, tayang.jam2, tayang.jam3 
                      FROM tayang 
                      INNER JOIN film ON tayang.id_film = film.id_film 
                      WHERE CURDATE() BETWEEN tayang.tanggal_awal AND tayang.tanggal_akhir";

            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($film = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <!-- Gambar Film -->
                            <a href="order.php?id=<?= $film['id_film']; ?>">
                                <img class="card-img-top" src="asset/<?= htmlspecialchars($film['image']); ?>" alt="<?= htmlspecialchars($film['judul']); ?>">
                            </a>
                            <div class="card-body">
                                <!-- Judul Film -->
                                <h4 class="card-title">
                                    <a href="order.php?id=<?= $film['id_film']; ?>"><?= htmlspecialchars($film['judul']); ?></a>
                                </h4>
                                <!-- Jam Tayang -->
                                <p class="card-text">
                                    Jam Tayang: 
                                    <?= htmlspecialchars($film['jam1']); ?> | 
                                    <?= htmlspecialchars($film['jam2']); ?> | 
                                    <?= htmlspecialchars($film['jam3']); ?>
                                </p>
                                <!-- Link ke Sinopsis -->
                                <a href="detail.php?id=<?= $film['id_film']; ?>">Lihat Sinopsis</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Pesan jika tidak ada film tayang
                echo "<p class='text-center'>Tidak ada film yang sedang tayang saat ini.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; <?= nama; ?> <?= date('Y'); ?></p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
