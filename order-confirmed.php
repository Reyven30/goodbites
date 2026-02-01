<?php
/**
 * Ordine Confermato - Pagina conferma ordine
 */
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';

// Reindirizza se non c'è ordine
if (!isset($_SESSION['order'])) { header('Location: index.php'); exit; }

$order = $_SESSION['order'];
unset($_SESSION['order']);

$pageTitle = 'Ordine Confermato';
$pageCss = 'cart.css';
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
            <div class="order-confirmed">
                <div class="success-icon">✓</div>
                <h1>Ordine Confermato!</h1>
                <p>Grazie <strong><?= htmlspecialchars($order['name']) ?></strong> per il tuo ordine!</p>
                
                <div class="order-details">
                    <h3>Dettagli</h3>
                    <p><strong>Numero:</strong> <?= $order['number'] ?></p>
                    <p><strong>Data:</strong> <?= $order['date'] ?></p>
                    <p><strong>Totale:</strong> €<?= number_format($order['total'], 2, ',', '.') ?></p>
                </div>
                
                <div class="order-items">
                    <h3>Prodotti</h3>
                    <?php foreach ($order['items'] as $item): ?>
                    <div class="order-item">
                        <span><?= htmlspecialchars($item['product']['name']) ?></span>
                        <span>x<?= $item['qty'] ?></span>
                        <span>€<?= number_format($item['subtotal'], 2, ',', '.') ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="email-notice">
                    <p>📧 Email inviata a <strong><?= htmlspecialchars($order['email']) ?></strong></p>
                </div>
                
                <a href="index.php" class="btn-primary">Torna al Menu</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
