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

// Periksa apakah formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $email = $_POST['email'];
    $nama_pengguna = $_POST['nama_pengguna'];

    // Periksa apakah pengguna dengan email dan nama pengguna yang diberikan ada di basis data
    $query = "SELECT id_pengguna FROM tb_user WHERE email = ? AND nama_pengguna = ?";
    $statement = $conn->prepare($query);

    if (!$statement) {
        die("Error in query: " . $conn->error);
    }

    $statement->bind_param("ss", $email, $nama_pengguna);

    // Eksekusi query
    if ($statement->execute()) {
        // Ambil hasil query
        $result = $statement->get_result();

        // Periksa apakah ada baris hasil
        if ($result->num_rows > 0) {
            // Redirect ke halaman reset_password.php dengan menyertakan email pengguna
            header("Location: reset_password.php?email=" . $email);
            exit();
        } else {
            $error_message = "Email dan Nama Pengguna tidak cocok atau tidak terdaftar.";
        }
    } else {
        $error_message = "Error in query: " . $conn->error;
    }

    // Tutup statement
    $statement->close();
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>

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
    <link rel="stylesheet" href="./css/fp.css">

</head>
<body>
    <!-- Form Lupa Kata Sandi  Start -->
    <div class="container-forgot-password">
        <h2 class="judul">Lupa Kata Sandi</h2>

        <?php
        if (!empty($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>

        <form action="" method="post">
            <label for="email" class="text-label">Email:</label>
            <input type="email" class="text-input" name="email" required>
            <br>
            <label for="nama_pengguna" class="text-label">Nama Pengguna:</label>
            <input type="text" class="text-input" name="nama_pengguna" required>
            <br>
            <button type="submit" class="btn-reset">Reset Kata Sandi</button>
        </form>
    </div>
    <!-- Form Lupa Kata Sandi End -->

    <!-- Navbar Start -->
    <nav class="navbar">
    <a href="index.html#home" class="navbar-logo"
      ><img
        src="./img/home/logo_new.png"
        alt="QuoteChoco Logo"
        class="logo"
      /><span class="quote">Quote</span><span class="choco">Choco</span></a
    >

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
      <a href="#shopping-cart">Keranjang Belanja</a>
      <a href="#History">Riwayat Pembelian</a>
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
  <!-- Navbar End -->

  <!-- Footer Start -->
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
  <!-- Footer End -->

  <!-- Feather Icons -->
  <script>
    feather.replace();
  </script>

  <!-- My Javascript -->
  <script src="js/script.js"></script>
</body>
</html>
