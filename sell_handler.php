<?php
require_once 'auth.php';
require_once 'scrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_category = $_POST['material_category'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $condition_type = $_POST['condition_type'] ?? '';
    
    if (empty($material_category) || empty($weight) || empty($condition_type)) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: index.php');
        exit();
    }
    
    // Calculate estimated price
    $price_result = calculateEstimatedPrice($material_category, $weight);
    $estimated_price = $price_result['success'] ? $price_result['price'] : 0;
    
    // Handle file uploads
    $photo_paths = [];
    if (isset($_FILES['photos']) && $_FILES['photos']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        $upload_dir = 'uploads/scrap/';
        
        // Create directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                $file_name = time() . '_' . $key . '_' . basename($_FILES['photos']['name'][$key]);
                $target_path = $upload_dir . $file_name;
                
                if (move_uploaded_file($tmp_name, $target_path)) {
                    $photo_paths[] = $target_path;
                }
            }
        }
    }
    
    $data = [
        'user_id' => getCurrentUserId(),
        'material_category' => $material_category,
        'weight' => $weight,
        'condition_type' => $condition_type,
        'estimated_price' => $estimated_price,
        'photos' => $photo_paths
    ];
    
    $result = createScrapListing($data);
    
    if ($result['success']) {
        $_SESSION['success'] = 'Scrap listing created successfully!';
    } else {
        $_SESSION['error'] = $result['message'];
    }
    
    header('Location: index.php');
    exit();
}
?>
