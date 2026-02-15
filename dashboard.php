<?php
require_once 'auth.php';
require_once 'pickup.php';
require_once 'scrap.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$user_id = getCurrentUserId();
$user_info = getUserById($user_id);
$user = $user_info['user'];

// Get user's pickups
$pickups_result = getUserPickups($user_id);
$pickups = $pickups_result['pickups'];

// Get user's scrap listings
$listings_result = getUserScrapListings($user_id);
$listings = $listings_result['listings'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kabadiwala.online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: #0D7C44;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 2rem;
        }
        
        .logout-btn {
            background: white;
            color: #0D7C44;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }
        
        .user-info {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .section h2 {
            color: #0D7C44;
            margin-bottom: 20px;
            border-bottom: 2px solid #0D7C44;
            padding-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #f8f8f8;
            font-weight: bold;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        
        .status-pending {
            background: #FEF3C7;
            color: #92400E;
        }
        
        .status-confirmed {
            background: #DBEAFE;
            color: #1E40AF;
        }
        
        .status-completed {
            background: #D1FAE5;
            color: #065F46;
        }
        
        .status-cancelled {
            background: #FEE2E2;
            color: #991B1B;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #0D7C44;
            text-decoration: none;
            font-weight: bold;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #10B981;
        }
        
        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #EF4444;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Back to Home</a>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="header">
            <div>
                <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?> | Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="section">
            <h2>My Pickups</h2>
            <?php if (count($pickups) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Address</th>
                            <th>Material</th>
                            <th>Weight (kg)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pickups as $pickup): ?>
                            <tr>
                                <td>#<?php echo $pickup['id']; ?></td>
                                <td><?php echo date('d M Y', strtotime($pickup['pickup_date'])); ?></td>
                                <td><?php echo htmlspecialchars($pickup['pickup_time']); ?></td>
                                <td><?php echo htmlspecialchars(substr($pickup['address'], 0, 50)) . '...'; ?></td>
                                <td><?php echo htmlspecialchars($pickup['material_type'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($pickup['estimated_weight'] ?? 'N/A'); ?></td>
                                <td><span class="status status-<?php echo $pickup['status']; ?>"><?php echo ucfirst($pickup['status']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">No pickups scheduled yet. Schedule your first pickup from the home page!</div>
            <?php endif; ?>
        </div>
        
        <div class="section">
            <h2>My Scrap Listings</h2>
            <?php if (count($listings) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Material</th>
                            <th>Weight (kg)</th>
                            <th>Condition</th>
                            <th>Estimated Price</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listings as $listing): ?>
                            <tr>
                                <td>#<?php echo $listing['id']; ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($listing['material_category'])); ?></td>
                                <td><?php echo htmlspecialchars($listing['weight']); ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($listing['condition_type'])); ?></td>
                                <td>₹<?php echo number_format($listing['estimated_price'], 2); ?></td>
                                <td><span class="status status-<?php echo $listing['status']; ?>"><?php echo ucfirst($listing['status']); ?></span></td>
                                <td><?php echo date('d M Y', strtotime($listing['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">No scrap listings yet. Create your first listing from the home page!</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
