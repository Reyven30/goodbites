<?php
/**
 * Dati Utenti - Utenti demo (in produzione usare database)
 */
$users = [
    ['id' => 1, 'email' => 'admin@goodbites.com', 'password' => 'admin123', 'name' => 'Admin'],
    ['id' => 2, 'email' => 'user@test.com', 'password' => 'user123', 'name' => 'Test User']
];

// Cerca utente per email
function getUserByEmail($email) {
    global $users;
    foreach ($users as $u) {
        if ($u['email'] === $email) return $u;
    }
    return null;
}
?>
