<?php
require_once 'config.php';

// User registration
function registerUser($name, $email, $phone, $password, $user_type = 'customer') {
    global $conn;
    
    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => false, 'message' => 'Email already exists'];
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $hashed_password, $user_type);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Registration successful', 'user_id' => $conn->insert_id];
    } else {
        return ['success' => false, 'message' => 'Registration failed'];
    }
}

// User login
function loginUser($email, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, name, email, phone, password, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Invalid email or password'];
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_type'] = $user['user_type'];
        
        return [
            'success' => true, 
            'message' => 'Login successful',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'user_type' => $user['user_type']
            ]
        ];
    } else {
        return ['success' => false, 'message' => 'Invalid email or password'];
    }
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get current user ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Logout user
function logoutUser() {
    session_destroy();
    return ['success' => true, 'message' => 'Logged out successfully'];
}

// Get user details
function getUserById($user_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, name, email, phone, user_type, address, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => true, 'user' => $result->fetch_assoc()];
    }
    
    return ['success' => false, 'message' => 'User not found'];
}
?>
