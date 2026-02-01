<?php
require_once 'config/functions.php';
$pageTitle = 'Login';
$pageCSS = 'login.css';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-box">
                    <span class="emoji">🍔</span>
                    <h2>Accedi</h2>
                    <p>Bentornato a RoyalBites!</p>
                    
                    <?php if (isset($_GET['error'])): ?>
                    <div class="alert">
                        Credenziali non valide. Riprova.
                    </div>
                    <?php endif; ?>
                    
                    <form action="/config/functions.php?action=login" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Accedi</button>
                    </form>
                    
                    <div class="login-footer">
                        Non hai un account? <a href="/register.php">Registrati ora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
