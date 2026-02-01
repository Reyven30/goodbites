<?php
/**
 * Funzioni Carrello - Gestione carrello acquisti
 */

// Inizializza carrello se non esiste
function initCart() {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
}

// Aggiungi prodotto al carrello
function addToCart($id, $qty = 1) {
    initCart();
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
}

// Aggiorna quantità prodotto
function updateCart($id, $qty) {
    initCart();
    if ($qty <= 0) unset($_SESSION['cart'][$id]);
    else $_SESSION['cart'][$id] = $qty;
}

// Rimuovi prodotto dal carrello
function removeFromCart($id) {
    initCart();
    unset($_SESSION['cart'][$id]);
}

// Ottieni prodotti nel carrello con dettagli
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

// Calcola totale carrello
function getCartTotal() {
    $total = 0;
    foreach (getCartItems() as $item) $total += $item['subtotal'];
    return $total;
}

// Conta prodotti nel carrello
function getCartCount() {
    initCart();
    return array_sum($_SESSION['cart']);
}

// Svuota carrello
function clearCart() {
    $_SESSION['cart'] = [];
}
?>
