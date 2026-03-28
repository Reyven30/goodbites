<?php
session_start();
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';
require_once 'data/db.php';

if (!isLoggedIn()) {
    header('Location: login.php?redirect=orders');
    exit;
}

$userId = (int)($_SESSION['user_id'] ?? 0);
$pageTitle = 'I miei ordini';
$pageCss = 'orders.css';

$stmt = $conn->prepare("
    SELECT id, total, status, created_at
    FROM orders
    WHERE user_id = ?
    ORDER BY id DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<div class="orders-page">
    <div class="container">
        <h1 class="page-title">I miei ordini</h1>

        <?php if (empty($orders)): ?>
            <p>Non hai ancora effettuato ordini.</p>
            <a href="index.php" class="btn-primary">Vai al Menu</a>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach ($orders as $o): ?>
                    <div class="order-card">
                        <h3>Ordine #<?= (int)$o['id'] ?></h3>
                        <p>Data: <?= htmlspecialchars($o['created_at']) ?></p>
                        <p>Stato: <?= htmlspecialchars($o['status']) ?></p>
                        <p>Totale: €<?= number_format((float)$o['total'], 2, ',', '.') ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>