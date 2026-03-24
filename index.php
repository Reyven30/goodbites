<?php
/**
 * Index - Pagina menu con prodotti
 */
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';
require_once 'data/products.php';

// Gestione aggiunta al carrello
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id = (int)$_POST['product_id'];
    $qty = (int)$_POST['qty'];
    if ($qty > 0) {
        addToCart($id, $qty);
        $msg = "Prodotto aggiunto al carrello!";
    }
}

$pageTitle = 'Menu';
$pageCss = 'index.css';
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Il Nostro Menu</h1>
            <p class="hero-subtitle">Scopri i sapori che fanno la differenza</p>
        </div>
    </section>

    <?php if (isset($msg)): ?>
    <div class="alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <!-- Welcome/Login banner -->
    <?php if (isLoggedIn()): ?>
    <div class="welcome-banner">
        <div class="container">
            <p>👑 Benvenuto, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</p>
        </div>
    </div>
    <?php else: ?>
    <div class="benefits-banner">
        <div class="container">
            <div class="benefits-content">
                <span class="benefits-icon">🎁</span>
                <div class="benefits-text">
                    <h3>Registrati e ottieni il 10% di sconto!</h3>
                    <p>Accedi per ordinare</p>
                </div>
                <div class="benefits-actions">
                    <a href="register.php" class="btn-register-banner">Registrati</a>
                    <a href="login.php" class="btn-login-banner">Accedi</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Category Filter -->
    <section class="category-section">
        <div class="container">
            <div class="category-filter">
                <a href="index.php" class="category-btn <?= !isset($_GET['cat']) ? 'active' : '' ?>">
                    <span class="category-icon">👑</span>
                    <span>Tutto</span>
                </a>
                <?php foreach ($categories as $key => $cat): ?>
                <a href="index.php?cat=<?= $key ?>" class="category-btn <?= (($_GET['cat'] ?? '') == $key) ? 'active' : '' ?>">
                    <span class="category-icon"><?= $cat['icon'] ?></span>
                    <span><?= $cat['name'] ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="products-section">
        <div class="container">
            <div class="products-grid">
                <?php 
                $filter = $_GET['cat'] ?? null;
                foreach (getAllProducts() as $p): 
                    if ($filter && $p['cat'] != $filter) continue;
                ?>
                <div class="product-card">
                    <div class="product-image-wrapper">
                        <img src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="product-image">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
                        <p class="product-description"><?= htmlspecialchars($p['desc']) ?></p>
                        <div class="product-price">€<?= number_format($p['price'], 2, ',', '.') ?></div>
                        
                        <form method="POST" class="product-form">
                            <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                            <div class="product-controls">
                                <div class="quantity-control">
                                    <label for="qty-<?= $p['id'] ?>">Qtà:</label>
                                    <input type="number" id="qty-<?= $p['id'] ?>" name="qty" value="1" min="1" max="99" class="quantity-input">
                                </div>
                                <button type="submit" name="add_to_cart" class="add-to-cart-btn">Aggiungi</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
