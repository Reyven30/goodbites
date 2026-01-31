<?php
// Cart management functions

function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

function addToCart($productId, $quantity = 1) {
    initCart();
    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

function updateCartQuantity($productId, $quantity) {
    initCart();
    
    if ($quantity <= 0) {
        removeFromCart($productId);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

function removeFromCart($productId) {
    initCart();
    unset($_SESSION['cart'][$productId]);
}

function getCartItems() {
    initCart();
    require_once 'data/products.php';
    
    $cartItems = [];
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = getProductById($productId);
        if ($product) {
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product['price'] * $quantity
            ];
        }
    }
    
    return $cartItems;
}

function getCartTotal() {
    $items = getCartItems();
    $total = 0;
    foreach ($items as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}

function getCartCount() {
    initCart();
    return array_sum($_SESSION['cart']);
}

function clearCart() {
    $_SESSION['cart'] = [];
}
?>
