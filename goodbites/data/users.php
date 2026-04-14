<?php
require_once __DIR__ . '/db.php';

// Trova utente per email
function getUserByEmail($email) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, email, password, name FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $res = $stmt->get_result();
    return $res->fetch_assoc() ?: null;
}

// Crea nuovo utente
function createUser($name, $email, $passwordHash) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $passwordHash);
    return $stmt->execute();
}
?>