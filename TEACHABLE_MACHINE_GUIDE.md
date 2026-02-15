# Google Teachable Machine Integration Guide

This guide explains how to train and integrate Google's machine learning model for scrap material identification in your Kabadiwala application.

## What is Google Teachable Machine?

Teachable Machine is a web-based tool from Google that makes creating machine learning models fast, easy, and accessible to everyone. You can train a computer to recognize images without any coding.

Website: https://teachablemachine.withgoogle.com/

## Step-by-Step Setup

### Step 1: Access Teachable Machine

1. Go to https://teachablemachine.withgoogle.com/
2. Click "Get Started"
3. Select "Image Project"
4. Choose "Standard image model"

### Step 2: Create Training Classes

Create classes for each material type you want to identify:

**Recommended Classes:**
1. **Paper** - newspapers, cardboard, magazines, office paper
2. **Plastic** - bottles, containers, bags, packaging
3. **Metal** - aluminum cans, steel items, copper wire
4. **Electronics** - phones, computers, cables, circuit boards
5. **Glass** - bottles, jars, broken glass
6. **Mixed/Unknown** - for items that don't fit other categories

### Step 3: Collect Training Data

For each class, you need to provide training images:

**Option A: Upload Images**
- Collect 50-100 images per class
- Use diverse lighting conditions
- Include different angles and backgrounds
- Show various conditions (clean, dirty, crushed)

**Option B: Use Webcam**
- Click "Webcam" button in each class
- Hold up different examples
- Capture 50-100 samples per class
- Rotate and move items while capturing

**Tips for Better Training:**
- Use real scrap materials, not stock photos
- Include various brands and colors
- Show different sizes and quantities
- Mix clean and dirty conditions
- Use realistic backgrounds (floor, table, bag)

### Step 4: Train Your Model

1. Click "Train Model" button
2. Wait for training to complete (5-10 minutes)
3. Test the model with the Preview section
4. If accuracy is low, add more training images

**Expected Accuracy:**
- Good model: 80-90% accuracy
- Excellent model: 90-95% accuracy
- If below 80%, add more diverse training images

### Step 5: Export Your Model

1. Click "Export Model"
2. Select "TensorFlow.js" tab
3. Choose "Upload my model"
4. Click "Upload my model" button
5. Wait for upload to complete
6. Copy the model URL provided

You'll get two URLs:
```
Model URL: https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/model.json
Metadata URL: https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/metadata.json
```

### Step 6: Integrate into Your Application

Open `ai_analysis.php` and update these lines:

```javascript
// Replace these URLs with your model URLs
const modelURL = 'https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/model.json';
const metadataURL = 'https://teachablemachine.withgoogle.com/models/YOUR_MODEL_ID/metadata.json';
```

**Also update the model loading function:**

Find this section in ai_analysis.php:
```javascript
async function loadModel() {
    try {
        // Remove this comment and uncomment the line below:
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();
        console.log('Model loaded successfully');
        return true;
    } catch (error) {
        console.error('Error loading model:', error);
        return false;
    }
}
```

**Update the analyzeImage function:**

Replace the demo code with actual prediction:
```javascript
async function analyzeImage() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('results-container').style.display = 'none';
    
    // Get the image to analyze
    const image = isWebcamActive ? webcam.canvas : currentImage;
    
    // Run prediction
    const predictions = await model.predict(image);
    
    // Display results
    displayPredictions(predictions);
    document.getElementById('loading').style.display = 'none';
    document.getElementById('results-container').style.display = 'block';
}
```

### Step 7: Map Class Names to Materials

Update the `mapToMaterialType` function to match your class names:

```javascript
function mapToMaterialType(className) {
    const lowerName = className.toLowerCase();
    
    // Match your Teachable Machine class names exactly
    if (lowerName === 'paper' || lowerName.includes('cardboard')) return 'paper';
    if (lowerName === 'plastic' || lowerName.includes('bottle')) return 'plastic';
    if (lowerName === 'metal' || lowerName.includes('aluminum')) return 'metal';
    if (lowerName === 'electronics' || lowerName.includes('e-waste')) return 'electronics';
    if (lowerName === 'glass') return 'glass';
    
    return 'mixed';
}
```

## Advanced Training Tips

### Improving Model Accuracy

1. **Add More Diverse Images**
   - Different lighting (bright, dim, outdoor, indoor)
   - Various backgrounds
   - Different camera angles
   - Close-up and far away shots

2. **Balance Your Dataset**
   - Ensure each class has similar number of images
   - Don't over-represent one material type

3. **Include Edge Cases**
   - Damaged or crushed items
   - Wet or dirty materials
   - Partially visible items
   - Mixed materials in one frame

4. **Test and Iterate**
   - Test with real-world images
   - Add more training data for misclassified items
   - Retrain the model

### Handling Multiple Materials

If you want to detect multiple materials in one image:

1. In Teachable Machine, train separate classes for combinations:
   - "Plastic and Paper"
   - "Metal and Electronics"
   - "Mixed Materials"

2. Or, use the confidence scores to detect multiple materials:
```javascript
// In displayPredictions function
predictions.forEach(prediction => {
    if (prediction.probability > 0.2) { // Lower threshold for multiple detection
        // Add to results
    }
});
```

## Alternative: TensorFlow Lite for Better Performance

For production use with better performance:

1. Export as "TensorFlow Lite"
2. Convert to TensorFlow.js using:
```bash
pip install tensorflowjs
tensorflowjs_converter --input_format=tf_saved_model \
    --output_format=tfjs_graph_model \
    /path/to/saved_model \
    /path/to/web_model
```

## Using Pre-trained Models

If you don't want to train your own model, you can use these alternatives:

### Option 1: MobileNet + Custom Classifier
```javascript
// Load pre-trained MobileNet
const mobilenet = await tf.loadLayersModel(
    'https://storage.googleapis.com/tfjs-models/tfjs/mobilenet_v1_0.25_224/model.json'
);
```

### Option 2: Google Vision API (Cloud-based)
```javascript
// Requires API key from Google Cloud Console
const visionClient = new vision.ImageAnnotatorClient();
const [result] = await visionClient.labelDetection(imageBuffer);
```

## Testing Your Integration

1. Open `ai_analysis.php` in your browser
2. Upload test images of different materials
3. Check if predictions are accurate
4. Monitor browser console for errors
5. Test webcam functionality

**Common Issues:**

- **Model not loading:** Check URL is correct and accessible
- **Low accuracy:** Add more training images
- **Slow predictions:** Consider using smaller image size
- **CORS errors:** Ensure model is publicly accessible

## Maintenance and Updates

**When to Retrain:**
- Adding new material types
- Improving accuracy for existing types
- Handling new brands/packaging styles
- Seasonal variations in materials

**How to Update:**
1. Go back to Teachable Machine
2. Load your existing project (if saved)
3. Add new training images
4. Retrain the model
5. Export and update URLs in code

## Performance Optimization

### Image Preprocessing
```javascript
// Resize images before prediction
function preprocessImage(image) {
    const canvas = document.createElement('canvas');
    canvas.width = 224;  // Model input size
    canvas.height = 224;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(image, 0, 0, 224, 224);
    return canvas;
}
```

### Caching Models
```javascript
// Cache loaded model
let cachedModel = null;

async function loadModel() {
    if (cachedModel) return cachedModel;
    cachedModel = await tmImage.load(modelURL, metadataURL);
    return cachedModel;
}
```

## Production Considerations

1. **API Rate Limits:** Teachable Machine free tier has usage limits
2. **Model Hosting:** For high traffic, host model files on your server
3. **Fallback:** Implement manual selection if AI fails
4. **Privacy:** Process images client-side, don't upload to external servers
5. **Mobile:** Test on mobile devices for camera functionality

## Cost Analysis

**Teachable Machine (Free):**
- ✅ Completely free
- ✅ No API limits for hosted models
- ✅ Easy to use
- ❌ Limited customization
- ❌ Basic accuracy

**Google Cloud Vision API (Paid):**
- ✅ Higher accuracy
- ✅ More features
- ❌ Costs $1.50 per 1000 images
- ❌ Requires API key and billing

## Support and Resources

- Teachable Machine Docs: https://teachablemachine.withgoogle.com/faq
- TensorFlow.js Guide: https://www.tensorflow.org/js
- Community Forum: https://github.com/googlecreativelab/teachablemachine-community
- Video Tutorials: Search "Teachable Machine tutorial" on YouTube

## Conclusion

Google Teachable Machine provides an easy, free way to add AI-powered material recognition to your Kabadiwala application. With proper training data, you can achieve 85-95% accuracy in identifying scrap materials.

The AI integration is completely client-side and doesn't interfere with your PHP MySQL backend. It enhances user experience by providing instant material identification and price estimates.
