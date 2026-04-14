<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

// Controllo dati arrivati
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Dati mancanti"
    ]);
    exit;
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Controllo campi vuoti
if ($email == "" || $password == "") {
    echo json_encode([
        "success" => false,
        "message" => "Compila tutti i campi"
    ]);
    exit;
}

// Cerco utente per email
$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

// Email non trovata
if ($res->num_rows == 0) {
    echo json_encode([
        "success" => false,
        "message" => "Account inesistente"
    ]);
    exit;
}

$user = $res->fetch_assoc();

// Controllo password (hash)
if (password_verify($password, $user['password'])) {
    echo json_encode([
        "success" => true,
        "message" => "Login effettuato con successo"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Password sbagliata"
    ]);
}
?>