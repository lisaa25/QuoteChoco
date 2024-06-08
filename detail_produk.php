<?php
$id_produk = $_GET['id'];

$sql = "SELECT * FROM tb_produk WHERE id_produk = $id_produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "
    <a href=\"#\" class=\"close-icon\"><i data-feather=\"x\"></i></a>
    <div class=\"modal-content\" id=\"modal-content-{$row['nama_produk']}\">
      <img src=\"{$row['gambar']}\" alt=\"{$row['nama_produk']}\" />
      <div class=\"product-content\">
        <h3>{$row['nama_produk']}</h3>
        <p>{$row['deskripsi']}</p>
        <div class=\"product-stars\">
          <i data-feather=\"star\" class=\"star-full\"></i>
          <i data-feather=\"star\" class=\"star-full\"></i>
          <i data-feather=\"star\" class=\"star-full\"></i>
          <i data-feather=\"star\" class=\"star-full\"></i>
          <i data-feather=\"star\"></i>
        </div>
        <div class=\"product-price\">{$row['harga']}</div>
        <a href=\"#\"><i data-feather=\"shopping-cart\"></i> <span>add to cart</span></a>
      </div>
    </div>
  ";
} else {
  echo "Produk tidak ditemukan.";
}
?>