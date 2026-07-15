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