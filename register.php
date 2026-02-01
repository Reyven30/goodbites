<?php
/**
 * Registrazione - Pagina di registrazione utente
 */
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';
require_once 'data/users.php';

// Reindirizza se già loggato
if (isLoggedIn()) { header('Location: index.php'); exit; }

$err = '';
$ok = '';

// Gestione registrazione
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pwd = $_POST['pwd'] ?? '';
    $pwd2 = $_POST['pwd2'] ?? '';
    
    if (empty($name) || empty($email) || empty($pwd)) {
        $err = 'Tutti i campi sono obbligatori';
    } elseif ($pwd !== $pwd2) {
        $err = 'Le password non corrispondono';
    } elseif (strlen($pwd) < 6) {
        $err = 'La password deve essere di almeno 6 caratteri';
    } elseif (getUserByEmail($email)) {
        $err = 'Email già registrata';
    } else {
        // In un'app reale, salvare nel database qui
        $ok = 'Registrazione completata! Ora puoi effettuare il login.';
    }
}

$pageTitle = 'Registrazione';
$pageCss = 'auth.css';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-box">
                <h1 class="auth-title">Registrati</h1>
                <p class="auth-subtitle">Crea il tuo account e ottieni il 10% di sconto!</p>

                <?php if ($err): ?>
                <div class="alert-error"><?= htmlspecialchars($err) ?></div>
                <?php endif; ?>

                <?php if ($ok): ?>
                <div class="alert-success"><?= htmlspecialchars($ok) ?> <a href="login.php">Vai al Login</a></div>
                <?php endif; ?>

                <form method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" required class="form-input" 
                               placeholder="Il tuo nome" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-input" 
                               placeholder="tua-email@esempio.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" id="pwd" name="pwd" required class="form-input" placeholder="Minimo 6 caratteri">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Conferma Password</label>
                        <input type="password" id="pwd2" name="pwd2" required class="form-input" placeholder="Ripeti la password">
                    </div>
                    <button type="submit" class="btn-primary btn-full">Registrati</button>
                </form>

                <div class="auth-footer">
                    <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
