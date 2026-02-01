<?php
require_once 'config/functions.php';
$pageTitle = 'Registrati';
$pageCSS = 'register.css';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-box">
                    <span class="emoji">🍔</span>
                    <h2>Registrati</h2>
                    <p>Unisciti alla famiglia RoyalBites!</p>
                    
                    <?php if (isset($_GET['error'])): ?>
                    <div class="alert">
                        Errore nella registrazione. Verifica i dati e riprova.
                    </div>
                    <?php endif; ?>
                    
                    <form action="/config/functions.php?action=register" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm" class="form-label">Conferma Password</label>
                            <input type="password" class="form-control" id="confirm" name="confirm" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrati</button>
                    </form>
                    
                    <div class="register-footer">
                        Hai già un account? <a href="/login.php">Accedi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
