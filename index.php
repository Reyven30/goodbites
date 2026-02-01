<?php
require_once 'config/functions.php';
$pageTitle = 'Home';
$pageCSS = 'index.css';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <span class="emoji">🍔</span>
        <h1>Benvenuto a RoyalBites</h1>
        <p>L'esperienza premium dei burger gourmet</p>
        <a href="/menu.php" class="btn btn-light btn-lg">Esplora il Menu</a>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <h2>Chi Siamo</h2>
        <p>
            RoyalBites è nato dalla passione per i burger di qualità superiore. Utilizziamo solo ingredienti freschi e selezionati per offrire un'esperienza culinaria unica. 
            Ogni nostro burger è preparato con cura artigianale e amore per il cibo di qualità.
        </p>
    </div>
</section>

<!-- Featured Section -->
<section class="featured-section">
    <div class="container">
        <h2>I Nostri Best Seller</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="featured-card">
                    <span class="emoji">🍔</span>
                    <h3>Royal Burger</h3>
                    <p>Il nostro signature burger con doppia carne di manzo, formaggio cheddar, bacon croccante e salsa speciale.</p>
                    <div class="price">€12.90</div>
                    <a href="/menu.php" class="btn btn-primary">Ordina Ora</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="featured-card">
                    <span class="emoji">🍔</span>
                    <h3>Chicken Supreme</h3>
                    <p>Petto di pollo grigliato, insalata fresca, pomodoro e maionese al lime su pane brioche.</p>
                    <div class="price">€9.90</div>
                    <a href="/menu.php" class="btn btn-primary">Ordina Ora</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="featured-card">
                    <span class="emoji">🍟</span>
                    <h3>Patatine Deluxe</h3>
                    <p>Patatine fritte croccanti con condimenti speciali e salse gourmet a scelta.</p>
                    <div class="price">€4.90</div>
                    <a href="/menu.php" class="btn btn-primary">Ordina Ora</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
