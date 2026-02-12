<?php
/**
 * Dati Utenti - Utenti demo (in produzione usare database)
 */
$users = [
    [
        'id' => 1, 
        'email' => 'admin@goodbites.com', 
        'password' => password_hash('adminpass', PASSWORD_DEFAULT) 
        'name' => 'Admin'
        ],
    [
        'id' => 2, 
        'email' => 'user@test.com', 
        'password' => password_hash('userpass', PASSWORD_DEFAULT),
        'name' => 'Test User'
    ]
];

// Trova utente per email
function getUserByEmail($email) {
    global $conn;

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc(); // restituisce array associativo con i dati utente, o null se non esiste
}
?>
