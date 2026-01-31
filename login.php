<?php
require_once 'includes/config.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (login($email, $password)) {
        $redirect = $_GET['redirect'] ?? 'index.php';
        header('Location: ' . $redirect . '.php');
        exit;
    } else {
        $error = 'Email o password non validi';
    }
}

$pageTitle = 'Login';
$paginaCSS = 'auth.css';
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
                <p class="auth-subtitle">Accedi al tuo account BurgerQueen</p>

                <?php if ($error): ?>
                <div class="alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <form method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-input" 
                               placeholder="tua-email@esempio.com">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required class="form-input"
                               placeholder="La tua password">
                    </div>

                    <button type="submit" class="btn-primary btn-full">Accedi</button>
                </form>

                <div class="auth-footer">
                    <p>Non hai un account? <a href="register.php">Registrati qui</a></p>
                </div>

                <div class="demo-credentials">
                    <p><strong>Credenziali di test:</strong></p>
                    <p>Email: user@test.com</p>
                    <p>Password: user123</p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
