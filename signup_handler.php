<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? 'customer';
    
    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: index.php');
        exit();
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header('Location: index.php');
        exit();
    }
    
    // Validate phone (basic validation)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $_SESSION['error'] = 'Invalid phone number (10 digits required)';
        header('Location: index.php');
        exit();
    }
    
    $result = registerUser($name, $email, $phone, $password, $user_type);
    
    if ($result['success']) {
        // Auto login after registration
        loginUser($email, $password);
        $_SESSION['success'] = 'Account created successfully!';
        header('Location: dashboard.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: index.php');
    }
    exit();
}
?>
