<?php
require_once 'includes/config.php';
require_once 'data/products.php';

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity > 0) {
        addToCart($productId, $quantity);
        $successMessage = "Prodotto aggiunto al carrello!";
    }
}

$pageTitle = 'Menu';
$paginaCSS = 'index.css';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Royal Menu</h1>
            <p class="hero-subtitle">Scegli i tuoi preferiti e ordina come una regina</p>
        </div>
    </section>

    <?php if (isset($successMessage)): ?>
    <div class="alert-success">
        <?php echo $successMessage; ?>
    </div>
    <?php endif; ?>

    <?php if (!isLoggedIn()): ?>
    <div class="benefits-banner">
        <div class="container">
            <div class="benefits-content">
                <div class="benefits-icon">🎁</div>
                <div class="benefits-text">
                    <h3>Registrati e ottieni il 10% di sconto sul primo ordine!</h3>
                    <p>Più punti fedeltà, ordini salvati e checkout veloce</p>
                </div>
                <div class="benefits-actions">
                    <a href="register.php" class="btn-register-banner">Registrati</a>
                    <a href="login.php" class="btn-login-banner">Accedi</a>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="welcome-banner">
        <div class="container">
            <p>👑 Benvenuto, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>! Ogni ordine ti fa guadagnare punti fedeltà.</p>
        </div>
    </div>
    <?php endif; ?>

    <!-- Category Filter -->
    <section class="category-section">
        <div class="container">
            <div class="category-filter">
                <a href="index.php" class="category-btn <?php echo !isset($_GET['category']) ? 'active' : ''; ?>">
                    <span class="category-icon">👑</span>
                    <span>Tutto</span>
                </a>
                <?php foreach ($categories as $key => $category): ?>
                <a href="index.php?category=<?php echo $key; ?>" class="category-btn <?php echo (isset($_GET['category']) && $_GET['category'] == $key) ? 'active' : ''; ?>">
                    <span class="category-icon"><?php echo $category['icon']; ?></span>
                    <span><?php echo $category['name']; ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="products-grid">
                <?php 
                $allProducts = getAllProducts();
                $filterCategory = isset($_GET['category']) ? $_GET['category'] : null;
                
                foreach ($allProducts as $product): 
                    if ($filterCategory && $product['category'] != $filterCategory) {
                        continue;
                    }
                ?>
                <div class="product-card">
                    <div class="product-image-wrapper">
                        <img src="<?php echo $product['image']; ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="product-image"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23FF1744\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-size=\'80\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-family=\'Arial\'%3E<?php echo $categories[$product['category']]['icon']; ?>%3C/text%3E%3C/svg%3E'">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-price">€<?php echo number_format($product['price'], 2, ',', '.'); ?></div>
                        
                        <form method="POST" class="product-form">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <div class="product-controls">
                                <div class="quantity-control">
                                    <label for="qty-<?php echo $product['id']; ?>">Quantità:</label>
                                    <input type="number" 
                                           id="qty-<?php echo $product['id']; ?>"
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="99" 
                                           class="quantity-input">
                                </div>
                                <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                    Aggiungi al carrello
                                </button>
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
