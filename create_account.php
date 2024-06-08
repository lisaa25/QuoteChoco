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

// Logika pendaftaran pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan nilai dari formulir pendaftaran
    $nama_pengguna = $_POST['nama_pengguna'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $email = trim($_POST['email']);
    $kata_sandi = trim($_POST['kata_sandi']);
    $konfirmasi_kata_sandi = trim($_POST['konfirmasi_kata_sandi']);

    // Validasi input (contoh sederhana, sesuaikan dengan kebutuhan)
    if (empty($nama_pengguna) || empty($email) || empty($kata_sandi) || empty($konfirmasi_kata_sandi)) {
        $error_message = "Semua kolom harus diisi";
    } elseif ($kata_sandi != $konfirmasi_kata_sandi) {
        $error_message = "Konfirmasi kata sandi tidak sesuai";
    } else {
        // Koneksi ke basis data (gantilah dengan detail koneksi sesuai server Anda)
        $host = "localhost";
        $database = "quotechoco";
        $username_db = "root";
        $password_db = "";

        $conn = new mysqli($host, $username_db, $password_db, $database);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Enkripsi kata sandi sebelum menyimpan ke basis data
        $hashed_password = password_hash($kata_sandi, PASSWORD_DEFAULT);

        // Menyimpan informasi pengguna ke dalam basis data
        $query = "INSERT INTO tb_user (nama_pengguna, nomor_telepon, alamat, email, kata_sandi) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("sssss", $nama_pengguna, $nomor_telepon, $alamat, $email, $hashed_password);

        if ($statement->execute()) {
            // Pendaftaran berhasil
            // Anda dapat menambahkan logika lain di sini, misalnya mengirim email konfirmasi, dll.

            // Mengarahkan ke halaman informasi_pengguna.php
            header("Location: user_information.php");
            exit();
        } else {
            // Pendaftaran gagal
            $error_message = "Pendaftaran pengguna gagal";
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
    <title>Buat Akun - QuoteChoco</title>

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
    <link rel="stylesheet" href="./css/ca.css">
    
    <!-- Tambahkan stylesheet, script, dan tag meta lainnya sesuai kebutuhan -->
</head>
<body>
  <!-- Formulir Create Account Start -->
  <form class="form" method="POST" action="">
      <h2 class="judul">Buat Akun</h2>
      <?php
      if (!empty($error_message)) {
          echo '<p style="color: red;">' . $error_message . '</p>';
      }
      ?>
      <label for="nama_pengguna" class="text-label">Nama Lengkap:</label>
      <input type="text" class="text-input" id="nama_pengguna" name="nama_pengguna" required>
      <label for="nomor_telepon" class="text-label">Nomor Telepon:</label>
      <input type="text" class="text-input" id="nomor_telepon" name="nomor_telepon">
      <label for="alamat" class="text-label">Alamat:</label>
      <input type="text" class="text-input" id="alamat" name="alamat">
      <label for="email" class="text-label">Email:</label>
      <input type="email" class="text-input" id="email" name="email" required>
      <label for="kata_sandi" class="text-label">Kata Sandi:</label>
      <input type="password" class="text-input" id="kata_sandi" name="kata_sandi" required>
      <label for="konfirmasi_kata_sandi" class="text-label">Konfirmasi Kata Sandi:</label>
      <input type="password" class="text-input" id="konfirmasi_kata_sandi" name="konfirmasi_kata_sandi" required>
      <button type="submit" class="btn-daftar">Daftar</button>
  </form>
  <!-- Formulir Create Account End -->

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
      <a href="index.phpl#about">Tentang Kami</a>
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
