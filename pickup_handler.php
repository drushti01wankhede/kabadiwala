<?php
require_once 'auth.php';
require_once 'pickup.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $pickup_date = $_POST['pickup_date'] ?? '';
    $pickup_time = $_POST['pickup_time'] ?? '';
    $material_type = $_POST['material_type'] ?? null;
    $estimated_weight = $_POST['estimated_weight'] ?? null;
    
    if (empty($name) || empty($phone) || empty($address) || empty($pincode) || empty($pickup_date) || empty($pickup_time)) {
        $_SESSION['error'] = 'All required fields must be filled';
        header('Location: index.php');
        exit();
    }
    
    $data = [
        'user_id' => getCurrentUserId(),
        'name' => $name,
        'phone' => $phone,
        'address' => $address,
        'pincode' => $pincode,
        'pickup_date' => $pickup_date,
        'pickup_time' => $pickup_time,
        'material_type' => $material_type,
        'estimated_weight' => $estimated_weight
    ];
    
    $result = schedulePickup($data);
    
    if ($result['success']) {
        $_SESSION['success'] = 'Pickup scheduled successfully!';
    } else {
        $_SESSION['error'] = $result['message'];
    }
    
    header('Location: index.php');
    exit();
}
?>
