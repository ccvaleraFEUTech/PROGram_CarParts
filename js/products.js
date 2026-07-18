// Search products by title
const searchInput = document.querySelector('.search');
searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    searchProducts(searchTerm);
});

function searchProducts(searchTerm) {
    const products = document.querySelectorAll('.product-card');
    products.forEach(product => {
        const title = product.querySelector('.card-title').textContent.toLowerCase();
        if (title.includes(searchTerm)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}