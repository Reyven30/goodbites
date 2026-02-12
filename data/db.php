<?php
$conn = new mysqli("localhost", "flores", "vWy7Xr7kvdpp", "my_flores");
$adminHash = password_hash("adminpass", PASSWORD_DEFAULT);
$userHash = password_hash("userpass", PASSWORD_DEFAULT);

$conn->query("INSERT INTO users (name,email,password) VALUES ('Admin', 'admin@goodbites.com', '$adminHash')");
$conn->query("INSERT INTO users (name,email,password) VALUES ('user', 'user@goodbites.com', '$userHash')");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);// stampa l’errore di connessione

?>  