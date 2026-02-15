<?php
require_once 'config.php';

// Schedule a pickup
function schedulePickup($data) {
    global $conn;
    
    $user_id = $data['user_id'] ?? null;
    $name = $data['name'];
    $phone = $data['phone'];
    $address = $data['address'];
    $pincode = $data['pincode'];
    $pickup_date = $data['pickup_date'];
    $pickup_time = $data['pickup_time'];
    $material_type = $data['material_type'] ?? null;
    $estimated_weight = $data['estimated_weight'] ?? null;
    $notes = $data['notes'] ?? null;
    
    $stmt = $conn->prepare("INSERT INTO pickups (user_id, name, phone, address, pincode, pickup_date, pickup_time, material_type, estimated_weight, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssds", $user_id, $name, $phone, $address, $pincode, $pickup_date, $pickup_time, $material_type, $estimated_weight, $notes);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Pickup scheduled successfully', 'pickup_id' => $conn->insert_id];
    } else {
        return ['success' => false, 'message' => 'Failed to schedule pickup'];
    }
}

// Get pickup by ID
function getPickupById($pickup_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM pickups WHERE id = ?");
    $stmt->bind_param("i", $pickup_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => true, 'pickup' => $result->fetch_assoc()];
    }
    
    return ['success' => false, 'message' => 'Pickup not found'];
}

// Get all pickups for a user
function getUserPickups($user_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM pickups WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $pickups = [];
    while ($row = $result->fetch_assoc()) {
        $pickups[] = $row;
    }
    
    return ['success' => true, 'pickups' => $pickups];
}

// Update pickup status
function updatePickupStatus($pickup_id, $status) {
    global $conn;
    
    $valid_statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
    if (!in_array($status, $valid_statuses)) {
        return ['success' => false, 'message' => 'Invalid status'];
    }
    
    $stmt = $conn->prepare("UPDATE pickups SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $pickup_id);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Pickup status updated'];
    }
    
    return ['success' => false, 'message' => 'Failed to update status'];
}

// Get all pickups (for admin/dealer)
function getAllPickups($limit = 50, $offset = 0) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT p.*, u.name as user_name, u.email as user_email FROM pickups p LEFT JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $pickups = [];
    while ($row = $result->fetch_assoc()) {
        $pickups[] = $row;
    }
    
    return ['success' => true, 'pickups' => $pickups];
}
?>
