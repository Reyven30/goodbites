// Product data
const products = [
    {
        id: 1,
        name: "Queen Burger",
        description: "Doppio hamburger, formaggio cheddar, bacon croccante, salsa speciale",
        price: 12.90,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FF1744' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🍔%3C/text%3E%3C/svg%3E"
    },
    {
        id: 2,
        name: "Royal Chicken",
        description: "Pollo croccante, lattuga fresca, pomodoro, maionese al peperoncino",
        price: 10.50,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FF6E40' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🍗%3C/text%3E%3C/svg%3E"
    },
    {
        id: 3,
        name: "Crispy Fries",
        description: "Patatine fritte croccanti con sale marino",
        price: 4.50,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FFD600' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='%23333' font-family='Arial'%3E🍟%3C/text%3E%3C/svg%3E"
    },
    {
        id: 4,
        name: "Royal Nuggets",
        description: "10 nuggets di pollo croccanti con salse a scelta",
        price: 8.90,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FF1744' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🍿%3C/text%3E%3C/svg%3E"
    },
    {
        id: 5,
        name: "Veggie Delight",
        description: "Burger vegetariano con verdure grigliate e hummus",
        price: 9.90,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%2342A5F5' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🥗%3C/text%3E%3C/svg%3E"
    },
    {
        id: 6,
        name: "Milkshake Royal",
        description: "Frappè cremoso al cioccolato, vaniglia o fragola",
        price: 5.50,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FF6E40' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🥤%3C/text%3E%3C/svg%3E"
    },
    {
        id: 7,
        name: "Onion Rings",
        description: "Anelli di cipolla fritti in pastella croccante",
        price: 4.90,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FFD600' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='%23333' font-family='Arial'%3E🧅%3C/text%3E%3C/svg%3E"
    },
    {
        id: 8,
        name: "Crown Pizza",
        description: "Mini pizza con mozzarella, pomodoro e basilico",
        price: 7.90,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%23FF1744' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🍕%3C/text%3E%3C/svg%3E"
    },
    {
        id: 9,
        name: "Ice Cream Royale",
        description: "Gelato artigianale con topping a scelta",
        price: 6.50,
        image: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%2342A5F5' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' font-size='60' text-anchor='middle' dy='.3em' fill='white' font-family='Arial'%3E🍦%3C/text%3E%3C/svg%3E"
    }
];

// Cart state
let cart = [];
let quantities = {};

// Initialize quantities
products.forEach(product => {
    quantities[product.id] = 1;
});

// DOM Elements
const productsContainer = document.getElementById('productsContainer');
const cartIcon = document.getElementById('cartIcon');
const cartOverlay = document.getElementById('cartOverlay');
const cartClose = document.getElementById('cartClose');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const cartBadge = document.getElementById('cartBadge');

// Render products
function renderProducts() {
    productsContainer.innerHTML = '';
    products.forEach((product, index) => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.style.animationDelay = `${index * 0.1}s`;
        
        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-name">${product.name}</h3>
                <p class="product-description">${product.description}</p>
                <div class="product-price">€${product.price.toFixed(2)}</div>
                <div class="product-controls">
                    <div class="quantity-control">
                        <button class="quantity-btn" onclick="decreaseQuantity(${product.id})">-</button>
                        <span class="quantity-display" id="qty-${product.id}">${quantities[product.id]}</span>
                        <button class="quantity-btn" onclick="increaseQuantity(${product.id})">+</button>
                    </div>
                    <button class="add-to-cart-btn" onclick="addToCart(${product.id})">
                        Aggiungi al carrello
                    </button>
                </div>
            </div>
        `;
        
        productsContainer.appendChild(productCard);
    });
}

// Quantity controls
function increaseQuantity(productId) {
    quantities[productId]++;
    document.getElementById(`qty-${productId}`).textContent = quantities[productId];
}

function decreaseQuantity(productId) {
    if (quantities[productId] > 1) {
        quantities[productId]--;
        document.getElementById(`qty-${productId}`).textContent = quantities[productId];
    }
}

// Add to cart
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const quantity = quantities[productId];
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            ...product,
            quantity: quantity
        });
    }
    
    // Reset quantity to 1
    quantities[productId] = 1;
    document.getElementById(`qty-${productId}`).textContent = 1;
    
    updateCart();
    
    // Show success feedback
    const btn = event.target;
    const originalText = btn.textContent;
    btn.textContent = '✓ Aggiunto!';
    btn.style.background = '#4CAF50';
    
    setTimeout(() => {
        btn.textContent = originalText;
        btn.style.background = '';
    }, 1000);
}

// Remove from cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
}

// Update cart display
function updateCart() {
    // Update badge
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartBadge.textContent = totalItems;
    
    // Update cart items
    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="cart-empty">Il tuo carrello è vuoto</p>';
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">€${item.price.toFixed(2)}</div>
                    <div class="cart-item-quantity">Quantità: ${item.quantity}</div>
                </div>
                <button class="cart-item-remove" onclick="removeFromCart(${item.id})">×</button>
            </div>
        `).join('');
    }
    
    // Update total
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotal.textContent = `€${total.toFixed(2)}`;
}

// Toggle cart
cartIcon.addEventListener('click', () => {
    cartOverlay.classList.add('active');
});

cartClose.addEventListener('click', () => {
    cartOverlay.classList.remove('active');
});

cartOverlay.addEventListener('click', (e) => {
    if (e.target === cartOverlay) {
        cartOverlay.classList.remove('active');
    }
});

// Initialize
renderProducts();
updateCart();
