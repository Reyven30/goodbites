<?php
// Product data for BurgerQueen

$products = [
    [
        'id' => 1,
        'name' => 'Queen Burger',
        'description' => 'Doppio hamburger di manzo, formaggio cheddar, bacon croccante, lattuga, pomodoro e salsa speciale',
        'category' => 'burgers',
        'price' => 12.90,
        'image' => 'assets/images/queen-burger.jpg',
        'available' => true
    ],
    [
        'id' => 2,
        'name' => 'Royal Chicken',
        'description' => 'Pollo croccante, lattuga fresca, pomodoro, maionese al peperoncino',
        'category' => 'burgers',
        'price' => 10.50,
        'image' => 'assets/images/royal-chicken.jpg',
        'available' => true
    ],
    [
        'id' => 3,
        'name' => 'Veggie Delight',
        'description' => 'Burger vegetariano con verdure grigliate, hummus e salsa yogurt',
        'category' => 'burgers',
        'price' => 9.90,
        'image' => 'assets/images/veggie-delight.jpg',
        'available' => true
    ],
    [
        'id' => 4,
        'name' => 'Bacon King',
        'description' => 'Triplo bacon, hamburger, formaggio e salsa BBQ',
        'category' => 'burgers',
        'price' => 14.50,
        'image' => 'assets/images/bacon-king.jpg',
        'available' => true
    ],
    [
        'id' => 5,
        'name' => 'Crispy Fries',
        'description' => 'Patatine fritte croccanti con sale marino',
        'category' => 'sides',
        'price' => 4.50,
        'image' => 'assets/images/crispy-fries.jpg',
        'available' => true
    ],
    [
        'id' => 6,
        'name' => 'Cheese Fries',
        'description' => 'Patatine con formaggio cheddar fuso e bacon',
        'category' => 'sides',
        'price' => 6.90,
        'image' => 'assets/images/cheese-fries.jpg',
        'available' => true
    ],
    [
        'id' => 7,
        'name' => 'Onion Rings',
        'description' => 'Anelli di cipolla fritti in pastella croccante',
        'category' => 'sides',
        'price' => 4.90,
        'image' => 'assets/images/onion-rings.jpg',
        'available' => true
    ],
    [
        'id' => 8,
        'name' => 'Royal Nuggets',
        'description' => '10 nuggets di pollo croccanti con salse a scelta',
        'category' => 'sides',
        'price' => 8.90,
        'image' => 'assets/images/royal-nuggets.jpg',
        'available' => true
    ],
    [
        'id' => 9,
        'name' => 'Milkshake Cioccolato',
        'description' => 'Frappè cremoso al cioccolato con panna montata',
        'category' => 'drinks',
        'price' => 5.50,
        'image' => 'assets/images/milkshake-chocolate.jpg',
        'available' => true
    ],
    [
        'id' => 10,
        'name' => 'Milkshake Vaniglia',
        'description' => 'Frappè cremoso alla vaniglia con panna montata',
        'category' => 'drinks',
        'price' => 5.50,
        'image' => 'assets/images/milkshake-vanilla.jpg',
        'available' => true
    ],
    [
        'id' => 11,
        'name' => 'Milkshake Fragola',
        'description' => 'Frappè cremoso alla fragola con panna montata',
        'category' => 'drinks',
        'price' => 5.50,
        'image' => 'assets/images/milkshake-strawberry.jpg',
        'available' => true
    ],
    [
        'id' => 12,
        'name' => 'Coca Cola',
        'description' => 'Coca Cola classica (500ml)',
        'category' => 'drinks',
        'price' => 3.50,
        'image' => 'assets/images/coca-cola.jpg',
        'available' => true
    ],
    [
        'id' => 13,
        'name' => 'Crown Pizza',
        'description' => 'Mini pizza con mozzarella, pomodoro e basilico fresco',
        'category' => 'sides',
        'price' => 7.90,
        'image' => 'assets/images/crown-pizza.jpg',
        'available' => true
    ],
    [
        'id' => 14,
        'name' => 'Ice Cream Royale',
        'description' => 'Gelato artigianale con topping a scelta',
        'category' => 'desserts',
        'price' => 6.50,
        'image' => 'assets/images/ice-cream.jpg',
        'available' => true
    ],
    [
        'id' => 15,
        'name' => 'Brownie Delight',
        'description' => 'Brownie al cioccolato caldo con gelato alla vaniglia',
        'category' => 'desserts',
        'price' => 7.50,
        'image' => 'assets/images/brownie.jpg',
        'available' => true
    ]
];

$categories = [
    'burgers' => ['name' => 'Burgers', 'icon' => '🍔'],
    'sides' => ['name' => 'Contorni', 'icon' => '🍟'],
    'drinks' => ['name' => 'Bevande', 'icon' => '🥤'],
    'desserts' => ['name' => 'Dolci', 'icon' => '🍰']
];

function getProductById($productId) {
    global $products;
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            return $product;
        }
    }
    return null;
}

function getAllProducts() {
    global $products;
    return array_filter($products, function($p) { return $p['available']; });
}
?>
