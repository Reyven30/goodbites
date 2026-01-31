<?php
require_once 'includes/config.php';
require_once 'data/users.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Tutti i campi sono obbligatori';
    } elseif ($password !== $confirmPassword) {
        $error = 'Le password non corrispondono';
    } elseif (strlen($password) < 6) {
        $error = 'La password deve essere di almeno 6 caratteri';
    } else {
        $user = registerUser($email, $password, $name);
        if ($user) {
            $success = 'Registrazione completata! Ora puoi effettuare il login.';
        } else {
            $error = 'Email già registrata';
        }
    }
}

$pageTitle = 'Registrazione';
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
                <h1 class="auth-title">Registrati</h1>
                <p class="auth-subtitle">Crea il tuo account BurgerQueen</p>

                <?php if ($error): ?>
                <div class="alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="alert-success">
                    <?php echo htmlspecialchars($success); ?>
                    <a href="login.php">Vai al Login</a>
                </div>
                <?php endif; ?>

                <form method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text" id="name" name="name" required class="form-input" 
                               placeholder="Il tuo nome" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-input" 
                               placeholder="tua-email@esempio.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required class="form-input"
                               placeholder="Minimo 6 caratteri">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Conferma Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required class="form-input"
                               placeholder="Ripeti la password">
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
