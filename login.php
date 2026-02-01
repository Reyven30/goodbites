<?php
/**
 * Login - User login page
 */
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';

// Redirect if already logged in
if (isLoggedIn()) { header('Location: index.php'); exit; }

$err = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    
    if (login($email, $pwd)) {
        $redirect = $_GET['redirect'] ?? 'index';
        header('Location: ' . $redirect . '.php');
        exit;
    }
    $err = 'Email o password non validi';
}

$pageTitle = 'Login';
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
                <h1 class="auth-title">Login</h1>
                <p class="auth-subtitle">Accedi al tuo account GoodBites</p>

                <?php if ($err): ?>
                <div class="alert-error"><?= htmlspecialchars($err) ?></div>
                <?php endif; ?>

                <form method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-input" placeholder="tua-email@esempio.com">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" id="pwd" name="pwd" required class="form-input" placeholder="La tua password">
                    </div>
                    <button type="submit" class="btn-primary btn-full">Accedi</button>
                </form>

                <div class="demo-credentials">
                    <p><strong>Test:</strong> user@test.com / user123</p>
                </div>

                <div class="auth-footer">
                    <p>Non hai un account? <a href="register.php">Registrati qui</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
