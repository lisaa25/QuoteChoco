<?php
// Memulai sesi
session_start();

// Inisialisasi variabel error_message
$error_message = "";

// Jika pengguna sudah login, arahkan ke halaman informasi_pengguna.php
if (isset($_SESSION['user_id'])) {
    header("Location: user_information.php");
    exit();
}

// Logika otentikasi pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan nilai dari formulir login
    $email = trim($_POST['email']);
    $kata_sandi = trim($_POST['kata_sandi']);

    // Validasi input email menggunakan filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid";
    } elseif (empty($kata_sandi)) {
        $error_message = "Kata sandi harus diisi";
    } else {
        // Koneksi ke basis data (gantilah dengan detail koneksi sesuai server Anda)
        $host = "localhost";
        $database = "quotechoco";
        $username_db = "root";
        $password_db = "";

        $conn = new mysqli($host, $username_db, $password_db, $database);

        // Error handling di koneksi basis data
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Melakukan otentikasi pengguna menggunakan prepared statement
        $query = "SELECT id_pengguna, nama_pengguna, kata_sandi FROM tb_user WHERE email = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $email);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            // Otentikasi berhasil
            $statement->bind_result($user_id, $nama_pengguna, $hashed_password);
            $statement->fetch();

            // Verifikasi kata sandi dengan password_verify
            if (password_verify($kata_sandi, $hashed_password)) {
                // Menyimpan informasi pengguna dalam sesi
                $_SESSION['user_id'] = $user_id;
                $_SESSION['nama_pengguna'] = $nama_pengguna;

                // Regenerasi ID sesi
                session_regenerate_id(true);

                // Mengarahkan ke halaman informasi_pengguna.php
                header("Location: ./user_information.php");
                exit();
            } else {
                // Otentikasi gagal
                $error_message = "Email atau kata sandi salah";
            }
        } else {
            // Otentikasi gagal
            $error_message = "Email atau kata sandi salah";
        }

        $statement->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuoteChoco</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Besley:ital,wght@0,400;0,600;0,800;1,400;1,600;1,800&display=swap"
      rel="stylesheet"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./css//login.css">
</head>
<body>
  <!-- Formulir Login Start -->
  <form class="form" method="POST" action="">
      <h2 class="judul">Login</h2>
      <?php
      if (!empty($error_message)) {
          echo '<p style="color: red;">' . $error_message . '</p>';
      }
      ?>
      <label for="email" class="text-label">Email:</label>
      <input type="text" class="text-input" id="email" name="email" required>
      <br />
      <label for="kata_sandi" class="text-label">Password:</label>
      <input type="password" class="text-input" id="kata_sandi" name="kata_sandi" required>
      <br />
      <a href="./forgot_password.php"><span class="text-lca">Lupa kata sandi</span></a>
      <br style="line-height: 2px;">
      <a href="./create_account.php"><span class="text-lca">Buat akun</span></a>
      <br />
      <button type="submit" class="btn-login">Login</button>
  </form>
  <!-- Formulir Login End -->

  <!-- Navbar Start -->

  <nav class="navbar">
    <a href="index.php#home" class="navbar-logo"
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

  <!-- My Javascript -->
  <script src="js/script.js"></script>

</body>
</html>
