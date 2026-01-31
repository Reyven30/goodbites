<?php
// User data (in produzione usare un database)
$users = [
    [
        'id' => 1,
        'email' => 'admin@burgerqueen.com',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'name' => 'Admin',
        'role' => 'admin'
    ],
    [
        'id' => 2,
        'email' => 'user@test.com',
        'password' => password_hash('user123', PASSWORD_DEFAULT),
        'name' => 'Test User',
        'role' => 'user'
    ]
];

function getUserByEmail($email) {
    global $users;
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
}

function registerUser($email, $password, $name) {
    global $users;
    
    // Check if user already exists
    if (getUserByEmail($email)) {
        return false;
    }
    
    $newUser = [
        'id' => count($users) + 1,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'name' => $name,
        'role' => 'user'
    ];
    
    $users[] = $newUser;
    return $newUser;
}
?>
