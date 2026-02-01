<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/index.php">
            <span class="brand-emoji">🍔</span>
            <span class="brand-text">RoyalBites</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/menu.php">Menu</a>
                </li>
                
                <?php if ($logged): ?>
                    <li class="nav-item">
                        <span class="nav-link welcome-text">Bentornato, <?php echo htmlspecialchars($userName); ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/config/functions.php?action=logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register.php">Registrati</a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link cart-icon" href="/cart.php">
                        🛒
                        <?php if ($cartCount > 0): ?>
                        <span class="cart-badge"><?php echo $cartCount; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
