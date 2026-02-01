<?php
/**
 * Dati Prodotti - Menu del ristorante
 */
$products = [
    ['id' => 1, 'name' => 'Queen Burger', 'desc' => 'Doppio hamburger di manzo, formaggio cheddar, bacon, lattuga e salsa speciale', 'cat' => 'burgers', 'price' => 8.90, 'img' => 'assets/images/queen-burger.jpg'],
    ['id' => 2, 'name' => 'Chicken Burger', 'desc' => 'Pollo croccante, lattuga fresca, pomodoro, maionese al peperoncino', 'cat' => 'burgers', 'price' => 7.50, 'img' => 'assets/images/chicken-burger.jpg'],
    ['id' => 3, 'name' => 'Crispy Fries', 'desc' => 'Patatine fritte croccanti con sale marino', 'cat' => 'sides', 'price' => 2.50, 'img' => 'assets/images/crispy-fries.jpg'],
    ['id' => 4, 'name' => 'Chicken Nuggets', 'desc' => '10 nuggets di pollo croccanti con salse a scelta', 'cat' => 'sides', 'price' => 4.90, 'img' => 'assets/images/chicken-nuggets.jpg'],
    ['id' => 5, 'name' => 'Coca Cola', 'desc' => 'Coca Cola classica (500ml)', 'cat' => 'drinks', 'price' => 1.50, 'img' => 'assets/images/coca-cola.jpg'],
    ['id' => 6, 'name' => 'Brownie Delight', 'desc' => 'Brownie al cioccolato caldo con gelato alla vaniglia', 'cat' => 'desserts', 'price' => 3.50, 'img' => 'assets/images/brownie.jpg']
];

// Categorie con icone
$categories = [
    'burgers' => ['name' => 'Burgers', 'icon' => '🍔'],
    'sides' => ['name' => 'Contorni', 'icon' => '🍟'],
    'drinks' => ['name' => 'Bevande', 'icon' => '🥤'],
    'desserts' => ['name' => 'Dolci', 'icon' => '🍰']
];

// Trova prodotto per ID
function getProductById($id) {
    global $products;
    foreach ($products as $p) {
        if ($p['id'] == $id) return $p;
    }
    return null;
}

// Ottieni tutti i prodotti
function getAllProducts() {
    global $products;
    return $products;
}
?>
