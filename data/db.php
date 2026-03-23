<?php
$conn = new mysqli("localhost", "flores", "vWy7Xr7kvdpp", "my_flores");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>