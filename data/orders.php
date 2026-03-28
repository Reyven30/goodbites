<?php
require_once __DIR__ . '/db.php';

/**
 * Crea un ordine con le sue righe (order_items).
 * $cartItems: array di prodotti con chiavi: id, name, price, qty
 * Ritorna: order_id (int) se ok, false se errore
 */
function createOrder(int $userId, array $cartItems, float $total) {
    global $conn;

    if ($userId <= 0 || empty($cartItems) || $total <= 0) {
        error_log("createOrder validation failed: userId=$userId total=$total items=" . count($cartItems));
        return false;
    }

    $conn->begin_transaction();

    try {
        // 1) Inserisco ordine
        $stmtOrder = $conn->prepare("
            INSERT INTO orders (user_id, total, status)
            VALUES (?, ?, 'pending')
        ");
        if (!$stmtOrder) {
            throw new Exception("Prepare orders failed: " . $conn->error);
        }

        $stmtOrder->bind_param("id", $userId, $total);

        if (!$stmtOrder->execute()) {
            throw new Exception("Execute orders failed: " . $stmtOrder->error);
        }

        $orderId = (int)$conn->insert_id;
        if ($orderId <= 0) {
            throw new Exception("Invalid orderId after insert.");
        }

        // 2) Inserisco righe ordine
        $stmtItem = $conn->prepare("
            INSERT INTO order_items (order_id, product_id, product_name, unit_price, qty, line_total)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        if (!$stmtItem) {
            throw new Exception("Prepare order_items failed: " . $conn->error);
        }

        foreach ($cartItems as $item) {
            $productId = (int)$item['id'];
            $productName = (string)$item['name'];
            $unitPrice = (float)$item['price'];
            $qty = (int)$item['qty'];
            $lineTotal = $unitPrice * $qty;

            $stmtItem->bind_param("iisdid", $orderId, $productId, $productName, $unitPrice, $qty, $lineTotal);

            if (!$stmtItem->execute()) {
                throw new Exception("Execute order_items failed: " . $stmtItem->error);
            }
        }

        $conn->commit();
        return $orderId;

    } catch (Throwable $e) {
        $conn->rollback();
        error_log("createOrder error: " . $e->getMessage());
        return false;
    }
}