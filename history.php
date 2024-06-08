<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Besley:ital,wght@0,400;0,600;0,800;1,400;1,600;1,800&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/history.css">
</head>
<body>

<!-- Navbar start -->
<nav class="navbar">
      <a href="#" class="navbar-logo"
        ><img
          src="./img/home/logo_new.png"
          alt="QuoteChoco Logo"
          class="logo"
        /><span class="quote">Quote</span><span class="choco">Choco</span></a
      >

      <form action="" method="get" class="search-form" id="search-form">
        <input type="search" id="search-box" name="query" placeholder="Search Here..."/>
        <button type="submit"><i data-feather="search"></i></button>
      </form>

      <div class="navbar-nav">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">Tentang Kami</a>
        <a href="index.php#menu">Catalog</a>
        <a href="index.php#products">Produk</a>
        <a href="index.php#contact">Kontak</a>
      </div>

      <div class="navbar-toggle">
        <a href="./user_information.php" id="user-info-link"
          >Informasi Pengguna</a
        >
        <a href="./shopping_cart.php">Keranjang Belanja</a>
        <a href="./history.php">Riwayat Pembelian</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="search-button"><i data-feather="search"></i></a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>

      <!-- Search Form start -->
      <div class="search-form">
        <input type="search" id="search-box" placeholder="search here..." />
        <label for="search-box"><i data-feather="search"></i></label>
      </div>
      <!-- Search Form end -->
    </nav>
    <!-- Navbar end -->

<!-- Main Content -->
<main>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembelian</th>
                <th>Total Harga</th>
                <th>Detail Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through purchase history from the database -->
            <?php
                // Retrieve purchase history from tb_riwayat_pembelian
                // Perform database connection and query here

                // Example data (replace with your database retrieval logic)
                $purchaseHistory = [
                    ["id_pembelian" => 1, "tanggal_pembelian" => "2024-01-31", "total_harga" => 150000],
                    ["id_pembelian" => 2, "tanggal_pembelian" => "2024-02-15", "total_harga" => 250000],
                ];

                foreach ($purchaseHistory as $index => $purchase) {
            ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $purchase["tanggal_pembelian"] ?></td>
                <td>IDR <?= number_format($purchase["total_harga"], 2) ?></td>
                <td><a href="detail_pembelian.php?id=<?= $purchase["id_pembelian"] ?>">Detail</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Footer start -->
<footer>
      <div class="socials">
        <a href="https://www.instagram.com/quotechoco/"
          ><i data-feather="instagram"></i
        ></a>
        <a href="https://wa.me/6285227043463"><i data-feather="phone"></i></a>
      </div>

      <div class="links">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">Tentang Kami</a>
        <a href="index.php#menu">Catalog</a>
        <a href="index.php#contact">Kontak</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">AllWaysDev</a>. | &copy; 2024.</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

</body>
</html>
