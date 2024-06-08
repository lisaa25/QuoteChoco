<?php
// process_checkout.php

// Inisialisasi koneksi ke database (sama seperti yang sudah Anda lakukan sebelumnya)
$servername = "localhost";
$database = "quotechoco";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("koneksi gagal:" . mysqli_connect_error());
}
// Mengambil data dari formulir checkout
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$metode_pembayaran = $_POST['metode_pembayaran'];

// Simpan data ke tabel pembelian (gantilah 'tb_pembelian' dengan nama tabel yang sesuai)
$insertQuery = "INSERT INTO tb_pembelian (nama, alamat, metode_pembayaran) VALUES ('$nama', '$alamat', '$metode_pembayaran')";

if ($conn->query($insertQuery) === TRUE) {
    // Dapatkan ID pembelian yang baru saja dibuat
    $id_pembelian = $conn->insert_id;

    // Mendapatkan data keranjang belanja dari tabel tb_keranjang_belanja (gantilah 'tb_keranjang_belanja' dengan nama tabel yang sesuai)
    $cartQuery = "SELECT * FROM tb_keranjang_belanja";
    $cartResult = $conn->query($cartQuery);

    // Loop melalui data keranjang belanja dan menyimpannya ke tabel pembelian_detail (gantilah 'tb_pembelian_detail' dengan nama tabel yang sesuai)
    while ($cartItem = $cartResult->fetch_assoc()) {
        $id_produk = $cartItem['id_produk'];
        $nama_produk = $cartItem['nama_produk'];
        $harga = $cartItem['harga'];
        $jumlah = $cartItem['jumlah'];

        // Simpan data ke tabel pembelian_detail
        $insertDetailQuery = "INSERT INTO tb_pembelian_detail (id_pembelian, id_produk, nama_produk, harga, jumlah) 
                              VALUES ('$id_pembelian', '$id_produk', '$nama_produk', '$harga', '$jumlah')";
        
        $conn->query($insertDetailQuery);
    }

    // Hapus data dari tabel keranjang belanja setelah proses checkout selesai
    $deleteCartQuery = "DELETE FROM tb_keranjang_belanja";
    $conn->query($deleteCartQuery);

    // Redirect ke halaman sukses atau halaman lain sesuai kebutuhan
    header("Location: success.php");
    exit();
} else {
    // Jika terdapat kesalahan dalam menyimpan data, Anda dapat melakukan penanganan kesalahan sesuai kebutuhan
    echo "Error: " . $insertQuery . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
