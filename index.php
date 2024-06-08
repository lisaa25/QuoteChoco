<?php

// Inisialisasi variabel error_message
$error_message = "";

// Koneksi ke basis data (gantilah dengan detail koneksi sesuai server Anda)
$host = "localhost";
$database = "quotechoco";
$username_db = "root";
$password_db = "";

$conn = new mysqli($host, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QuoteChoco</title>

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
    <link rel="stylesheet" href="./css/style.css" />
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
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Catalog</a>
        <a href="#products">Produk</a>
        <a href="#contact">Kontak</a>
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

      <!-- Shopping Cart start -->
      <div class="shopping-cart">
        <div class="cart-item">
          <img src="img/products/1.jpg" alt="Product 1" />
          <div class="item-detail">
            <h3>Product 1</h3>
            <div class="item-price">IDR 30K</div>
          </div>
          <i data-feather="trash-2" class="remove-item"></i>
        </div>
        <div class="cart-item">
          <img src="img/products/1.jpg" alt="Product 1" />
          <div class="item-detail">
            <h3>Product 1</h3>
            <div class="item-price">IDR 30K</div>
          </div>
          <i data-feather="trash-2" class="remove-item"></i>
        </div>
        <div class="cart-item">
          <img src="img/products/1.jpg" alt="Product 1" />
          <div class="item-detail">
            <h3>Product 1</h3>
            <div class="item-price">IDR 30K</div>
          </div>
          <i data-feather="trash-2" class="remove-item"></i>
        </div>
      </div>
      <!-- Shopping Cart end -->
    </nav>
    <!-- Navbar end -->

    <!-- Hero Section start -->
    <section class="hero" id="home">
      <img src="./img/home/salad_buah.png" alt="Banner" class="banner" />
      <div class="mask-container">
        <main class="content">
          <h1>Mari Nikmati Roti dan<span>Kue</span></h1>
          <p>Bagikan kebahagiaan bersama QuoteChoco.</p>
        </main>
      </div>
    </section>
    <!-- Hero Section end -->

    <!-- About Section start -->
    <section id="about" class="about">
      <h2>Tentang <span class="kami">Kami</span></h2>

      <div class="row">
        <div class="about-img">
          <img
            src="./img/home/mini_dessert_package.png"
            alt="Tentang Kami"
            class="img-about-us"
          />
        </div>
        <div class="content">
          <h3>Kenapa memilih QuoteChoco?</h3>
          <p>
            Karena QuoteChoco menyediakan berbagai jenis produk kue dan roti.
          </p>
          <br />
          <br />
          <p>
            Pemesanan atau order dapat dilakukan dengan memesan tiga hari
            sebelum tanggal pengambilan.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section end -->

    <!-- Menu Section start -->
    <section id="menu" class="menu">
      <h2>Catalog <span class="kami">Kami</span></h2>
      <p>
        QuoteChoco memiliki banyak varian pesanan seperti Homemade Rollcake,
        Premium Kue Klasik, Hampers & Snack.
      </p>

      <div class="row">
        <div class="menu-card">
          <img
            src="img/catalog/christmas_cake/almond_dessert.jpg"
            alt="Cake"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Cake -</h3>
          <p class="menu-card-price">
            Temukan kelezatan dalam<br />setiap koleksi cake kami.
          </p>
        </div>
        <div class="menu-card">
          <img
            src="img/catalog/brownies/choco_brownies.jpg"
            alt="Brownies"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Brownies -</h3>
          <p class="menu-card-price">
            Hadirkan kebahagiaan setiap<br />saat dengan brownies kami.
          </p>
        </div>
        <div class="menu-card">
          <img
            src="img/catalog/hampers/puding_box_for_hampers.jpg"
            alt="Hampers"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Hampers -</h3>
          <p class="menu-card-price">
            Sampaikan kebahagiaan dengan<br />hampers eksklusif kami.
          </p>
        </div>
        <div class="menu-card">
          <img
            src="img/catalog/puding/choco_vanila_puding.jpg"
            alt="Puding"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Puding -</h3>
          <p class="menu-card-price">
            Jelajahi keanekaragaman<br />pilihan puding kami
          </p>
        </div>
        <div class="menu-card">
          <img
            src="IMK/kue soes/kue_soes_jadul.png"
            alt="Kue Soes"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Kue Soes -</h3>
          <p class="menu-card-price">
            Nikmati kelembutan kue soes<br />kami yang lezat.
          </p>
        </div>
        <div class="menu-card">
          <img
            src="img/catalog/cookies/kastengel.jpg"
            alt="Cookies"
            class="menu-card-img"
          />
          <h3 class="menu-card-title">- Cookies -</h3>
          <p class="menu-card-price">
            Raih kebahagiaan dalam setiap<br />gigitan cookies kami.
          </p>
        </div>
      </div>
    </section>
    <!-- Menu Section end -->

    <!-- Products Section start -->
    <section class="products" id="products">
      <h2>Produk <span class="kami">Kami</span></h2>
      <p>
        Seluruh produk kami terbuat dari bahan premium dan dibuat 24 jam sebelum
        waktu pengambilan.
      </p>

      <div class="row" id="product-list">

            <?php

            $sql = "SELECT * FROM tb_produk";
            $result = $conn->query( $sql);

            if ($result->num_rows> 0) {
                while($row = $result->fetch_assoc()) {
            
            ?>

        <div class="product-card" id="product-nastar">
          <div class="product-icons">
            <a href="#"><i data-feather="shopping-cart"></i></a>
            <a href="#" class="item-detail-button" data-product-id="nastar"
              ><i data-feather="eye"></i
            ></a>
          </div>
          <div class="product-image">
            <img src="<?= $row ["gambar"] ?>" alt="Product 1" />
          </div>
          <div class="product-content">
            <h3><?= $row ["nama_produk"] ?></h3>
            <div class="product-stars">
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star"></i>
            </div>
            <div class="product-price"><?= $row ["harga"] ?></div>
          </div>
        </div>

        <?php

          }
        } else {
            echo " 0 results";
        }

        ?>

      </div>
    </section>
    <!-- Products Section end -->

    <!-- Contact Section start -->
    <section id="contact" class="contact">
      <h2>Kontak <span class="kami">Kami</span></h2>
      <p>Silahkan hubungi kami jika Anda memiliki pertanyaan.</p>

      <div class="row">
        <iframe
          src="https://maps.google.com/maps?q=purwokerto&t=&z=13&ie=UTF8&iwloc=&output=embed"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map"
        ></iframe>

        <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="nama" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="email" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="no hp" />
          </div>
          <button type="submit" class="btn">kirim pesan</button>
        </form>
      </div>
    </section>
    <!-- Contact Section end -->

    <!-- Footer start -->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/quotechoco/"
          ><i data-feather="instagram"></i
        ></a>
        <a href="https://wa.me/6285227043463"><i data-feather="phone"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Catalog</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">AllWaysDev</a>. | &copy; 2024.</p>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- Modal Box Item Detail start -->

    <div class="modal" id="item-detail-modal">
      <div class="modal-container">

        <?php      
        
        $sql = "SELECT * FROM tb_produk";

        $result = $conn->query( $sql);
        if ($result->num_rows> 0) {

            while($row = $result->fetch_assoc()) {
            
        ?>

        <a href="#" class="close-icon"><i data-feather="x"></i></a>
        <div class="modal-content" id="modal-content-nastar">
          <img src="<?= $row ["gambar"] ?>" alt="<?= $row ["nama_produk"] ?>" />
          <div class="product-content">
            <h3><? $row ["nama_produk"] ?></h3>
            <p>
              <?= $row ["deskripsi"] ?>
            </p>
            <div class="product-stars">
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star"></i>
            </div>
            <div class="product-price"><?= $row ["harga"] ?></div>
            <a href="#" class="add-to-cart-btn" data-product-id="<?= $row ["id_produk"] ?>"><i data-feather="shopping-cart"></i> <span>add to cart</span></a
            >
          </div>
        </div>

        <?php

          }
        } else {
            echo " 0 results";
        }

        ?>

      </div>
    </div>

    <!-- Modal Box Item Detail end -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="js/script.js"></script>
  </body>
</html>
