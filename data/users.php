<?php
/**
 * Users Data - Demo users (use database in production)
 */
$users = [
    ['id' => 1, 'email' => 'admin@goodbites.com', 'password' => 'admin123', 'name' => 'Admin'],
    ['id' => 2, 'email' => 'user@test.com', 'password' => 'user123', 'name' => 'Test User']
];

// Find user by email
function getUserByEmail($email) {
    global $users;
    foreach ($users as $u) {
        if ($u['email'] === $email) return $u;
    }
    return null;
}
?>
