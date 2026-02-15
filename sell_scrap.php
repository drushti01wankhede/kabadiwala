<?php
require_once 'auth.php';
require_once 'scrap.php';

// Get material prices for display
$prices_result = getMaterialPrices();
$prices = $prices_result['prices'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Scrap - Kabadiwala.online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-green: #0D7C44;
            --dark-green: #064929;
            --accent-green: #10B981;
            --light-green: #D1FAE5;
            --cream: #FFFEF7;
            --sand: #F5F3E8;
            --dark-gray: #1F2937;
            --mid-gray: #6B7280;
            --light-gray: #F9FAFB;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            line-height: 1.6;
            color: var(--dark-gray);
            background: var(--cream);
        }

        nav {
            background: var(--primary-green);
            padding: 1.5rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--mid-gray);
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .price-card {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            border: 2px solid #E5E7EB;
        }

        .price-card .material {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .price-card .price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-green);
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-gray);
        }

        .form-input, .form-select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(13, 124, 68, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .price-estimate {
            background: var(--light-green);
            padding: 2rem;
            border-radius: 15px;
            margin: 2rem 0;
            text-align: center;
        }

        .price-estimate .label {
            font-size: 0.9rem;
            color: var(--mid-gray);
            margin-bottom: 0.5rem;
        }

        .price-estimate .amount {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-green);
        }

        .price-estimate .note {
            font-size: 0.85rem;
            color: var(--mid-gray);
            margin-top: 0.5rem;
        }

        .form-button {
            width: 100%;
            padding: 1.2rem;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-button:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 124, 68, 0.3);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .alert-success {
            background: var(--light-green);
            color: var(--dark-green);
            border: 2px solid var(--accent-green);
        }

        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            border: 2px solid #EF4444;
        }

        .upload-area {
            border: 2px dashed #E5E7EB;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: var(--light-gray);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: var(--primary-green);
            background: var(--light-green);
        }

        .upload-area input[type="file"] {
            display: none;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-card {
                padding: 2rem 1.5rem;
            }

            .price-estimate .amount {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="index.php" class="logo">kabadiwala.online</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <?php if (isLoggedIn()): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="index.php#login">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✓ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ✗ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="page-header">
            <h1>Sell Your Scrap</h1>
            <p>Get instant price estimates and list your materials for sale</p>
        </div>

        <div class="price-grid">
            <?php foreach ($prices as $price): ?>
                <div class="price-card">
                    <div class="material"><?php echo ucfirst($price['material_type']); ?></div>
                    <div class="price">₹<?php echo number_format($price['avg_price'], 0); ?>/kg</div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-card">
            <form method="POST" action="sell_handler.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Material Category *</label>
                        <select name="material_category" id="material" class="form-select" onchange="calculatePrice()" required>
                            <option value="">Select category</option>
                            <?php foreach ($prices as $price): ?>
                                <option value="<?php echo $price['material_type']; ?>" data-price="<?php echo $price['avg_price']; ?>">
                                    <?php echo ucfirst($price['material_type']); ?> (₹<?php echo number_format($price['min_price'], 0); ?>-<?php echo number_format($price['max_price'], 0); ?>/kg)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Weight (kg) *</label>
                        <input type="number" name="weight" id="weight" class="form-input" placeholder="Enter weight" step="0.1" min="0.1" oninput="calculatePrice()" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Condition *</label>
                    <select name="condition_type" class="form-select" required>
                        <option value="">Select condition</option>
                        <option value="excellent">Excellent - Clean and sorted</option>
                        <option value="good">Good - Mostly clean</option>
                        <option value="average">Average - Mixed condition</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Photos (Optional)</label>
                    <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📸</div>
                        <div style="font-weight: 600;">Click to upload photos</div>
                        <div style="font-size: 0.9rem; color: var(--mid-gray); margin-top: 0.5rem;">
                            Upload clear photos for better price estimation
                        </div>
                        <input type="file" id="fileInput" name="photos[]" accept="image/*" multiple>
                    </div>
                </div>

                <div class="price-estimate">
                    <div class="label">Estimated Value</div>
                    <div class="amount" id="estimatedPrice">₹0</div>
                    <div class="note">Final price may vary based on actual inspection</div>
                </div>

                <button type="submit" class="form-button">Create Listing</button>
            </form>
        </div>
    </div>

    <script>
        function calculatePrice() {
            const materialSelect = document.getElementById('material');
            const weightInput = document.getElementById('weight');
            const priceDisplay = document.getElementById('estimatedPrice');

            const selectedOption = materialSelect.options[materialSelect.selectedIndex];
            const pricePerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const weight = parseFloat(weightInput.value) || 0;

            const totalPrice = pricePerKg * weight;
            priceDisplay.textContent = '₹' + totalPrice.toFixed(0);
        }
    </script>

    <?php include 'chatbot_widget.php'; ?>
</body>
</html>
