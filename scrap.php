<?php
require_once 'config.php';

// Create scrap listing
function createScrapListing($data) {
    global $conn;
    
    $user_id = $data['user_id'] ?? null;
    $material_category = $data['material_category'];
    $weight = $data['weight'];
    $condition_type = $data['condition_type'];
    $estimated_price = $data['estimated_price'];
    $photos = isset($data['photos']) ? json_encode($data['photos']) : null;
    
    $stmt = $conn->prepare("INSERT INTO scrap_listings (user_id, material_category, weight, condition_type, estimated_price, photos) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isdsds", $user_id, $material_category, $weight, $condition_type, $estimated_price, $photos);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Scrap listing created', 'listing_id' => $conn->insert_id];
    }
    
    return ['success' => false, 'message' => 'Failed to create listing'];
}

// Get scrap listing by ID
function getScrapListingById($listing_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM scrap_listings WHERE id = ?");
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $listing = $result->fetch_assoc();
        if ($listing['photos']) {
            $listing['photos'] = json_decode($listing['photos'], true);
        }
        return ['success' => true, 'listing' => $listing];
    }
    
    return ['success' => false, 'message' => 'Listing not found'];
}

// Get user scrap listings
function getUserScrapListings($user_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM scrap_listings WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $listings = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['photos']) {
            $row['photos'] = json_decode($row['photos'], true);
        }
        $listings[] = $row;
    }
    
    return ['success' => true, 'listings' => $listings];
}

// Get all scrap listings
function getAllScrapListings($status = null, $limit = 50, $offset = 0) {
    global $conn;
    
    if ($status) {
        $stmt = $conn->prepare("SELECT s.*, u.name as user_name, u.phone as user_phone FROM scrap_listings s LEFT JOIN users u ON s.user_id = u.id WHERE s.status = ? ORDER BY s.created_at DESC LIMIT ? OFFSET ?");
        $stmt->bind_param("sii", $status, $limit, $offset);
    } else {
        $stmt = $conn->prepare("SELECT s.*, u.name as user_name, u.phone as user_phone FROM scrap_listings s LEFT JOIN users u ON s.user_id = u.id ORDER BY s.created_at DESC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $listings = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['photos']) {
            $row['photos'] = json_decode($row['photos'], true);
        }
        $listings[] = $row;
    }
    
    return ['success' => true, 'listings' => $listings];
}

// Update listing status
function updateScrapListingStatus($listing_id, $status) {
    global $conn;
    
    $valid_statuses = ['pending', 'approved', 'sold', 'rejected'];
    if (!in_array($status, $valid_statuses)) {
        return ['success' => false, 'message' => 'Invalid status'];
    }
    
    $stmt = $conn->prepare("UPDATE scrap_listings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $listing_id);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Listing status updated'];
    }
    
    return ['success' => false, 'message' => 'Failed to update status'];
}

// Calculate estimated price
function calculateEstimatedPrice($material_category, $weight) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT avg_price FROM material_prices WHERE material_type = ?");
    $stmt->bind_param("s", $material_category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $price_data = $result->fetch_assoc();
        return ['success' => true, 'price' => $price_data['avg_price'] * $weight];
    }
    
    return ['success' => false, 'message' => 'Material price not found'];
}

// Get material prices
function getMaterialPrices() {
    global $conn;
    
    $result = $conn->query("SELECT * FROM material_prices");
    
    $prices = [];
    while ($row = $result->fetch_assoc()) {
        $prices[] = $row;
    }
    
    return ['success' => true, 'prices' => $prices];
}
?>
