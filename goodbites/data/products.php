<?php
require_once __DIR__ . '/db.php';

// Prendo un prodotto per id, ritorna null se non trovato
function getProductById($id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT id, name, `desc`, cat_key AS cat, price, img
        FROM products
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();
    return $res->fetch_assoc() ?: null;
}

// Prendo tutti i prodotti, ritorna array vuoto se non ci sono
function getAllProducts() {
    global $conn;

    $sql = "SELECT id, name, `desc`, cat_key AS cat, price, img FROM products ORDER BY id ASC";
    $res = $conn->query($sql);

    $products = [];
    while ($row = $res->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

// Prendo le categorie, ritorna array vuoto se non ci sono
function getCategories() {
    global $conn;

    $sql = "SELECT `key`, name, icon FROM categories ORDER BY id ASC";
    $res = $conn->query($sql);

    $categories = [];
    while ($row = $res->fetch_assoc()) {
        $categories[$row['key']] = [
            'name' => $row['name'],
            'icon' => $row['icon']
        ];
    }
    return $categories;
}
?>