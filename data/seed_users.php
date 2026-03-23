<?php
require_once 'db.php';

$adminHash = password_hash("adminpass", PASSWORD_DEFAULT);
$userHash  = password_hash("userpass", PASSWORD_DEFAULT);

$stmt = $conn->prepare("
    INSERT INTO users (name, email, password)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE name = VALUES(name), password = VALUES(password)
");

$name = "Admin";
$email = "admin@goodbites.com";
$pwd = $adminHash;
$stmt->bind_param("sss", $name, $email, $pwd);
$stmt->execute();

$name = "User";
$email = "user@goodbites.com";
$pwd = $userHash;
$stmt->bind_param("sss", $name, $email, $pwd);
$stmt->execute();

echo "Users seeded successfully.";