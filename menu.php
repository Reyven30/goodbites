<?php
require_once 'config/functions.php';
$pageTitle = 'Menu';
$pageCSS = 'menu.css';
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- Menu Header -->
<div class="menu-header">
    <div class="container">
        <span class="emoji">📋</span>
        <h1>Il Nostro Menu</h1>
        <p>Scopri i nostri deliziosi prodotti</p>
    </div>
</div>

<!-- Burgers Section -->
<section class="menu-section">
    <div class="container">
        <h2><span class="emoji">🍔</span> Burger</h2>
        <div class="product-grid">
            <!-- Royal Burger -->
            <div class="product-card">
                <span class="emoji">🍔</span>
                <h3>Royal Burger</h3>
                <p>Doppia carne di manzo, formaggio cheddar, bacon croccante e salsa speciale.</p>
                <span class="price">€12.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="burger-1">
                    <input type="hidden" name="product_name" value="Royal Burger">
                    <input type="hidden" name="product_price" value="12.90">
                    <input type="hidden" name="product_emoji" value="🍔">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Chicken Supreme -->
            <div class="product-card">
                <span class="emoji">🍗</span>
                <h3>Chicken Supreme</h3>
                <p>Petto di pollo grigliato, insalata fresca, pomodoro e maionese al lime.</p>
                <span class="price">€9.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="burger-2">
                    <input type="hidden" name="product_name" value="Chicken Supreme">
                    <input type="hidden" name="product_price" value="9.90">
                    <input type="hidden" name="product_emoji" value="🍗">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Veggie Delight -->
            <div class="product-card">
                <span class="emoji">🥗</span>
                <h3>Veggie Delight</h3>
                <p>Burger vegetariano con verdure grigliate, formaggio e salsa tahini.</p>
                <span class="price">€8.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="burger-3">
                    <input type="hidden" name="product_name" value="Veggie Delight">
                    <input type="hidden" name="product_price" value="8.90">
                    <input type="hidden" name="product_emoji" value="🥗">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- BBQ Bacon Burger -->
            <div class="product-card">
                <span class="emoji">🥓</span>
                <h3>BBQ Bacon Burger</h3>
                <p>Carne di manzo, bacon, cipolle caramellate e salsa BBQ affumicata.</p>
                <span class="price">€11.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="burger-4">
                    <input type="hidden" name="product_name" value="BBQ Bacon Burger">
                    <input type="hidden" name="product_price" value="11.90">
                    <input type="hidden" name="product_emoji" value="🥓">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Sides Section -->
<section class="menu-section">
    <div class="container">
        <h2><span class="emoji">🍟</span> Contorni</h2>
        <div class="product-grid">
            <!-- Patatine Deluxe -->
            <div class="product-card">
                <span class="emoji">🍟</span>
                <h3>Patatine Deluxe</h3>
                <p>Patatine fritte croccanti con condimenti speciali e salse gourmet.</p>
                <span class="price">€4.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="side-1">
                    <input type="hidden" name="product_name" value="Patatine Deluxe">
                    <input type="hidden" name="product_price" value="4.90">
                    <input type="hidden" name="product_emoji" value="🍟">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Onion Rings -->
            <div class="product-card">
                <span class="emoji">🧅</span>
                <h3>Onion Rings</h3>
                <p>Anelli di cipolla croccanti con panatura dorata e salsa ranch.</p>
                <span class="price">€5.50</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="side-2">
                    <input type="hidden" name="product_name" value="Onion Rings">
                    <input type="hidden" name="product_price" value="5.50">
                    <input type="hidden" name="product_emoji" value="🧅">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Insalata Caesar -->
            <div class="product-card">
                <span class="emoji">🥗</span>
                <h3>Insalata Caesar</h3>
                <p>Lattuga romana, crostini, parmigiano e salsa Caesar classica.</p>
                <span class="price">€6.90</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="side-3">
                    <input type="hidden" name="product_name" value="Insalata Caesar">
                    <input type="hidden" name="product_price" value="6.90">
                    <input type="hidden" name="product_emoji" value="🥗">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Drinks Section -->
<section class="menu-section">
    <div class="container">
        <h2><span class="emoji">🥤</span> Bevande</h2>
        <div class="product-grid">
            <!-- Coca Cola -->
            <div class="product-card">
                <span class="emoji">🥤</span>
                <h3>Coca Cola</h3>
                <p>La classica bevanda frizzante che tutti amano, servita ghiacciata.</p>
                <span class="price">€3.50</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="drink-1">
                    <input type="hidden" name="product_name" value="Coca Cola">
                    <input type="hidden" name="product_price" value="3.50">
                    <input type="hidden" name="product_emoji" value="🥤">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Birra Artigianale -->
            <div class="product-card">
                <span class="emoji">🍺</span>
                <h3>Birra Artigianale</h3>
                <p>Birra artigianale locale dal gusto pieno e rinfrescante.</p>
                <span class="price">€5.50</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="drink-2">
                    <input type="hidden" name="product_name" value="Birra Artigianale">
                    <input type="hidden" name="product_price" value="5.50">
                    <input type="hidden" name="product_emoji" value="🍺">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
            
            <!-- Succo d'Arancia -->
            <div class="product-card">
                <span class="emoji">🍊</span>
                <h3>Succo d'Arancia</h3>
                <p>Succo d'arancia fresco spremuto, naturale e senza zuccheri aggiunti.</p>
                <span class="price">€4.50</span>
                <form action="/config/functions.php?action=add_to_cart" method="POST">
                    <input type="hidden" name="product_id" value="drink-3">
                    <input type="hidden" name="product_name" value="Succo d'Arancia">
                    <input type="hidden" name="product_price" value="4.50">
                    <input type="hidden" name="product_emoji" value="🍊">
                    <button type="submit" class="btn btn-primary">Aggiungi al Carrello</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
