<?php
require_once 'includes/config.php';
require_once 'data/products.php';

$cartItems = getCartItems();
$cartTotal = getCartTotal();

if (empty($cartItems)) {
    header('Location: cart.php');
    exit;
}

$orderComplete = false;
$isGuest = !isLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_order'])) {
    // Get user info (from session or form)
    if ($isGuest) {
        $userName = $_POST['name'] ?? '';
        $userEmail = $_POST['email'] ?? '';
    } else {
        $user = getCurrentUser();
        $userName = $user['name'];
        $userEmail = $user['email'];
    }
    
    // Generate order details
    $orderNumber = 'BQ-' . date('Ymd') . '-' . rand(1000, 9999);
    $orderDate = date('d/m/Y H:i');
    
    // Prepare email content
    $emailContent = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #FF1744, #FF6E40); color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .order-details { background: #f5f5f5; padding: 15px; margin: 20px 0; border-radius: 5px; }
            .product-item { border-bottom: 1px solid #ddd; padding: 10px 0; }
            .total { font-size: 1.5em; font-weight: bold; color: #FF1744; text-align: right; padding: 20px 0; }
            .footer { background: #333; color: white; padding: 20px; text-align: center; margin-top: 30px; }
            .guest-notice { background: #FFD600; padding: 15px; margin: 20px 0; border-radius: 5px; color: #333; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>🍔 BurgerQueen</h1>
            <h2>Conferma Ordine</h2>
        </div>
        <div class='content'>
            <p>Gentile <strong>" . htmlspecialchars($userName) . "</strong>,</p>
            <p>Grazie per il tuo ordine! Ecco i dettagli:</p>
            
            <div class='order-details'>
                <p><strong>Numero Ordine:</strong> " . $orderNumber . "</p>
                <p><strong>Data:</strong> " . $orderDate . "</p>
            </div>
            " . ($isGuest ? "
            <div class='guest-notice'>
                <p><strong>🎁 Sapevi che...</strong></p>
                <p>Creando un account BurgerQueen puoi:</p>
                <ul>
                    <li>Guadagnare punti fedeltà ad ogni ordine</li>
                    <li>Ricevere il 10% di sconto sul prossimo ordine</li>
                    <li>Salvare i tuoi ordini preferiti</li>
                    <li>Checkout più veloce la prossima volta</li>
                </ul>
                <p><a href='" . SITE_URL . "/register.php' style='color: #FF1744; font-weight: bold;'>Registrati ora!</a></p>
            </div>
            " : "<p><strong>✨ Hai guadagnato 10 punti fedeltà con questo ordine!</strong></p>") . "
            
            <h3>Prodotti Ordinati:</h3>
    ";
    
    foreach ($cartItems as $item) {
        $emailContent .= "
            <div class='product-item'>
                <strong>" . htmlspecialchars($item['product']['name']) . "</strong><br>
                Quantità: " . $item['quantity'] . " x €" . number_format($item['product']['price'], 2, ',', '.') . " = €" . number_format($item['subtotal'], 2, ',', '.') . "
            </div>
        ";
    }
    
    $emailContent .= "
            <div class='total'>
                Totale: €" . number_format($cartTotal, 2, ',', '.') . "
            </div>
            
            <p>Il tuo ordine verrà preparato a breve. Ti aspettiamo!</p>
        </div>
        <div class='footer'>
            <p>BurgerQueen - Il gusto della regalità</p>
            <p>Per qualsiasi domanda, contattaci a info@burgerqueen.com</p>
        </div>
    </body>
    </html>
    ";
    
    // In a production environment, you would send the email here
    // Using PHPMailer or similar library
    // For now, we'll just simulate it
    
    /*
    // Example with PHPMailer (uncomment and configure in production):
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = SMTP_PORT;
    
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($user['email'], $user['name']);
    $mail->Subject = 'Conferma Ordine - ' . $orderNumber;
    $mail->isHTML(true);
    $mail->Body = $emailContent;
    $mail->send();
    */
    
    // Clear cart
    clearCart();
    $orderComplete = true;
}

$pageTitle = 'Checkout';
$paginaCSS = 'checkout.css';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="checkout-page">
        <div class="container">
            <?php if ($orderComplete): ?>
            
            <div class="order-success">
                <div class="success-icon">✓</div>
                <h1>Ordine Completato!</h1>
                <p>Grazie per il tuo ordine, <strong><?php echo htmlspecialchars($userName); ?></strong>!</p>
                <p>Riceverai una email di conferma all'indirizzo <strong><?php echo htmlspecialchars($userEmail); ?></strong></p>
                <p class="order-note">Il tuo ordine verrà preparato a breve. Ti aspettiamo da BurgerQueen!</p>
                
                <?php if ($isGuest): ?>
                <div class="guest-benefits">
                    <h3>🎁 Crea un account e ricevi vantaggi esclusivi!</h3>
                    <div class="benefits-list">
                        <div class="benefit-item">
                            <span class="benefit-icon">⭐</span>
                            <span>10% di sconto sul prossimo ordine</span>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">🎯</span>
                            <span>Punti fedeltà ad ogni acquisto</span>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">💾</span>
                            <span>Salva i tuoi ordini preferiti</span>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">⚡</span>
                            <span>Checkout più veloce</span>
                        </div>
                    </div>
                    <a href="register.php" class="btn-register">Registrati Ora</a>
                </div>
                <?php else: ?>
                <div class="loyalty-points">
                    <h3>✨ Hai guadagnato 10 punti fedeltà!</h3>
                    <p>Continua ad ordinare per sbloccare premi esclusivi</p>
                </div>
                <?php endif; ?>
                
                <a href="index.php" class="btn-primary">Torna al Menu</a>
            </div>
            
            <?php else: ?>
            
            <h1 class="page-title">Checkout</h1>

            <div class="checkout-grid">
                <div class="order-summary">
                    <h2>Riepilogo Ordine</h2>
                    
                    <div class="summary-items">
                        <?php foreach ($cartItems as $item): ?>
                        <div class="summary-item">
                            <div class="summary-item-info">
                                <div class="summary-item-name"><?php echo htmlspecialchars($item['product']['name']); ?></div>
                                <div class="summary-item-qty">Quantità: <?php echo $item['quantity']; ?></div>
                            </div>
                            <div class="summary-item-price">
                                €<?php echo number_format($item['subtotal'], 2, ',', '.'); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="summary-total">
                        <span>Totale:</span>
                        <span class="total-amount">€<?php echo number_format($cartTotal, 2, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="checkout-form">
                    <h2>Dati Consegna</h2>
                    
                    <?php if (!isLoggedIn()): ?>
                    <div class="guest-notice-box">
                        <p>🔓 <strong>Checkout come ospite</strong></p>
                        <p>Oppure <a href="login.php?redirect=checkout">accedi</a> per guadagnare punti fedeltà!</p>
                    </div>
                    <?php else: ?>
                    <div class="member-badge">
                        <p>👑 <strong>Benvenuto, membro BurgerQueen!</strong></p>
                        <p>Guadagnerai 10 punti con questo ordine</p>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <?php if ($isGuest): ?>
                        <div class="form-group">
                            <label for="name">Nome Completo *</label>
                            <input type="text" id="name" name="name" class="form-input" 
                                   placeholder="Il tuo nome" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-input" 
                                   placeholder="tua-email@esempio.com" required>
                        </div>
                        <?php else: ?>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-input" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="address">Indirizzo di Consegna</label>
                            <input type="text" id="address" name="address" class="form-input" 
                                   placeholder="Via, numero civico" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Città</label>
                                <input type="text" id="city" name="city" class="form-input" 
                                       placeholder="Città" required>
                            </div>

                            <div class="form-group">
                                <label for="zip">CAP</label>
                                <input type="text" id="zip" name="zip" class="form-input" 
                                       placeholder="00000" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="tel" id="phone" name="phone" class="form-input" 
                                   placeholder="Numero di telefono" required>
                        </div>

                        <div class="form-group">
                            <label for="notes">Note (opzionale)</label>
                            <textarea id="notes" name="notes" class="form-textarea" rows="3"
                                      placeholder="Eventuali note per la consegna"></textarea>
                        </div>

                        <div class="checkout-info">
                            <p>📧 Riceverai una email di conferma con i dettagli del tuo ordine</p>
                            <p>🚚 Consegna stimata: 30-45 minuti</p>
                        </div>

                        <button type="submit" name="complete_order" class="btn-checkout">
                            Completa Ordine - €<?php echo number_format($cartTotal, 2, ',', '.'); ?>
                        </button>
                    </form>
                </div>
            </div>
            
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
