<?php
$servername = "localhost";
$database = "quotechoco";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("koneksi gagal:" . mysqli_connect_error());
}

// Pengecekan apakah terdapat input pencarian
$search_query = isset($_GET['query']) ? $_GET['query'] : '';

$sql = "SELECT * FROM tb_produk";

// Jika ada input pencarian, tambahkan kondisi WHERE
if (!empty($search_query)) {
    $sql .= " WHERE nama_produk LIKE '%$search_query%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Tampilkan data produk seperti sebelumnya
        echo '<div class="product-card">';
        echo '<div class="product-icons">';
        echo '<a href="#"><i data-feather="shopping-cart"></i></a>';
        echo '<a href="#" class="item-detail-button" data-product-id="' . $row["id_produk"] . '"><i data-feather="eye"></i></a>';
        echo '</div>';
        echo '<div class="product-image">';
        echo '<img src="' . $row["gambar"] . '" alt="' . $row["nama_produk"] . '" />';
        echo '</div>';
        echo '<div class="product-content">';
        echo '<h3>' . $row["nama_produk"] . '</h3>';
        echo '<div class="product-stars">';
        // Tambahan kode untuk menampilkan bintang atau informasi lainnya
        echo '</div>';
        echo '<div class="product-price">' . $row["harga"] . '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
?>
