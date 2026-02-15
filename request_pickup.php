<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Pickup - Kabadiwala.online</title>
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
            max-width: 800px;
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

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(13, 124, 68, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            margin-top: 1rem;
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

        .info-box {
            background: var(--sand);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .info-box h3 {
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
        }

        .info-box li {
            padding: 0.5rem 0;
            padding-left: 1.5rem;
            position: relative;
        }

        .info-box li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--accent-green);
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-card {
                padding: 2rem 1.5rem;
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
            <h1>Request Doorstep Pickup</h1>
            <p>Schedule a convenient time and we'll collect your scrap materials</p>
        </div>

        <div class="info-box">
            <h3>How It Works</h3>
            <ul>
                <li>Fill in your details and preferred pickup time</li>
                <li>Our team will confirm your pickup within 2 hours</li>
                <li>We arrive at your doorstep at the scheduled time</li>
                <li>Get instant payment after material verification</li>
            </ul>
        </div>

        <div class="form-card">
            <form method="POST" action="pickup_handler.php">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" name="phone" class="form-input" placeholder="10 digit mobile number" pattern="[0-9]{10}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Pickup Address *</label>
                    <textarea name="address" class="form-textarea" placeholder="Enter your complete address with landmarks" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Pincode *</label>
                        <input type="text" name="pincode" class="form-input" placeholder="6 digit pincode" pattern="[0-9]{6}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Material Type *</label>
                        <select name="material_type" class="form-select" required>
                            <option value="">Select material type</option>
                            <option value="paper">Paper & Cardboard</option>
                            <option value="plastic">Plastic</option>
                            <option value="metal">Metal</option>
                            <option value="electronics">Electronics</option>
                            <option value="glass">Glass</option>
                            <option value="mixed">Mixed Materials</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Estimated Weight (kg) *</label>
                        <input type="number" name="estimated_weight" class="form-input" placeholder="Approximate weight" step="0.1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Preferred Date *</label>
                        <input type="date" name="pickup_date" class="form-input" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Preferred Time Slot *</label>
                    <select name="pickup_time" class="form-select" required>
                        <option value="">Select time slot</option>
                        <option value="morning">Morning (8 AM - 12 PM)</option>
                        <option value="afternoon">Afternoon (12 PM - 4 PM)</option>
                        <option value="evening">Evening (4 PM - 8 PM)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Additional Notes (Optional)</label>
                    <textarea name="notes" class="form-textarea" placeholder="Any special instructions or details about the scrap materials"></textarea>
                </div>

                <button type="submit" class="form-button">Schedule Pickup</button>
            </form>
        </div>
    </div>

    <?php include 'chatbot_widget.php'; ?>
</body>
</html>
