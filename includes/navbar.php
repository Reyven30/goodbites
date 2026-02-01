<?php
// Navbar - Barra di navigazione
$cartCount = getCartCount();
$page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">GoodBites</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>" href="index.php">Menu</a>
                </li>
                <?php if (isLoggedIn()): ?>
                <li class="nav-item"><span class="nav-link text-white">Ciao, <?= htmlspecialchars($_SESSION['user_name']) ?></span></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                <li class="nav-item"><a class="nav-link <?= $page == 'login.php' ? 'active' : '' ?>" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link <?= $page == 'register.php' ? 'active' : '' ?>" href="register.php">Registrati</a></li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="cart.php" class="cart-icon-link">
                        <div class="cart-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <?php if ($cartCount > 0): ?>
                            <span class="cart-badge"><?= $cartCount ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
