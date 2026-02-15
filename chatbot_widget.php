<!-- AI Chatbot Widget -->
<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    #chat-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0D7C44 0%, #10B981 100%);
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(13, 124, 68, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        transition: all 0.3s ease;
        position: relative;
    }

    #chat-button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 30px rgba(13, 124, 68, 0.6);
    }

    #chat-button .pulse {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(16, 185, 129, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    #chat-window {
        display: none;
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 380px;
        height: 550px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        flex-direction: column;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #chat-header {
        background: linear-gradient(135deg, #0D7C44 0%, #10B981 100%);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #chat-header h3 {
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    #close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    #close-chat:hover {
        opacity: 1;
    }

    #chat-messages {
        flex: 1;
        padding: 1.5rem;
        overflow-y: auto;
        background: #f8f9fa;
    }

    .message {
        margin-bottom: 1rem;
        display: flex;
        gap: 0.5rem;
    }

    .message.bot {
        justify-content: flex-start;
    }

    .message.user {
        justify-content: flex-end;
    }

    .message-content {
        max-width: 75%;
        padding: 0.8rem 1rem;
        border-radius: 15px;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .message.bot .message-content {
        background: white;
        color: #1F2937;
        border: 1px solid #e5e7eb;
    }

    .message.user .message-content {
        background: #0D7C44;
        color: white;
    }

    .quick-actions {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background: white;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .quick-action-btn {
        padding: 0.6rem;
        background: #f8f9fa;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.3s;
        text-align: center;
    }

    .quick-action-btn:hover {
        background: #D1FAE5;
        border-color: #10B981;
        color: #0D7C44;
    }

    #chat-input-container {
        display: flex;
        gap: 0.5rem;
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background: white;
    }

    #chat-input {
        flex: 1;
        padding: 0.8rem;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif;
        outline: none;
    }

    #chat-input:focus {
        border-color: #0D7C44;
    }

    #send-button {
        background: #0D7C44;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    #send-button:hover {
        background: #064929;
        transform: scale(1.05);
    }

    .typing-indicator {
        display: none;
        padding: 0.8rem 1rem;
        background: white;
        border-radius: 15px;
        width: fit-content;
        border: 1px solid #e5e7eb;
    }

    .typing-indicator span {
        height: 8px;
        width: 8px;
        background: #6B7280;
        border-radius: 50%;
        display: inline-block;
        margin-right: 3px;
        animation: bounce 1.4s infinite ease-in-out both;
    }

    .typing-indicator span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes bounce {
        0%, 80%, 100% {
            transform: scale(0);
        }
        40% {
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        #chat-window {
            width: calc(100vw - 40px);
            height: calc(100vh - 150px);
            right: 20px;
        }
    }
</style>

<div id="chatbot-container">
    <button id="chat-button" onclick="toggleChat()">
        <span class="pulse"></span>
        <span>💬</span>
    </button>

    <div id="chat-window">
        <div id="chat-header">
            <h3>🤖 Kabadiwala Assistant</h3>
            <button id="close-chat" onclick="toggleChat()">×</button>
        </div>

        <div id="chat-messages">
            <div class="message bot">
                <div class="message-content">
                    Hi! I'm your Kabadiwala assistant. How can I help you today? 😊
                </div>
            </div>
            <div class="typing-indicator" id="typing-indicator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="quick-actions">
            <div class="quick-actions-grid">
                <button class="quick-action-btn" onclick="sendQuickMessage('Check prices')">💰 Check Prices</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('Schedule pickup')">📅 Schedule Pickup</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('How it works')">❓ How It Works</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('Contact support')">📞 Contact</button>
            </div>
        </div>

        <div id="chat-input-container">
            <input type="text" id="chat-input" placeholder="Type your message..." onkeypress="handleKeyPress(event)">
            <button id="send-button" onclick="sendMessage()">
                <span>➤</span>
            </button>
        </div>
    </div>
</div>

<script>
    let isChatOpen = false;

    function toggleChat() {
        const chatWindow = document.getElementById('chat-window');
        isChatOpen = !isChatOpen;
        chatWindow.style.display = isChatOpen ? 'flex' : 'none';
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        
        if (message === '') return;
        
        addUserMessage(message);
        input.value = '';
        
        // Show typing indicator
        showTypingIndicator();
        
        // Simulate bot response
        setTimeout(() => {
            hideTypingIndicator();
            const response = getBotResponse(message);
            addBotMessage(response);
        }, 1000 + Math.random() * 1000);
    }

    function sendQuickMessage(message) {
        addUserMessage(message);
        showTypingIndicator();
        
        setTimeout(() => {
            hideTypingIndicator();
            const response = getBotResponse(message);
            addBotMessage(response);
        }, 800);
    }

    function addUserMessage(text) {
        const messagesContainer = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user';
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        messagesContainer.insertBefore(messageDiv, document.getElementById('typing-indicator'));
        scrollToBottom();
    }

    function addBotMessage(text) {
        const messagesContainer = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message bot';
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        messagesContainer.insertBefore(messageDiv, document.getElementById('typing-indicator'));
        scrollToBottom();
    }

    function showTypingIndicator() {
        document.getElementById('typing-indicator').style.display = 'block';
        scrollToBottom();
    }

    function hideTypingIndicator() {
        document.getElementById('typing-indicator').style.display = 'none';
    }

    function scrollToBottom() {
        const messagesContainer = document.getElementById('chat-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function getBotResponse(message) {
        const lowerMessage = message.toLowerCase();
        
        // Price inquiries
        if (lowerMessage.includes('price') || lowerMessage.includes('rate')) {
            return 'Our current rates are:<br><br>📄 Paper: ₹8-12/kg<br>🔷 Plastic: ₹15-25/kg<br>🔩 Metal: ₹30-150/kg<br>💻 Electronics: ₹50-200/kg<br>🥤 Glass: ₹2-5/kg<br><br>Would you like to get an exact quote?';
        }
        
        // Pickup scheduling
        if (lowerMessage.includes('pickup') || lowerMessage.includes('schedule')) {
            return 'Great! You can schedule a pickup in 3 easy steps:<br><br>1. Click on "Request Pickup" button<br>2. Fill in your details and preferred time<br>3. We\'ll confirm within 2 hours!<br><br>Would you like me to take you there?';
        }
        
        // How it works
        if (lowerMessage.includes('how') || lowerMessage.includes('work')) {
            return 'Here\'s how Kabadiwala works:<br><br>1. 📞 Schedule a pickup or bring scrap to us<br>2. 🤖 AI analyzes your materials<br>3. 💰 Get instant price quote<br>4. ✅ Accept and get paid immediately<br><br>It\'s that simple! Want to get started?';
        }
        
        // Contact/Support
        if (lowerMessage.includes('contact') || lowerMessage.includes('support') || lowerMessage.includes('help')) {
            return 'I\'m here to help! 😊<br><br>📧 Email: support@kabadiwala.online<br>📱 Phone: +91 9876543210<br>⏰ Working Hours: 8 AM - 8 PM<br><br>Or you can ask me anything right here!';
        }
        
        // AI Analysis
        if (lowerMessage.includes('ai') || lowerMessage.includes('analysis') || lowerMessage.includes('identify')) {
            return 'Our AI can identify your scrap materials instantly! 🤖<br><br>Just upload a photo or use your camera, and our AI will:<br>• Identify material type<br>• Assess quality<br>• Provide price estimate<br><br>Try it now in the AI Analysis section!';
        }
        
        // Account/Login
        if (lowerMessage.includes('account') || lowerMessage.includes('login') || lowerMessage.includes('signup')) {
            return 'To access all features, you can:<br><br>✨ Sign up for a free account<br>🔑 Login to your existing account<br>📊 Track your pickups and earnings<br><br>Would you like to create an account?';
        }
        
        // General greeting
        if (lowerMessage.includes('hi') || lowerMessage.includes('hello') || lowerMessage.includes('hey')) {
            return 'Hello! 👋 Welcome to Kabadiwala.online! I\'m here to help you recycle and earn. What would you like to know about?';
        }
        
        // Default response
        return 'I\'m here to help! You can ask me about:<br><br>💰 Material prices<br>📅 Scheduling pickups<br>🤖 AI analysis<br>❓ How our service works<br>📞 Contact information<br><br>What interests you?';
    }

    // Initialize chat on page load
    window.addEventListener('load', function() {
        // You can add any initialization code here
        console.log('Kabadiwala AI Chatbot loaded');
    });
</script>
