// Implement the following:
// 1. Product filtering functionality
// 2. Product search functionality
// 3. Product sorting functionality
// 4. Product pagination functionality
// 5. Product details modal functionality
// 6. Product cart functionality
// 7. Product wishlist functionality
// 8. Product reviews functionality
// 9. Product ratings functionality
// 10. Product images functionality

document.querySelectorAll('.category a').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const category = link.textContent.toLowerCase();
        filterProducts(category);
    });
});

function filterProducts(category) {
    const products = document.querySelectorAll('.card-product');
    products.forEach(product => {
        if (category === 'all' || product.dataset.category === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

const searchInput = document.querySelector('.search');
searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    searchProducts(searchTerm);
});

function searchProducts(searchTerm) {
    const products = document.querySelectorAll('.card-product');
    products.forEach(product => {
        const title = product.querySelector('.card-title').textContent.toLowerCase();
        if (title.includes(searchTerm)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}