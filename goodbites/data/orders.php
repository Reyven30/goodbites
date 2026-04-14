<?php
require_once __DIR__ . '/db.php';

/*
 * Salva un ordine nel database.
 * Ritorna l'id ordine se va bene, altrimenti false.
 */
function createOrder(int $userId, array $cartItems, float $total) {
    global $conn;

    // Controlli minimi
    if ($userId <= 0 || empty($cartItems) || $total <= 0) {
        return false;
    }

    $conn->begin_transaction();

    try {
        // Inserisco ordine
        $stmtOrder = $conn->prepare("
            INSERT INTO orders (user_id, total, status)
            VALUES (?, ?, 'pending')
        ");
        $stmtOrder->bind_param("id", $userId, $total);
        $stmtOrder->execute();

        $orderId = (int)$conn->insert_id;
        if ($orderId <= 0) {
            throw new Exception("Ordine non creato");
        }

        // Inserisco prodotti dell'ordine
        $stmtItem = $conn->prepare("
            INSERT INTO order_items (order_id, product_id, product_name, unit_price, qty, line_total)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        foreach ($cartItems as $item) {
            $productId = (int)$item['id'];
            $productName = (string)$item['name'];
            $unitPrice = (float)$item['price'];
            $qty = (int)$item['qty'];
            $lineTotal = $unitPrice * $qty;

            $stmtItem->bind_param("iisdid", $orderId, $productId, $productName, $unitPrice, $qty, $lineTotal);
            $stmtItem->execute();
        }

        $conn->commit();
        return $orderId;

    } catch (Throwable $e) {
        $conn->rollback();
        return false;
    }
}