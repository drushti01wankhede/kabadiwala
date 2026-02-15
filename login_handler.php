<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email and password are required';
        header('Location: index.php');
        exit();
    }
    
    $result = loginUser($email, $password);
    
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Location: dashboard.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: index.php');
    }
    exit();
}
?>
