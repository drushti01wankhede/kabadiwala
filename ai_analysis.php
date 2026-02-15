<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Scrap Analyzer - Kabadiwala.online</title>
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
            max-width: 1000px;
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

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .card h3 {
            color: var(--primary-green);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-section {
            grid-column: 1 / -1;
        }

        .upload-area {
            border: 3px dashed #E5E7EB;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            background: var(--light-gray);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .upload-area:hover {
            border-color: var(--primary-green);
            background: var(--light-green);
        }

        .upload-area input[type="file"] {
            display: none;
        }

        .camera-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        #webcam-container {
            display: none;
            margin: 2rem auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .preview-image {
            max-width: 100%;
            border-radius: 12px;
            margin: 1rem 0;
            display: none;
        }

        .button {
            padding: 1rem 2rem;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .button:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
        }

        .button-secondary {
            background: white;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
        }

        .button-secondary:hover {
            background: var(--primary-green);
            color: white;
        }

        #results-container {
            display: none;
        }

        .result-item {
            background: var(--sand);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .result-material {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark-gray);
        }

        .result-confidence {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .confidence-bar {
            width: 200px;
            height: 8px;
            background: #E5E7EB;
            border-radius: 4px;
            overflow: hidden;
        }

        .confidence-fill {
            height: 100%;
            background: var(--accent-green);
            transition: width 0.3s ease;
        }

        .confidence-text {
            font-weight: 600;
            color: var(--primary-green);
        }

        .price-summary {
            background: var(--light-green);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            margin-top: 2rem;
        }

        .price-summary h3 {
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .price-amount {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-green);
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-green);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 0.8rem 0;
            padding-left: 2rem;
            position: relative;
        }

        .feature-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--accent-green);
            font-weight: bold;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .upload-section {
                grid-column: 1;
            }

            .confidence-bar {
                width: 100px;
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
        <div class="page-header">
            <h1>🤖 AI Scrap Analyzer</h1>
            <p>Upload or capture images of your scrap materials for instant AI-powered identification and valuation</p>
        </div>

        <div class="content-grid">
            <div class="card">
                <h3>🎯 How It Works</h3>
                <ul class="feature-list">
                    <li>Upload or capture photos of your scrap</li>
                    <li>AI identifies material types automatically</li>
                    <li>Get instant price estimates</li>
                    <li>Receive quality assessment</li>
                </ul>
            </div>

            <div class="card">
                <h3>🔍 Supported Materials</h3>
                <ul class="feature-list">
                    <li>Paper & Cardboard</li>
                    <li>Plastic (all types)</li>
                    <li>Metal (Aluminum, Steel, Copper)</li>
                    <li>Electronics & E-waste</li>
                    <li>Glass bottles & containers</li>
                </ul>
            </div>
        </div>

        <div class="card upload-section">
            <h3>📸 Upload or Capture Image</h3>
            
            <div class="upload-area" onclick="document.getElementById('imageUpload').click()">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🖼️</div>
                <div style="font-weight: 600; font-size: 1.2rem; margin-bottom: 0.5rem;">Click to upload image</div>
                <div style="font-size: 0.9rem; color: var(--mid-gray);">
                    or drag and drop your image here
                </div>
                <input type="file" id="imageUpload" accept="image/*" onchange="handleImageUpload(event)">
            </div>

            <div class="camera-section">
                <button class="button button-secondary" onclick="toggleWebcam()">
                    📷 Use Camera
                </button>
            </div>

            <div id="webcam-container"></div>
            <img id="preview-image" class="preview-image" />

            <div style="text-align: center; margin-top: 2rem;">
                <button class="button" onclick="analyzeImage()" id="analyzeBtn" style="display: none;">
                    Analyze with AI
                </button>
            </div>

            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>AI is analyzing your image...</p>
            </div>

            <div id="results-container">
                <h3 style="color: var(--primary-green); margin-bottom: 1.5rem;">Analysis Results</h3>
                <div id="predictions"></div>
                <div class="price-summary" id="price-summary" style="display: none;">
                    <h3>Estimated Value</h3>
                    <div class="price-amount" id="total-price">₹0</div>
                    <p style="margin-top: 1rem; color: var(--mid-gray);">Based on AI detection and current market rates</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Load TensorFlow.js and Teachable Machine Library -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>

    <script>
        // Material prices (matching your database)
        const materialPrices = {
            'paper': 10,
            'plastic': 20,
            'metal': 80,
            'electronics': 120,
            'glass': 3.5
        };

        // Teachable Machine model URL (you'll need to replace this with your trained model)
        // To create a model: https://teachablemachine.withgoogle.com/
        const modelURL = 'https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/model.json';
        const metadataURL = 'https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/metadata.json';

        let model, webcam, labelContainer, maxPredictions;
        let isWebcamActive = false;
        let currentImage = null;

        // Load the image model
        async function loadModel() {
            try {
                // For demo purposes, we'll simulate the model
                // In production, replace with: model = await tmImage.load(modelURL, metadataURL);
                console.log('Model loaded (demo mode)');
                return true;
            } catch (error) {
                console.error('Error loading model:', error);
                return false;
            }
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview-image');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    currentImage = preview;
                    document.getElementById('analyzeBtn').style.display = 'inline-block';
                    
                    // Hide webcam if active
                    if (isWebcamActive) {
                        toggleWebcam();
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        async function toggleWebcam() {
            const container = document.getElementById('webcam-container');
            
            if (!isWebcamActive) {
                // Initialize webcam
                const flip = true;
                webcam = new tmImage.Webcam(400, 400, flip);
                await webcam.setup();
                await webcam.play();
                container.appendChild(webcam.canvas);
                container.style.display = 'block';
                isWebcamActive = true;
                
                // Hide uploaded image
                document.getElementById('preview-image').style.display = 'none';
                document.getElementById('analyzeBtn').style.display = 'inline-block';
                
                window.requestAnimationFrame(loop);
            } else {
                // Stop webcam
                webcam.stop();
                container.innerHTML = '';
                container.style.display = 'none';
                isWebcamActive = false;
            }
        }

        async function loop() {
            if (isWebcamActive) {
                webcam.update();
                window.requestAnimationFrame(loop);
            }
        }

        async function analyzeImage() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('results-container').style.display = 'none';
            
            // Simulate AI analysis (replace with actual model prediction)
            setTimeout(() => {
                // Demo predictions
                const predictions = [
                    { className: 'Plastic Bottles', probability: 0.85 },
                    { className: 'Paper', probability: 0.10 },
                    { className: 'Metal', probability: 0.03 },
                    { className: 'Glass', probability: 0.02 }
                ];
                
                displayPredictions(predictions);
                document.getElementById('loading').style.display = 'none';
                document.getElementById('results-container').style.display = 'block';
            }, 2000);

            /* 
            // Actual implementation with trained model:
            const image = isWebcamActive ? webcam.canvas : currentImage;
            const predictions = await model.predict(image);
            displayPredictions(predictions);
            */
        }

        function displayPredictions(predictions) {
            const container = document.getElementById('predictions');
            container.innerHTML = '';
            
            let totalValue = 0;
            let estimatedWeight = 5; // Default weight in kg (you can add weight input)
            
            predictions.forEach(prediction => {
                if (prediction.probability > 0.01) {
                    const resultDiv = document.createElement('div');
                    resultDiv.className = 'result-item';
                    
                    const percentage = (prediction.probability * 100).toFixed(1);
                    
                    // Map class name to material type
                    const materialType = mapToMaterialType(prediction.className);
                    const pricePerKg = materialPrices[materialType] || 0;
                    const value = pricePerKg * estimatedWeight * prediction.probability;
                    totalValue += value;
                    
                    resultDiv.innerHTML = `
                        <div class="result-material">${prediction.className}</div>
                        <div class="result-confidence">
                            <div class="confidence-bar">
                                <div class="confidence-fill" style="width: ${percentage}%"></div>
                            </div>
                            <div class="confidence-text">${percentage}%</div>
                        </div>
                    `;
                    
                    container.appendChild(resultDiv);
                }
            });
            
            // Display total estimated value
            document.getElementById('total-price').textContent = '₹' + totalValue.toFixed(0);
            document.getElementById('price-summary').style.display = 'block';
        }

        function mapToMaterialType(className) {
            const lowerName = className.toLowerCase();
            if (lowerName.includes('plastic')) return 'plastic';
            if (lowerName.includes('paper') || lowerName.includes('cardboard')) return 'paper';
            if (lowerName.includes('metal') || lowerName.includes('aluminum') || lowerName.includes('steel')) return 'metal';
            if (lowerName.includes('electronic') || lowerName.includes('e-waste')) return 'electronics';
            if (lowerName.includes('glass')) return 'glass';
            return 'mixed';
        }

        // Load model on page load
        window.addEventListener('load', loadModel);
    </script>

    <?php include 'chatbot_widget.php'; ?>
</body>
</html>
