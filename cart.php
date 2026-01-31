<?php
require_once 'includes/config.php';
require_once 'data/products.php';

// Handle cart updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantities'] as $productId => $quantity) {
            updateCartQuantity($productId, (int)$quantity);
        }
        $successMessage = "Carrello aggiornato!";
    }
    
    if (isset($_POST['remove_item'])) {
        $productId = (int)$_POST['product_id'];
        removeFromCart($productId);
        $successMessage = "Prodotto rimosso dal carrello!";
    }
    
    if (isset($_POST['clear_cart'])) {
        clearCart();
        $successMessage = "Carrello svuotato!";
    }
}

$cartItems = getCartItems();
$cartTotal = getCartTotal();
$pageTitle = 'Carrello';
$paginaCSS = 'cart.css';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="cart-page">
        <div class="container">
            <h1 class="page-title">Il Tuo Carrello</h1>

            <?php if (isset($successMessage)): ?>
            <div class="alert-success">
                <?php echo $successMessage; ?>
            </div>
            <?php endif; ?>

            <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h2>Il tuo carrello è vuoto</h2>
                <p>Non hai ancora aggiunto prodotti al carrello</p>
                <a href="index.php" class="btn-primary">Vai al Menu</a>
            </div>
            <?php else: ?>
            
            <form method="POST" class="cart-form">
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="<?php echo $item['product']['image']; ?>" 
                                 alt="<?php echo htmlspecialchars($item['product']['name']); ?>"
                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'150\' height=\'150\'%3E%3Crect fill=\'%23FF1744\' width=\'150\' height=\'150\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-size=\'40\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\'%3E🍔%3C/text%3E%3C/svg%3E'">
                        </div>
                        <div class="cart-item-details">
                            <h3 class="cart-item-name"><?php echo htmlspecialchars($item['product']['name']); ?></h3>
                            <p class="cart-item-description"><?php echo htmlspecialchars($item['product']['description']); ?></p>
                            <div class="cart-item-price">€<?php echo number_format($item['product']['price'], 2, ',', '.'); ?></div>
                        </div>
                        <div class="cart-item-quantity">
                            <label>Quantità:</label>
                            <input type="number" 
                                   name="quantities[<?php echo $item['product']['id']; ?>]" 
                                   value="<?php echo $item['quantity']; ?>" 
                                   min="1" 
                                   max="99"
                                   class="quantity-input-cart">
                        </div>
                        <div class="cart-item-subtotal">
                            <div class="subtotal-label">Subtotale:</div>
                            <div class="subtotal-amount">€<?php echo number_format($item['subtotal'], 2, ',', '.'); ?></div>
                        </div>
                        <div class="cart-item-remove">
                            <button type="submit" name="remove_item" value="1" class="btn-remove" 
                                    onclick="this.form.elements['product_id'].value=<?php echo $item['product']['id']; ?>">
                                ×
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <input type="hidden" name="product_id" value="">

                <div class="cart-actions">
                    <button type="submit" name="update_cart" class="btn-secondary">Aggiorna Carrello</button>
                    <button type="submit" name="clear_cart" class="btn-danger">Svuota Carrello</button>
                </div>

                <div class="cart-summary">
                    <div class="cart-total">
                        <span class="total-label">Totale:</span>
                        <span class="total-amount">€<?php echo number_format($cartTotal, 2, ',', '.'); ?></span>
                    </div>
                    
                    <a href="checkout.php" class="btn-checkout">Procedi al Checkout</a>
                    
                    <?php if (!isLoggedIn()): ?>
                    <div class="login-benefits">
                        <div class="benefit-card">
                            <span class="benefit-icon">🎁</span>
                            <div class="benefit-text">
                                <strong>Hai un account?</strong>
                                <p>Accedi per guadagnare punti fedeltà!</p>
                                <a href="login.php?redirect=checkout" class="btn-login-small">Accedi</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </form>

            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
