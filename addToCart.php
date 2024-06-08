<?php
// addToCart.php

// Inisialisasi koneksi ke database (sama seperti yang sudah Anda lakukan sebelumnya)
$servername = "localhost";
$database = "quotechoco";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("koneksi gagal:" . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data produk dari request
    $productId = $_POST["product_id"];

    // Gantilah dengan nama tabel dan kolom yang sesuai
    $insertQuery = "INSERT INTO tb_keranjang_belanja (id_pengguna, id_produk, nama_produk, harga) 
                    VALUES (1, '$productId', 'Nama Produk', 'Harga Produk')";

    // Jalankan query
    if ($conn->query($insertQuery) === TRUE) {
        // Berhasil ditambahkan ke keranjang
        $response = array("status" => "success", "message" => "Produk berhasil ditambahkan ke keranjang.");
        echo json_encode($response);
    } else {
        // Gagal menambahkan ke keranjang
        $response = array("status" => "error", "message" => "Gagal menambahkan produk ke keranjang: " . $conn->error);
        echo json_encode($response);
    }

    // Tutup koneksi
    $conn->close();
}
?>
