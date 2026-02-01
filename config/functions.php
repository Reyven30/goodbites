<?php
// RoyalBites - Configuration and Functions
session_start();

// Initialize global variables
$logged = false;
$userName = '';
$cart = array();
$cartCount = 0;
$cartTotal = 0;

// Check if user is logged in
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    $logged = true;
    $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
}

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$cart = $_SESSION['cart'];

// Calculate cart count and total
foreach ($cart as $item) {
    $cartCount += $item['quantity'];
    $cartTotal += $item['price'] * $item['quantity'];
}

// Handle actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    // Login action
    if ($action === 'login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            
            if (!empty($email) && !empty($password)) {
                // Simple validation (no database, just check format)
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Extract name from email (part before @)
                    $name = explode('@', $email)[0];
                    $name = ucfirst($name);
                    
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                    
                    header('Location: /index.php');
                    exit();
                }
            }
            header('Location: /login.php?error=1');
            exit();
        }
    }
    
    // Register action
    if ($action === 'register') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $confirm = isset($_POST['confirm']) ? trim($_POST['confirm']) : '';
            
            if (!empty($name) && !empty($email) && !empty($password) && !empty($confirm)) {
                if ($password === $confirm && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                    
                    header('Location: /index.php');
                    exit();
                }
            }
            header('Location: /register.php?error=1');
            exit();
        }
    }
    
    // Add to cart action
    if ($action === 'add_to_cart') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
            $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
            $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
            $product_emoji = isset($_POST['product_emoji']) ? $_POST['product_emoji'] : '';
            
            if (!empty($product_id) && !empty($product_name) && $product_price > 0) {
                // Check if product already exists in cart
                $found = false;
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] === $product_id) {
                        $_SESSION['cart'][$key]['quantity'] += 1;
                        $found = true;
                        break;
                    }
                }
                
                // Add new product if not found
                if (!$found) {
                    $_SESSION['cart'][] = array(
                        'id' => $product_id,
                        'name' => $product_name,
                        'price' => $product_price,
                        'emoji' => $product_emoji,
                        'quantity' => 1
                    );
                }
            }
            
            // Redirect back to menu
            header('Location: /menu.php');
            exit();
        }
    }
    
    // Remove from cart action
    if ($action === 'remove_from_cart') {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] === $product_id) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
                    break;
                }
            }
        }
        
        header('Location: /cart.php');
        exit();
    }
    
    // Logout action
    if ($action === 'logout') {
        $_SESSION['user_logged_in'] = false;
        $_SESSION['user_name'] = '';
        $_SESSION['user_email'] = '';
        unset($_SESSION['user_logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        
        header('Location: /index.php');
        exit();
    }
}
?>
