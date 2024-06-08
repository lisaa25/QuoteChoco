// Toggle class active untuk hamburger menu
const navbarNav = document.querySelector(".navbar-nav");
const navbarToggle = document.querySelector(".navbar-toggle");
// ketika hamburger menu di klik
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
  navbarToggle.classList.toggle("active");
};

// Toggle class active untuk search form
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");

document.querySelector("#search-button").onclick = (e) => {
  searchForm.classList.toggle("active");
  searchBox.focus();
  e.preventDefault();
};

// Klik di luar elemen
const hm = document.querySelector("#hamburger-menu");
const sb = document.querySelector("#search-button");

document.addEventListener("click", function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
  if (!hm.contains(e.target) && !navbarToggle.contains(e.target)) {
    navbarToggle.classList.remove("active");
  }

  if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
    searchForm.classList.remove("active");
  }
});

// Modal Box
const itemDetailModal = document.querySelector("#item-detail-modal");
const itemDetailButtons = document.querySelectorAll(".item-detail-button");

itemDetailButtons.forEach((btn) => {
  btn.onclick = (e) => {
    itemDetailModal.style.display = "flex";
    e.preventDefault();
  };
});

// klik tombol close modal
document.querySelector(".modal .close-icon").onclick = (e) => {
  itemDetailModal.style.display = "none";
  e.preventDefault();
};

// klik di luar modal
window.onclick = (e) => {
  if (e.target === itemDetailModal) {
    itemDetailModal.style.display = "none";
  }
};

// Deskripsi Produk

function getDeskripsiProduk(productID) {
  // Temukan elemen dengan ID sesuai dengan produk
  const modalContent = document.getElementById(`modal-content-${productID}`);

  // Verifikasi apakah elemen ditemukan
  if (modalContent) {
    // Cari elemen <p> di dalam product-content
    const deskripsiElement = modalContent.querySelector("p");

    // Verifikasi apakah elemen <p> ditemukan
    if (deskripsiElement) {
      // Kembalikan teks deskripsi
      return deskripsiElement.textContent;
    } else {
      return "Deskripsi tidak ditemukan.";
    }
  } else {
    return "Produk tidak ditemukan.";
  }
}

// Panggil fungsi deskripsi

const deskripsiNastar = getDeskripsiProduk("nastar");
console.log(deskripsiNastar);

const deskripsiChocoBrownies = getDeskripsiProduk("choco-brownies");
console.log(deskripsiChocoBrownies);

const deskripsiChocoVanillaPuding = getDeskripsiProduk("choco-vanilla-puding");
console.log(deskripsiChocoVanillaPuding);

// Ambil semua elemen tombol "eye"
const detailButtons = document.querySelectorAll(".item-detail-button");

// Tambahkan event listener untuk setiap tombol "eye"
detailButtons.forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault();

    // Ambil ID produk dari atribut data-product-id
    const productId = this.getAttribute("data-product-id");

    // Tampilkan modal berdasarkan ID produk
    displayProductModal(productId);
  });
});

// Fungsi untuk menampilkan modal berdasarkan ID produk
function displayProductModal(productId) {
  // Semua modal content
  const modalContents = document.querySelectorAll(".modal-content");

  // Sembunyikan semua modal content
  modalContents.forEach((content) => {
    content.style.display = "none";
  });

  // Tampilkan modal content berdasarkan ID produk
  const modalContent = document.getElementById(`modal-content-${productId}`);
  modalContent.style.display = "flex";

  // Tampilkan modal
  const modal = document.getElementById("item-detail-modal");
  modal.style.display = "flex";
}

// Fungsi untuk menutup modal
function closeModal() {
  const modal = document.getElementById("item-detail-modal");
  modal.style.display = "none";
}

// Ambil elemen tombol close
const closeIcon = document.querySelector(".close-icon");

// Tambahkan event listener untuk tombol close
closeIcon.addEventListener("click", closeModal);

// Add to Cart Button Logic
function addToCart(productId) {
  var addToCartEndpoint = "add_to_cart.php";

  fetch(`${addToCartEndpoint}?product_id=${productId}`)
    .then((response) => response.json())
    .then((data) => {
      alert(data.message); // Tampilkan pesan dari server
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Fungsi untuk mengambil data produk dari server
function fetchProducts() {
  fetch("get_products.php") // Ganti dengan URL skrip PHP yang mengambil data produk
    .then((response) => response.json())
    .then((data) => {
      // Proses data dan perbarui elemen produk
      updateProductElements(data);
    })
    .catch((error) => console.error("Error fetching products:", error));
}

// Fungsi untuk memperbarui elemen produk di halaman
function updateProductElements(products) {
  // Dapatkan elemen container produk (misalnya, sebuah div dengan ID 'products-container')
  const productsContainer = document.getElementById("products-container");

  // Bersihkan konten sebelum memperbarui
  productsContainer.innerHTML = "";

  // Iterasi melalui setiap produk dan buat elemen HTML untuk menampilkan informasi produk
  products.forEach((product) => {
    // Buat elemen div untuk setiap produk
    const productDiv = document.createElement("div");
    productDiv.classList.add("product-card");
    productDiv.innerHTML = `
          <div class="product-icons">
              <a href="#"><i data-feather="shopping-cart"></i></a>
              <a href="#" class="item-detail-button" data-product-id="${
                product.id_produk
              }">
                  <i data-feather="eye"></i>
              </a>
          </div>
          <div class="product-image">
              <img src="${product.gambar}" alt="${product.nama_produk}" />
          </div>
          <div class="product-content">
              <h3>${product.nama_produk}</h3>
              <div class="product-stars">${getStarIcons(product.rating)}</div>
              <div class="product-price">IDR ${product.harga}</div>
          </div>
      `;

    // Tambahkan elemen produk ke dalam container produk
    productsContainer.appendChild(productDiv);
  });

  // Panggil fungsi untuk mengganti ikon Feather setelah memperbarui elemen
  feather.replace();
}

// Fungsi untuk mendapatkan ikon bintang berdasarkan rating produk
function getStarIcons(rating) {
  const starIcons = Array.from({ length: 5 }, (_, index) => {
    const starClass = index < rating ? "star-full" : "star";
    return `<i data-feather="${starClass}"></i>`;
  });

  return starIcons.join("");
}

// Panggil fungsi fetchProducts saat halaman dimuat
window.onload = function () {
  fetchProducts();
};
