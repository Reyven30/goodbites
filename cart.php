<?php
/**
 * Carrello - Pagina carrello acquisti
 */
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';
require_once 'data/products.php';
require_once 'data/orders.php';

// Gestione azioni carrello
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['qty'] as $id => $qty) {
            updateCart($id, (int)$qty);
        }
        $msg = "Carrello aggiornato!";

    } elseif (isset($_POST['remove'])) {
        removeFromCart((int)$_POST['remove']);
        $msg = "Prodotto rimosso!";
    } elseif (isset($_POST['clear'])) {
        clearCart();
        $msg = "Carrello svuotato!";

    } elseif (isset($_POST['confirm']) && isLoggedIn()) {
        $items = getCartItems();
        $total = getCartTotal();

        if (empty($items) || $total <= 0) {
            $msg = "Carrello vuoto o totale non valido.";
        } else {
            // Converte struttura carrello per createOrder()
            $cartItemsForDb = [];
            foreach ($items as $item) {
                $p = $item['product'];
                $cartItemsForDb[] = [
                    'id' => (int)$p['id'],
                    'name' => $p['name'],
                    'price' => (float)$p['price'],
                    'qty' => (int)$item['qty']
                ];
            }

            $userId = (int)($_SESSION['user_id'] ?? 0);
            $orderId = createOrder($userId, $cartItemsForDb, (float)$total);

            if ($orderId) {
                $_SESSION['order'] = [
                    'id' => $orderId,
                    'name' => $_SESSION['user_name'] ?? '',
                    'email' => $_SESSION['user_email'] ?? '',
                    'items' => $items,
                    'total' => $total,
                    'number' => 'GB-' . str_pad((string)$orderId, 6, '0', STR_PAD_LEFT),
                    'date' => date('d/m/Y H:i')
                ];

                sendOrderEmail($_SESSION['order']);
                clearCart();
                header('Location: order-confirmed.php');
                exit;
            } else {
                $msg = "Errore durante il salvataggio ordine nel database.";
            }
        }
    }
}

// Invia email conferma ordine
function sendOrderEmail($order) {
    $list = "";
    foreach ($order['items'] as $item) {
        $list .= "- " . $item['product']['name'] . " x" . $item['qty'] . " = €" . number_format($item['subtotal'], 2, ',', '.') . "\n";
    }
    
    $msg = "Ciao " . $order['name'] . ",\n\n";
    $msg .= "Grazie per il tuo ordine su GoodBites!\n\n";
    $msg .= "ORDINE: " . $order['number'] . "\n";
    $msg .= "DATA: " . $order['date'] . "\n\n";
    $msg .= "PRODOTTI:\n" . $list . "\n";
    $msg .= "TOTALE: €" . number_format($order['total'], 2, ',', '.') . "\n\n";
    $msg .= "Grazie per aver scelto GoodBites!";
    
    $headers = "From: noreply@goodbites.com\r\nContent-Type: text/plain; charset=UTF-8\r\n";
    mail($order['email'], "Ordine " . $order['number'] . " - GoodBites", $msg, $headers);
}

$items = getCartItems();
$total = getCartTotal();
$pageTitle = 'Carrello';
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
            <h1 class="page-title">Il Tuo Carrello</h1>

            <?php if (isset($msg)): ?>
                <div class="alert-success"><?= $msg ?></div>
            <?php endif; ?>

            <?php if (empty($items)): ?>
                <!-- Cart Vuoto -->
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h2>Il tuo carrello è vuoto</h2>
                    <p>Non hai ancora aggiunto prodotti</p>
                    <a href="index.php" class="btn-primary">Vai al Menu</a>
                </div>
            <?php else: ?>
                <!-- Cart Form -->
                <form method="POST" class="cart-form">
                    <input type="hidden" name="id" value="">
                    
                    <div class="cart-items">
                        <?php foreach ($items as $item): $p = $item['product']; ?>
                        <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                        </div>
                            <div class="cart-item-details">
                                <h3 class="cart-item-name"><?= htmlspecialchars($p['name']) ?></h3>
                                <p class="cart-item-description"><?= htmlspecialchars($p['desc']) ?></p>
                                <div class="cart-item-price">€<?= number_format($p['price'], 2, ',', '.') ?></div>
                            </div>
                            <div class="cart-item-quantity">
                                <label>Qtà:</label>
                                <input type="number" name="qty[<?= $p['id'] ?>]" value="<?= $item['qty'] ?>" min="1" max="99" class="quantity-input-cart">
                            </div>
                            <div class="cart-item-subtotal">
                                <div class="subtotal-label">Subtotale:</div>
                                <div class="subtotal-amount">€<?= number_format($item['subtotal'], 2, ',', '.') ?></div>
                            </div>
                            <div class="cart-item-remove">
                               <button type="submit" name="remove" value="<?= (int)$p['id'] ?>" class="btn-remove">×</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-actions">
                        <button type="submit" name="update" class="btn-secondary">Aggiorna</button>
                        <button type="submit" name="clear" class="btn-danger">Svuota</button>
                    </div>

                    <div class="cart-summary">
                        <div class="cart-total">
                            <span class="total-label">Totale:</span>
                            <span class="total-amount">€<?= number_format($total, 2, ',', '.') ?></span>
                        </div>
                        
                        <?php if (isLoggedIn()): ?>
                            <button type="submit" name="confirm" class="btn-checkout">Conferma Ordine</button>
                        <?php else: ?>
                            <div class="login-required">
                                <p>⚠️ Effettua il login per ordinare</p>
                                <a href="login.php?redirect=cart" class="btn-checkout">Accedi</a>
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
