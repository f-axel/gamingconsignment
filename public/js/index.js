

// Fungsi untuk mengurutkan produk berdasarkan harga
function sortProducts(order) {
    const products = Array.from(document.querySelectorAll('.product-item'));
    products.sort((a, b) => {
        const priceA = parseInt(a.getAttribute('data-price'));
        const priceB = parseInt(b.getAttribute('data-price'));

        if (order === 'asc') {
            return priceA - priceB; // Dari termurah ke termahal
        } else {
            return priceB - priceA; // Dari termahal ke termurah
        }
    });

    // Menyusun ulang produk di DOM berdasarkan urutan yang sudah diurutkan
    const productList = document.querySelector('.product-list');
    products.forEach(product => {
        productList.appendChild(product);
    });
}

// Fungsi untuk menyaring produk berdasarkan kategori dan pencarian
function filterProducts(categoryId, searchTerm) {
    const products = document.querySelectorAll('.product-item');
    products.forEach(function(item) {
        const productCategory = item.getAttribute('data-category');
        const productTitle = item.querySelector("h3").textContent.toLowerCase();
        const matchesCategory = categoryId === 'all' || productCategory === categoryId;
        const matchesSearch = productTitle.includes(searchTerm);

        // Produk hanya tampil jika sesuai kategori dan pencarian
        if (matchesCategory && matchesSearch) {
            item.style.display = "block"; // Tampilkan produk
        } else {
            item.style.display = "none"; // Sembunyikan produk
        }
    });
}

// Event listener untuk dropdown kategori
document.getElementById('filterCategory').addEventListener('change', function() {
    const categoryId = this.value;
    const searchTerm = document.getElementById('searchProduct').value.toLowerCase();
    filterProducts(categoryId, searchTerm); // Filter produk berdasarkan kategori dan pencarian
});

// Event listener untuk dropdown harga
document.getElementById('sortPrice').addEventListener('change', function() {
    const sortOrder = this.value;
    sortProducts(sortOrder); // Urutkan produk berdasarkan harga
});

// Fitur pencarian produk
document.getElementById("searchProduct").addEventListener("input", function() {
    const searchTerm = this.value.toLowerCase();
    const categoryId = document.getElementById('filterCategory').value;
    filterProducts(categoryId, searchTerm); // Filter produk berdasarkan kategori dan pencarian
});


document.addEventListener("DOMContentLoaded", function () {
    const textElement = document.getElementById("animatedText");
    const textContent = "Supplying demands since 2024.";
    let index = 0;

    function typeText() {
        if (index < textContent.length) {
            textElement.textContent += textContent[index];
            index++;
            setTimeout(typeText, 100); // Menentukan kecepatan animasi
        }
    }

    typeText(); // Memulai animasi teks
});


document.addEventListener("DOMContentLoaded", function () {
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // Tampilkan tombol jika user scroll ke bawah lebih dari 300px
    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    });

    // Scroll ke atas ketika tombol diklik
    scrollToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth", // Efek smooth scrolling
        });
    });
});

function changeQuantity(amount) {
    const input = document.querySelector('.qty-input');
    let value = parseInt(input.value);

    if (!isNaN(value)) {
        value += amount;
        if (value < 1) value = 1; // Minimum value is 1
        input.value = value;
    }
};
