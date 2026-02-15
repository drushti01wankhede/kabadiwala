<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabadiwala.online - Smart Scrap Recycling Solutions</title>
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
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 254, 247, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            border-bottom: 1px solid rgba(13, 124, 68, 0.1);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-green);
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-gray);
            font-weight: 500;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-links a:hover {
            color: var(--primary-green);
        }

        .btn-login {
            background: transparent;
            color: var(--primary-green);
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            border: 2px solid var(--primary-green);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-login:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 124, 68, 0.2);
        }

        .btn-signup {
            background: var(--primary-green);
            color: white;
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-signup:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 124, 68, 0.3);
        }
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--cream) 0%, var(--sand) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-50px, 50px) rotate(5deg); }
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--dark-green);
            letter-spacing: -0.03em;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content .highlight {
            color: var(--primary-green);
            position: relative;
            display: inline-block;
        }

        .hero-content .highlight::after {
            content: '';
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            height: 15px;
            background: rgba(16, 185, 129, 0.2);
            z-index: -1;
            animation: expand 1s ease-out 0.5s both;
        }

        @keyframes expand {
            from { width: 0; }
            to { width: 100%; }
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--mid-gray);
            margin-bottom: 2.5rem;
            max-width: 550px;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn-primary, .btn-secondary {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary {
            background: var(--primary-green);
            color: white;
        }

        .btn-primary:hover {
            background: var(--dark-green);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(13, 124, 68, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
        }

        .btn-secondary:hover {
            background: var(--light-green);
            transform: translateY(-3px);
        }

        .hero-image {
            position: relative;
            animation: fadeInRight 1s ease-out 0.3s both;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-image-main {
            width: 100%;
            height: 600px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(13, 124, 68, 0.2);
        }

        .hero-image-main::before {
            content: '♻';
            position: absolute;
            font-size: 20rem;
            color: rgba(255, 255, 255, 0.1);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: floatCard 3s ease-in-out infinite;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .card-1 {
            top: 50px;
            left: -50px;
            animation-delay: 0s;
        }

        .card-2 {
            bottom: 50px;
            right: -50px;
            animation-delay: 1s;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: var(--light-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 0.8rem;
        }

        .card-title {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
            color: var(--dark-green);
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-green);
        }

        /* Stats Section */
        .stats {
            padding: 5rem 2rem;
            background: white;
        }

        .stats-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .stats-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--dark-green);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            border-radius: 20px;
            background: var(--light-gray);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            background: var(--light-green);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--mid-gray);
            font-size: 1rem;
        }

        /* Services Section */
        .services {
            padding: 6rem 2rem;
            background: var(--sand);
        }

        .services-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-subtitle {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 3rem;
            color: var(--dark-green);
            margin-bottom: 1rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .service-card {
            background: white;
            border-radius: 25px;
            padding: 3rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--accent-green) 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(13, 124, 68, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--light-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-icon {
            background: var(--primary-green);
            transform: rotate(10deg) scale(1.1);
        }

        .service-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark-green);
        }

        .service-description {
            color: var(--mid-gray);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .service-link {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.3s ease;
        }

        .service-link:hover {
            gap: 1rem;
        }

        /* AI Analysis Section */
        .ai-analysis {
            padding: 6rem 2rem;
            background: var(--dark-green);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .ai-analysis::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.5;
        }

        .ai-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .ai-content h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .ai-content p {
            font-size: 1.15rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.8;
        }

        .ai-features {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .ai-feature {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .ai-feature:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
        }

        .ai-feature-icon {
            width: 50px;
            height: 50px;
            background: var(--accent-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .ai-demo {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 3rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ai-demo-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .ai-demo-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .ai-badge {
            background: var(--accent-green);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .ai-input-group {
            margin-bottom: 2rem;
        }

        .ai-input-label {
            display: block;
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .ai-input {
            width: 100%;
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
        }

        .ai-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .ai-result {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 2rem;
            border: 2px dashed rgba(255, 255, 255, 0.2);
        }

        .ai-result-label {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-bottom: 0.5rem;
        }

        .ai-result-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent-green);
        }

        /* CTA Section */
        .cta {
            padding: 6rem 2rem;
            background: var(--primary-green);
            color: white;
            text-align: center;
        }

        .cta-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .cta p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        .cta-button {
            background: white;
            color: var(--primary-green);
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: var(--dark-gray);
            color: white;
            padding: 4rem 2rem 2rem;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--accent-green);
        }

        .footer-brand p {
            opacity: 0.8;
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--accent-green);
            transform: translateY(-3px);
        }

        .footer-section h4 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: white;
            opacity: 0.8;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            opacity: 1;
            color: var(--accent-green);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
        }

        /* Modal/Popup Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 30px;
            padding: 3rem;
            max-width: 500px;
            width: 90%;
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--light-gray);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--primary-green);
            color: white;
            transform: rotate(90deg);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .modal-title {
            font-size: 2rem;
            color: var(--dark-green);
            margin-bottom: 0.5rem;
        }

        .modal-subtitle {
            color: var(--mid-gray);
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
            border: 2px solid var(--light-gray);
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
            resize: vertical;
            min-height: 100px;
        }

        .form-button {
            width: 100%;
            padding: 1.2rem;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        .form-button:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 124, 68, 0.3);
        }

        .form-divider {
            text-align: center;
            margin: 1.5rem 0;
            color: var(--mid-gray);
            position: relative;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: var(--light-gray);
        }

        .form-divider::before { left: 0; }
        .form-divider::after { right: 0; }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-btn {
            flex: 1;
            padding: 0.9rem;
            border: 2px solid var(--light-gray);
            background: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
        }

        .social-btn:hover {
            border-color: var(--primary-green);
            background: var(--light-green);
        }

        .toggle-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--mid-gray);
        }

        .toggle-link a {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
        }

        .toggle-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-container, .ai-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .hero-content h1 {
                font-size: 3.5rem;
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 1rem;
            }

            .logo {
                font-size: 1.4rem;
            }

            .nav-links {
                display: none;
            }

            .hero {
                margin-top: 60px;
                min-height: auto;
                padding: 3rem 0;
            }

            .hero-container {
                padding: 2rem 1rem;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                padding: 1rem 1.5rem;
            }

            .hero-image-main {
                height: 400px;
            }

            .services-grid, .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stats {
                padding: 3rem 1rem;
            }

            .stats-title {
                font-size: 1.8rem;
            }

            .services {
                padding: 3rem 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .service-card {
                padding: 2rem;
            }

            .ai-analysis {
                padding: 3rem 1rem;
            }

            .ai-container {
                gap: 2rem;
            }

            .ai-content h2 {
                font-size: 1.8rem;
            }

            .ai-content p {
                font-size: 1rem;
            }

            .ai-demo {
                padding: 2rem;
            }

            .cta {
                padding: 3rem 1rem;
            }

            .cta h2 {
                font-size: 1.8rem;
            }

            .cta p {
                font-size: 1rem;
            }

            .floating-card {
                display: none;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .modal-content {
                padding: 2rem;
                margin: 1rem;
            }

            .modal-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .service-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .service-title {
                font-size: 1.2rem;
            }

            .ai-result-value {
                font-size: 2rem;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--primary-green);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 70px;
                right: -100%;
                background: var(--cream);
                width: 100%;
                max-width: 300px;
                height: calc(100vh - 70px);
                flex-direction: column;
                padding: 2rem;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
                transition: right 0.3s ease;
                gap: 1.5rem;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links li {
                width: 100%;
            }

            .nav-links a, .btn-login {
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="#" class="logo">kabadiwala.online</a>
            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#services" onclick="closeMobileMenu()">Services</a></li>
                <li><a href="#ai-analysis" onclick="closeMobileMenu()">AI Analysis</a></li>
                <li><a href="#about" onclick="closeMobileMenu()">About</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="dashboard.php" style="font-weight: 600; color: var(--primary-green);">Dashboard</a></li>
                    <li><a href="logout.php" class="btn-login" style="text-decoration: none;">Logout</a></li>
                <?php else: ?>
                    <li><button class="btn-login" onclick="openLoginModal(); closeMobileMenu();">Login</button></li>
                    <li><button class="btn-signup" onclick="openSignupModal(); closeMobileMenu();">Sign Up</button></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <?php if (isset($_SESSION['success'])): ?>
                <div style="background: #D1FAE5; color: #065F46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border: 2px solid #10B981; font-weight: 500;">
                    ✓ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div style="background: #FEE2E2; color: #991B1B; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border: 2px solid #EF4444; font-weight: 500;">
                    ✗ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <div class="hero-content">
                <h1>Smart <span class="highlight">Scrap Recycling</span> Solutions</h1>
                <p>Transform your waste into value with AI-powered scrap collection and instant price estimation. We make recycling easy, profitable, and sustainable.</p>
                <div class="hero-buttons">
                    <a href="request_pickup.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Request Pickup</a>
                    <a href="sell_scrap.php" class="btn-secondary" style="text-decoration: none; display: inline-block;">Sell Scrap Now</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-image-main"></div>
                <div class="floating-card card-1">
                    <div class="card-icon">📦</div>
                    <div class="card-title">Active Pickups</div>
                    <div class="card-value">2,450+</div>
                </div>
                <div class="floating-card card-2">
                    <div class="card-icon">💰</div>
                    <div class="card-title">Money Earned</div>
                    <div class="card-value">₹8.5M</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <h2 class="stats-title">Making a Real Impact</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">♻️</div>
                    <div class="stat-number">18.4M+</div>
                    <div class="stat-label">Kg Recycled</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">🏆</div>
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Cities Covered</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">👥</div>
                    <div class="stat-number">9.1M+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">🌍</div>
                    <div class="stat-number">6.4M+</div>
                    <div class="stat-label">CO₂ Saved (kg)</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="services-container">
            <div class="section-header">
                <div class="section-subtitle">Our Services</div>
                <h2 class="section-title">How We Help You Recycle</h2>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🚚</div>
                    <h3 class="service-title">Doorstep Pickup</h3>
                    <p class="service-description">Schedule a convenient pickup time and we'll collect your scrap from your doorstep. Fast, reliable, and hassle-free service.</p>
                    <a href="request_pickup.php" class="service-link">Request Pickup →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">🤖</div>
                    <h3 class="service-title">AI Price Estimation</h3>
                    <p class="service-description">Get instant, accurate price estimates using our advanced AI technology. Know the value of your scrap before you sell.</p>
                    <a href="ai_analysis.php" class="service-link">Try AI Analysis →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">💸</div>
                    <h3 class="service-title">Instant Payment</h3>
                    <p class="service-description">Receive immediate payment after collection. Choose from multiple payment options including UPI, bank transfer, or cash.</p>
                    <a href="sell_scrap.php" class="service-link">Sell Now →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Analysis Section -->
    <section id="ai-analysis" class="ai-analysis">
        <div class="ai-container">
            <div class="ai-content">
                <h2>AI-Powered Scrap Valuation</h2>
                <p>Our cutting-edge artificial intelligence analyzes your scrap materials and provides instant, accurate price estimates based on current market rates, material quality, and quantity.</p>
                <div class="ai-features">
                    <div class="ai-feature">
                        <div class="ai-feature-icon">📸</div>
                        <div>
                            <strong>Image Recognition</strong>
                            <p style="margin: 0; opacity: 0.8; font-size: 0.9rem;">Upload photos for automatic material identification</p>
                        </div>
                    </div>
                    <div class="ai-feature">
                        <div class="ai-feature-icon">⚡</div>
                        <div>
                            <strong>Real-Time Pricing</strong>
                            <p style="margin: 0; opacity: 0.8; font-size: 0.9rem;">Get prices updated with current market rates</p>
                        </div>
                    </div>
                    <div class="ai-feature">
                        <div class="ai-feature-icon">🎯</div>
                        <div>
                            <strong>Accuracy Guaranteed</strong>
                            <p style="margin: 0; opacity: 0.8; font-size: 0.9rem;">95%+ accuracy with machine learning models</p>
                        </div>
                    </div>
                </div>
                <a href="ai_analysis.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Try AI Estimator</a>
            </div>
            <div class="ai-demo">
                <div class="ai-demo-header">
                    <div class="ai-demo-title">Quick Estimate</div>
                    <div class="ai-badge">AI-Powered</div>
                </div>
                <div class="ai-input-group">
                    <label class="ai-input-label">Select Material Type</label>
                    <select class="ai-input" id="demoMaterial" onchange="updateDemoPrice()">
                        <option value="">Choose material...</option>
                        <option value="paper">Paper & Cardboard</option>
                        <option value="plastic">Plastic</option>
                        <option value="metal">Metal</option>
                        <option value="electronics">Electronics</option>
                    </select>
                </div>
                <div class="ai-input-group">
                    <label class="ai-input-label">Estimated Weight (kg)</label>
                    <input type="number" class="ai-input" id="demoWeight" placeholder="Enter weight" oninput="updateDemoPrice()">
                </div>
                <div class="ai-result">
                    <div class="ai-result-label">Estimated Value</div>
                    <div class="ai-result-value" id="demoPrice">₹0</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Start Recycling?</h2>
            <p>Join thousands of happy customers who are making money while saving the planet. Get started in minutes!</p>
            <button class="cta-button" onclick="openLoginModal()">Get Started Today</button>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <h3>kabadiwala.online</h3>
                <p>Making recycling easy, profitable, and sustainable for everyone. Join us in creating a greener future.</p>
                <div class="social-links">
                    <a href="#" class="social-link">📘</a>
                    <a href="#" class="social-link">🐦</a>
                    <a href="#" class="social-link">📷</a>
                    <a href="#" class="social-link">💼</a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Services</h4>
                <ul class="footer-links">
                    <li><a href="#">Scrap Pickup</a></li>
                    <li><a href="#">AI Estimation</a></li>
                    <li><a href="#">Bulk Collection</a></li>
                    <li><a href="#">Corporate Solutions</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 kabadiwala.online. All rights reserved.</p>
        </div>
    </footer>

    <!-- Login/Signup Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('loginModal')">×</button>
            <div class="modal-header">
                <h2 class="modal-title">Welcome Back!</h2>
                <p class="modal-subtitle">Login to access your account</p>
            </div>
            <form id="loginForm" method="POST" action="login_handler.php">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="form-button">Login</button>
            </form>
            <div class="form-divider">OR</div>
            <div class="social-login">
                <button class="social-btn">📱 Phone</button>
                <button class="social-btn">🔍 Google</button>
            </div>
            <div class="toggle-link">
                Don't have an account? <a href="#" onclick="switchToSignup(); return false;">Sign up</a>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('signupModal')">×</button>
            <div class="modal-header">
                <h2 class="modal-title">Create Account</h2>
                <p class="modal-subtitle">Start recycling and earning today</p>
            </div>
            <form id="signupForm" method="POST" action="signup_handler.php">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-input" placeholder="Enter 10 digit phone number" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Create a password (min 6 characters)" minlength="6" required>
                </div>
                <input type="hidden" name="user_type" value="customer">
                <button type="submit" class="form-button">Create Account</button>
            </form>
            <div class="toggle-link">
                Already have an account? <a href="#" onclick="switchToLogin(); return false;">Login</a>
            </div>
        </div>
    </div>

    <!-- Pickup Request Modal -->
    <div id="pickupModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('pickupModal')">×</button>
            <div class="modal-header">
                <h2 class="modal-title">Schedule Pickup</h2>
                <p class="modal-subtitle">We'll collect your scrap from your doorstep</p>
            </div>
            <form id="pickupForm" method="POST" action="pickup_handler.php">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-input" placeholder="Enter 10 digit phone" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pickup Address</label>
                    <textarea name="address" class="form-textarea" placeholder="Enter your complete address" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Pincode</label>
                    <input type="text" name="pincode" class="form-input" placeholder="Enter pincode" pattern="[0-9]{6}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Material Type</label>
                    <select name="material_type" class="form-select" required>
                        <option value="">Select material type</option>
                        <option value="paper">Paper & Cardboard</option>
                        <option value="plastic">Plastic</option>
                        <option value="metal">Metal (Aluminum, Steel, Copper)</option>
                        <option value="electronics">Electronics</option>
                        <option value="glass">Glass</option>
                        <option value="mixed">Mixed Materials</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Weight (kg)</label>
                    <input type="number" name="estimated_weight" class="form-input" placeholder="Approximate weight" step="0.1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Preferred Date</label>
                    <input type="date" name="pickup_date" class="form-input" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Preferred Time</label>
                    <select name="pickup_time" class="form-select" required>
                        <option value="">Select time slot</option>
                        <option value="morning">Morning (8 AM - 12 PM)</option>
                        <option value="afternoon">Afternoon (12 PM - 4 PM)</option>
                        <option value="evening">Evening (4 PM - 8 PM)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Additional Notes (Optional)</label>
                    <textarea name="notes" class="form-textarea" placeholder="Any special instructions or details"></textarea>
                </div>
                <button type="submit" class="form-button">Schedule Pickup</button>
            </form>
        </div>
    </div>

    <!-- Sell Scrap Modal -->
    <div id="sellModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('sellModal')">×</button>
            <div class="modal-header">
                <h2 class="modal-title">Sell Your Scrap</h2>
                <p class="modal-subtitle">Get instant quotes for your materials</p>
            </div>
            <form id="sellForm" method="POST" action="sell_handler.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Material Category</label>
                    <select name="material_category" class="form-select" id="sellMaterial" onchange="updateSellPrice()" required>
                        <option value="">Select category</option>
                        <option value="paper">Paper & Cardboard (₹8-12/kg)</option>
                        <option value="plastic">Plastic (₹15-25/kg)</option>
                        <option value="metal">Metal (₹30-150/kg)</option>
                        <option value="electronics">Electronics (₹50-200/kg)</option>
                        <option value="glass">Glass (₹2-5/kg)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" class="form-input" id="sellWeight" placeholder="Enter weight in kg" step="0.1" oninput="updateSellPrice()" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Condition</label>
                    <select name="condition_type" class="form-select" required>
                        <option value="">Select condition</option>
                        <option value="excellent">Excellent - Clean and sorted</option>
                        <option value="good">Good - Mostly clean</option>
                        <option value="average">Average - Mixed condition</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload Photos (Optional)</label>
                    <input type="file" name="photos[]" class="form-input" accept="image/*" multiple>
                    <p style="font-size: 0.85rem; color: var(--mid-gray); margin-top: 0.5rem;">For better AI estimation, upload clear photos</p>
                </div>
                <div style="background: var(--light-green); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem;">
                    <div style="font-size: 0.9rem; color: var(--mid-gray); margin-bottom: 0.5rem;">Estimated Value</div>
                    <div style="font-size: 2rem; font-weight: 800; color: var(--primary-green);" id="sellPrice">₹0</div>
                    <div style="font-size: 0.85rem; color: var(--mid-gray); margin-top: 0.5rem;">Final price may vary based on actual inspection</div>
                </div>
                <button type="submit" class="form-button">Confirm & Sell</button>
            </form>
        </div>
    </div>

    <!-- AI Analysis Modal -->
    <div id="aiModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <button class="modal-close" onclick="closeModal('aiModal')">×</button>
            <div class="modal-header">
                <h2 class="modal-title">AI Scrap Analyzer</h2>
                <p class="modal-subtitle">Upload images for instant AI-powered valuation</p>
            </div>
            <form id="aiForm">
                <div class="form-group">
                    <label class="form-label">Upload Scrap Photos</label>
                    <input type="file" class="form-input" accept="image/*" multiple required>
                    <p style="font-size: 0.85rem; color: var(--mid-gray); margin-top: 0.5rem;">Upload up to 5 clear photos of your scrap materials</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Weight (Optional)</label>
                    <input type="number" class="form-input" placeholder="Weight in kg (helps improve accuracy)">
                </div>
                <div style="background: var(--sand); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem;">
                        <div style="width: 40px; height: 40px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🤖</div>
                        <div>
                            <strong>How AI Analysis Works</strong>
                        </div>
                    </div>
                    <ul style="list-style: none; padding: 0; font-size: 0.9rem; color: var(--mid-gray);">
                        <li style="margin-bottom: 0.5rem;">✓ Identifies material types automatically</li>
                        <li style="margin-bottom: 0.5rem;">✓ Estimates quality and condition</li>
                        <li style="margin-bottom: 0.5rem;">✓ Calculates market-based pricing</li>
                        <li>✓ Provides instant detailed report</li>
                    </ul>
                </div>
                <button type="submit" class="form-button">Analyze with AI</button>
            </form>
        </div>
    </div>

    <script>
        // Mobile Menu Functions
        function toggleMobileMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        function closeMobileMenu() {
            document.getElementById('navLinks').classList.remove('active');
        }

        // Modal Functions
        function openLoginModal() {
            document.getElementById('loginModal').classList.add('active');
        }

        function openSignupModal() {
            document.getElementById('signupModal').classList.add('active');
        }

        function openPickupModal() {
            document.getElementById('pickupModal').classList.add('active');
        }

        function openSellModal() {
            document.getElementById('sellModal').classList.add('active');
        }

        function openAIModal() {
            document.getElementById('aiModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function switchToSignup() {
            closeModal('loginModal');
            openSignupModal();
        }

        function switchToLogin() {
            closeModal('signupModal');
            openLoginModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Demo AI Price Calculator
        const prices = {
            paper: 10,
            plastic: 20,
            metal: 80,
            electronics: 120
        };

        function updateDemoPrice() {
            const material = document.getElementById('demoMaterial').value;
            const weight = parseFloat(document.getElementById('demoWeight').value) || 0;
            const price = prices[material] || 0;
            const total = (price * weight).toFixed(0);
            document.getElementById('demoPrice').textContent = `₹${total}`;
        }

        // Sell Modal Price Calculator
        function updateSellPrice() {
            const material = document.getElementById('sellMaterial').value;
            const weight = parseFloat(document.getElementById('sellWeight').value) || 0;
            const price = prices[material] || 0;
            const total = (price * weight).toFixed(0);
            document.getElementById('sellPrice').textContent = `₹${total}`;
        }

        // Note: Form submissions are now handled by PHP backend
        // The forms will submit to their respective handler files

        document.getElementById('aiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('AI Analysis feature coming soon!');
            closeModal('aiModal');
        });


        // Smooth Scroll Function
        function scrollToAI() {
            document.getElementById('ai-analysis').scrollIntoView({ behavior: 'smooth' });
        }

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-item, .service-card, .ai-feature').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>

    <?php include 'chatbot_widget.php'; ?>
</body>
</html>
