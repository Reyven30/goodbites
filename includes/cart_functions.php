<?php
/**
 * Cart Functions - Shopping cart management
 */

// Init cart if not exists
function initCart() {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
}

// Add product to cart
function addToCart($id, $qty = 1) {
    initCart();
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
}

// Update product quantity
function updateCart($id, $qty) {
    initCart();
    if ($qty <= 0) unset($_SESSION['cart'][$id]);
    else $_SESSION['cart'][$id] = $qty;
}

// Remove product from cart
function removeFromCart($id) {
    initCart();
    unset($_SESSION['cart'][$id]);
}

// Get cart items with product details
function getCartItems() {
    initCart();
    require_once 'data/products.php';
    
    $items = [];
    foreach ($_SESSION['cart'] as $id => $qty) {
        $p = getProductById($id);
        if ($p) {
            $items[] = [
                'product' => $p,
                'qty' => $qty,
                'subtotal' => $p['price'] * $qty
            ];
        }
    }
    return $items;
}

// Get cart total price
function getCartTotal() {
    $total = 0;
    foreach (getCartItems() as $item) $total += $item['subtotal'];
    return $total;
}

// Get total items count
function getCartCount() {
    initCart();
    return array_sum($_SESSION['cart']);
}

// Clear cart
function clearCart() {
    $_SESSION['cart'] = [];
}
?>
