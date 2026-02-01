<?php
require_once 'config/functions.php';
$pageTitle = 'Carrello';
$pageCSS = 'cart.css';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- Cart Header -->
<div class="cart-header">
    <div class="container">
        <span class="emoji">🛒</span>
        <h1>Il Tuo Carrello</h1>
    </div>
</div>

<div class="container">
    <?php if (empty($cart)): ?>
        <!-- Empty Cart Message -->
        <div class="empty-cart">
            <span class="emoji">🛒</span>
            <h2>Il tuo carrello è vuoto</h2>
            <p>Aggiungi qualche prodotto dal nostro menu!</p>
            <a href="/menu.php" class="btn btn-primary">Vai al Menu</a>
        </div>
    <?php else: ?>
        <!-- Cart List -->
        <div class="cart-list">
            <?php foreach ($cart as $item): ?>
                <div class="cart-item">
                    <div class="cart-item-info">
                        <span class="emoji"><?php echo $item['emoji']; ?></span>
                        <div class="cart-item-details">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Prezzo unitario: €<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                    </div>
                    <div class="cart-item-actions">
                        <div class="quantity-display">
                            Qtà: <?php echo $item['quantity']; ?>
                        </div>
                        <div class="cart-item-price">
                            €<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                        <a href="/config/functions.php?action=remove_from_cart&product_id=<?php echo $item['id']; ?>" class="btn btn-danger">Rimuovi</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Cart Summary -->
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="cart-summary">
                    <h2>Riepilogo Ordine</h2>
                    <div class="summary-row">
                        <span class="summary-label">Numero Prodotti:</span>
                        <span class="summary-value"><?php echo $cartCount; ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Totale:</span>
                        <span class="summary-value">€<?php echo number_format($cartTotal, 2); ?></span>
                    </div>
                    <button class="btn btn-primary" onclick="alert('Funzionalità checkout in arrivo!')">
                        Procedi al Checkout
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
