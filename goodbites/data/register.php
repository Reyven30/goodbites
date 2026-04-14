<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

// Controllo dati arrivati
if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Dati mancanti"
    ]);
    exit;
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Controllo campi vuoti
if ($name == "" || $email == "" || $password == "") {
    echo json_encode([
        "success" => false,
        "message" => "Compila tutti i campi"
    ]);
    exit;
}

// Controllo se email esiste già
$stmtCheck = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$resCheck = $stmtCheck->get_result();

if ($resCheck->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Email già registrata"
    ]);
    exit;
}

// Cripto password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Inserisco nuovo utente
$stmtIns = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmtIns->bind_param("sss", $name, $email, $hash);

if ($stmtIns->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Registrazione completata"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Errore durante la registrazione"
    ]);
}
?>