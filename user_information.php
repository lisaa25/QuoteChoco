<?php
// Memulai sesi
session_start();

// Inisialisasi variabel error_message
$error_message = "";

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Koneksi ke basis data (gantilah dengan detail koneksi sesuai server Anda)
$host = "localhost";
$database = "quotechoco";
$username_db = "root";
$password_db = "";

$conn = new mysqli($host, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah formulir pengubahan dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan perbarui informasi pengguna jika formulir dikirim
    if (isset($_POST['new_username']) && isset($_POST['new_phone']) && isset($_POST['new_address'])) {
        $new_username = $_POST['new_username'];
        $new_phone = $_POST['new_phone'];
        $new_address = $_POST['new_address'];

        // Update informasi pengguna di basis data
        $update_query = "UPDATE tb_user SET nama_pengguna = ?, nomor_telepon = ?, alamat = ? WHERE id_pengguna = ?";
        $update_statement = $conn->prepare($update_query);

        if (!$update_statement) {
            die("Error in query: " . $conn->error);
        }

        $update_statement->bind_param("sssi", $new_username, $new_phone, $new_address, $user_id);

        if ($update_statement->execute()) {
            $error_message = "Informasi pengguna berhasil diperbarui.";
        } else {
            $error_message = "Error in query: " . $conn->error;
        }

        $update_statement->close();
    }

    // Validasi dan perbarui kata sandi jika diatur dalam formulir
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi kata sandi baru
        if ($new_password != $confirm_password) {
            $error_message = "Kata sandi baru tidak cocok dengan konfirmasi kata sandi.";
        } else {
            // Enkripsi kata sandi baru sebelum menyimpan ke basis data
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update kata sandi di basis data
            $update_password_query = "UPDATE tb_user SET kata_sandi = ? WHERE id_pengguna = ?";
            $update_password_statement = $conn->prepare($update_password_query);

            if (!$update_password_statement) {
                die("Error in query: " . $conn->error);
            }

            $update_password_statement->bind_param("si", $hashed_password, $user_id);

            if ($update_password_statement->execute()) {
                $error_message = "Kata sandi berhasil diperbarui.";
            } else {
                $error_message = "Error in query: " . $conn->error;
            }

            $update_password_statement->close();
        }
    }
}

// Query untuk mengambil informasi pengguna berdasarkan ID pengguna
$query = "SELECT id_pengguna, nama_pengguna, nomor_telepon, alamat, email FROM tb_user WHERE id_pengguna = ?";
$statement = $conn->prepare($query);

if (!$statement) {
    die("Error in query: " . $conn->error);
}

$statement->bind_param("i", $user_id);

// Eksekusi query
if ($statement->execute()) {
    // Ambil hasil query
    $result = $statement->get_result();

    // Periksa apakah ada baris hasil
    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $user_data = $result->fetch_assoc();
    } else {
        $error_message = "Tidak ada data pengguna ditemukan.";
    }
} else {
    $error_message = "Error in query: " . $conn->error;
}

// Tutup statement dan koneksi
$statement->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengguna - QuoteChoco</title>

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
    <link rel="stylesheet" href="./css/ui.css">
</head>
<body>
    <!-- Informasi Pengguna Start -->

    <div class="container-ui">
        <h2 class="judul">Informasi Pengguna</h2>

        <?php
        if (!empty($error_message)) {
            echo '<p style="color: red;" class="pesan-error">' . $error_message . '</p>';
        }
        ?>

        <!-- Tampilkan informasi pengguna -->
        <p class="informasi">ID Pengguna : <?php echo $user_data['id_pengguna']; ?></p>
        <p class="informasi">Nama Pengguna : <?php echo $user_data['nama_pengguna']; ?></p>
        <p class="informasi">Nomor Telepon : <?php echo $user_data['nomor_telepon']; ?></p>
        <p class="informasi">Alamat : <?php echo $user_data['alamat']; ?></p>
        <p class="informasi">Email : <?php echo $user_data['email']; ?></p>

        <!-- Tampilkan formulir perubahan informasi pengguna -->
        <form class="edit-user-information" action="" method="post">
            <label for="new_username" class="text-label">Nama Pengguna Baru:</label>
            <input type="text" class="text-input" name="new_username" value="<?php echo $user_data['nama_pengguna']; ?>" required>
            <br>
            <label for="new_phone" class="text-label">Nomor Telepon Baru:</label>
            <input type="text" class="text-input" name="new_phone" value="<?php echo $user_data['nomor_telepon']; ?>" required>
            <br>
            <label for="new_address" class="text-label">Alamat Baru:</label>
            <input type="text" class="text-input" name="new_address" value="<?php echo $user_data['alamat']; ?>" required>
            <br>
            <button type="submit" class="btn-submit">Perbarui Informasi Pengguna</button>
        </form>

        <!-- Tampilkan formulir perubahan kata sandi -->
        <form class="edit-user-information" action="" method="post">
            <label for="new_password" class="text-label">Kata Sandi Baru:</label>
            <input type="password" class="text-input" name="new_password" required>
            <br>
            <label for="confirm_password" class="text-label"s>Konfirmasi Kata Sandi Baru:</label>
            <input type="password" class="text-input" name="confirm_password" required>
            <br>
            <button type="submit" class="btn-submit">Perbarui Kata Sandi</button>
        </form>

        <!-- Tombol Logout -->
        <form action="logout.php" class="btn-container" method="post">
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <!-- Informasi Pengguna End -->

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
