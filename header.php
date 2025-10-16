<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeakHunter - Cybersecurity Intelligence Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber-dark': '#0a0a0a',
                        'cyber-gray': '#1a1a1a',
                        'cyber-green': '#00ff41',
                        'cyber-blue': '#0080ff',
                        'cyber-purple': '#8000ff',
                        'cyber-orange': '#ff8000',
                        'cyber-yellow': '#ffff00',
                        'cyber-pink': '#ff0080',
                        'cyber-teal': '#00ffcc',
                        'cyber-indigo': '#4b0082'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Share+Tech+Mono&display=swap');

        :root {
            --cyber-green: #00ff41;
            --cyber-blue: #0080ff;
            --cyber-purple: #8000ff;
            --cyber-pink: #ff0080;
            --cyber-teal: #00ffcc;
            --cyber-orange: #ff8000;
            --cyber-dark: #0a0a0a;
            --cyber-gray: #1a1a1a;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Share Tech Mono', monospace;
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 100%);
            color: #e0e0e0;
            min-height: 100vh;
        }

        .cyber-font { font-family: 'Orbitron', sans-serif; letter-spacing: 1px; }
        .tech-font { font-family: 'Share Tech Mono', monospace; }

        /* Enhanced Navigation */
        .cyber-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(10,10,15,0.95);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,255,65,0.3);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .cyber-nav.scrolled { 
            background: rgba(10,10,15,0.98); 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5); 
            border-bottom: 1px solid rgba(0,255,65,0.5);
        }

        /* Enhanced Logo */
        .logo-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            padding: 2px;
            background: linear-gradient(45deg, var(--cyber-green), var(--cyber-blue), var(--cyber-purple), var(--cyber-pink));
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        .logo-inner {
            background: var(--cyber-dark);
            border-radius: 10px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Enhanced Desktop Menu */
        .desktop-menu a { 
            position: relative;
            color: var(--cyber-green); 
            transition: color 0.3s; 
            padding: 8px 12px;
            border-radius: 6px;
            overflow: hidden;
        }
        .desktop-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0,255,65,0.1), transparent);
            transition: left 0.5s;
        }
        .desktop-menu a:hover::before {
            left: 100%;
        }
        .desktop-menu a:hover { 
            color: var(--cyber-teal); 
            background: rgba(0,255,65,0.05);
        }

        /* Enhanced Buttons */
        .btn-primary {
            background: linear-gradient(45deg, var(--cyber-green), var(--cyber-blue));
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--cyber-blue), var(--cyber-purple));
            transition: left 0.5s;
            z-index: -1;
        }
        .btn-primary:hover::before {
            left: 0;
        }
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(0,255,65,0.4);
        }

        .btn-secondary {
            border: 2px solid var(--cyber-green);
            color: var(--cyber-green);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
        }
        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(0,255,65,0.1);
            transition: left 0.5s;
            z-index: -1;
        }
        .btn-secondary:hover::before {
            left: 0;
        }
        .btn-secondary:hover { 
            color: var(--cyber-teal); 
            border-color: var(--cyber-teal);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,255,65,0.2);
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(45deg, var(--cyber-green), var(--cyber-blue));
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 50;
            box-shadow: 0 4px 10px rgba(0,255,65,0.3);
        }
        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,255,65,0.5);
        }
        .back-to-top.visible { opacity: 1; visibility: visible; }

        /* Mobile Menu */
        #mobile-menu-button {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,255,65,0.1);
            border-radius: 8px;
            border: 1px solid rgba(0,255,65,0.3);
            transition: all 0.3s ease;
        }
        #mobile-menu-button:hover {
            background: rgba(0,255,65,0.2);
            border-color: var(--cyber-green);
        }
        
        #mobile-menu-button i {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }
        
        #mobile-menu-button i.fa-bars {
            transform: rotate(0deg);
            opacity: 1;
        }
        
        #mobile-menu-button i.fa-xmark {
            transform: rotate(-180deg);
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -0.5em;
            margin-top: -0.5em;
            opacity: 0;
        }
        
        #mobile-menu-button[aria-expanded="true"] i.fa-bars {
            transform: rotate(90deg);
            opacity: 0;
        }
        
        #mobile-menu-button[aria-expanded="true"] i.fa-xmark {
            transform: rotate(0deg);
            opacity: 1;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: rgba(15, 15, 25, 0.98);
            backdrop-filter: blur(15px);
            padding: 2rem;
            padding-top: 5rem;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1100;
            overflow-y: auto;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.5);
            border-left: 1px solid rgba(0,255,65,0.2);
        }
        .mobile-menu.open { 
            right: 0;
            display: block;
        }

        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(3px);
        }
        .mobile-overlay.visible { opacity: 1; visibility: visible; }

        /* Terminal Preloader */
        #terminal-preloader {
            position: fixed;
            inset: 0;
            background: var(--cyber-dark);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        #terminal-preloader::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(to bottom, rgba(0,255,65,0.05) 1px, transparent 1px),
                linear-gradient(to right, rgba(0,255,65,0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: matrix 2s linear infinite;
            pointer-events: none;
        }
        @keyframes matrix {
            0% { background-position: 0 0; }
            100% { background-position: 20px 20px; }
        }
        #loading-text { 
            color: var(--cyber-green); 
            font-family: 'Orbitron', monospace; 
            font-size: 1.5rem; 
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(0,255,65,0.5);
        }
        #progress-bar { 
            width: 0%; 
            height: 10px; 
            background: linear-gradient(90deg, var(--cyber-green), var(--cyber-blue));
            border-radius: 5px; 
            transition: width 0.4s ease;
            box-shadow: 0 0 10px rgba(0,255,65,0.5);
        }
        #percentage { 
            color: var(--cyber-green); 
            font-size: 1rem; 
            margin-top: 0.5rem;
            font-family: 'Orbitron', monospace;
        }
    </style>
</head>
<body class="min-h-screen tech-font">

    <!-- Terminal Preloader -->
    <div id="terminal-preloader">
        <div class="w-4/5 max-w-xl text-center z-10">
            <div id="loading-text">Initializing hack...</div>
            <div class="w-full bg-gray-800 rounded-full h-3 overflow-hidden">
                <div id="progress-bar"></div>
            </div>
            <div id="percentage">0%</div>
        </div>
    </div>

    <!-- Back to Top -->
    <div id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Enhanced Navigation -->
    <nav class="cyber-nav" id="mainNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Enhanced Logo -->
                <a href="home.php" class="logo-container">
                    <div class="logo-inner">
                        <div class="w-8 h-8 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                        <span class="cyber-font text-cyber-green text-xl font-bold">LEAKHUNTER</span>
                    </div>
                </a>

                <!-- Enhanced Desktop Menu -->
                <div class="hidden md:flex items-center space-x-2 desktop-menu">
                    <a href="home.php" class="flex items-center gap-1">
                        <i class="fas fa-home text-xs"></i>
                        <span>HOME</span>
                    </a>
                    <a href="services.php" class="flex items-center gap-1">
                        <i class="fas fa-cogs text-xs"></i>
                        <span>SERVICES</span>
                    </a>
                    <a href="about.php" class="flex items-center gap-1">
                        <i class="fas fa-info-circle text-xs"></i>
                        <span>ABOUT</span>
                    </a>
                    <a href="contact.php" class="flex items-center gap-1">
                        <i class="fas fa-envelope text-xs"></i>
                        <span>CONTACT</span>
                    </a>
                    <a href="documentation.php" class="flex items-center gap-1">
                        <i class="fas fa-book text-xs"></i>
                        <span>DOCS</span>
                    </a>
                    <a href="faq.php" class="flex items-center gap-1">
                        <i class="fas fa-question-circle text-xs"></i>
                        <span>FAQ</span>
                    </a>
                    <div class="flex items-center space-x-3 ml-4 pl-4 border-l border-cyber-green/30">
                        <a href="login.php" class="btn-secondary">LOGIN</a>
                        <a href="register.php" class="btn-primary">REGISTER</a>
                    </div>
                </div>

                <!-- Enhanced Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-cyber-green focus:outline-none" aria-expanded="false" aria-controls="mobile-menu">
                        <i class="fas fa-bars text-lg"></i>
                        <i class="fas fa-xmark text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Enhanced Mobile Menu & Overlay -->
    <div id="mobile-menu" class="mobile-menu" style="display: none;">
        <div class="flex flex-col space-y-4">
            <a href="home.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-home w-5 text-center"></i>
                <span>HOME</span>
            </a>
            <a href="services.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-cogs w-5 text-center"></i>
                <span>SERVICES</span>
            </a>
            <a href="about.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-info-circle w-5 text-center"></i>
                <span>ABOUT</span>
            </a>
            <a href="contact.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-envelope w-5 text-center"></i>
                <span>CONTACT</span>
            </a>
            <a href="documentation.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-book w-5 text-center"></i>
                <span>DOCS</span>
            </a>
            <a href="faq.php" class="flex items-center gap-3 py-3 px-4 text-cyber-green hover:text-cyber-blue hover:bg-cyber-gray/50 rounded-lg transition-all duration-200">
                <i class="fas fa-question-circle w-5 text-center"></i>
                <span>FAQ</span>
            </a>
            <div class="mt-6 pt-6 border-t border-cyber-green/30">
                <a href="login.php" class="block py-3 px-4 text-center btn-secondary rounded-lg mb-3">LOGIN</a>
                <a href="register.php" class="block py-3 px-4 text-center btn-primary rounded-lg">REGISTER</a>
            </div>
        </div>
    </div>
    <div id="mobile-overlay-header" class="mobile-overlay"></div>

    <!-- Padding to avoid content hidden under nav -->
    <div class="pt-20">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-overlay-header');
    const backToTop = document.getElementById('backToTop');
    const nav = document.getElementById('mainNav');

    // Scroll effects
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            backToTop.classList.add('visible');
            nav.classList.add('scrolled');
        } else {
            backToTop.classList.remove('visible');
            nav.classList.remove('scrolled');
        }
    });

    // Back to top click
    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Mobile menu toggle
    function toggleMenu() {
        const isOpen = mobileButton.getAttribute('aria-expanded') === 'true';
        mobileButton.setAttribute('aria-expanded', !isOpen);
        
        if (!isOpen) {
            // Opening the menu
            mobileMenu.style.display = 'block';
            overlay.classList.add('visible');
            setTimeout(() => {
                mobileMenu.classList.add('open');
            }, 10);
            document.body.style.overflow = 'hidden';
        } else {
            // Closing the menu
            mobileMenu.classList.remove('open');
            overlay.classList.remove('visible');
            setTimeout(() => {
                if (!mobileMenu.classList.contains('open')) {
                    mobileMenu.style.display = 'none';
                }
            }, 300);
            document.body.style.overflow = '';
        }
    }
    
    // Add click event to menu button
    if (mobileButton) {
        mobileButton.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMenu();
        });
    }
    
    // Close menu when clicking on overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            toggleMenu();
        });
    }

    // Close menu on resize
    window.addEventListener('resize', () => {
        if(window.innerWidth >= 768){
            mobileMenu.classList.remove('open');
            overlay.classList.remove('visible');
            mobileMenu.style.display = 'none';
            document.body.style.overflow = '';
            mobileButton.setAttribute('aria-expanded', 'false');
        }
    });
});

// Terminal Preloader
window.addEventListener('load', function() {
    const stages = [
        { text: "Initializing hack...", percent: 0 },
        { text: "Bypassing firewalls...", percent: 25 },
        { text: "Transferring data...", percent: 50 },
        { text: "Decrypting files...", percent: 75 },
        { text: "Access granted.", percent: 100 }
    ];

    const loadingText = document.getElementById('loading-text');
    const progressBar = document.getElementById('progress-bar');
    const percentage = document.getElementById('percentage');
    const preloader = document.getElementById('terminal-preloader');

    let stage = 0;
    function nextStage() {
        if(stage < stages.length) {
            loadingText.textContent = stages[stage].text;
            progressBar.style.width = stages[stage].percent + '%';
            percentage.textContent = stages[stage].percent + '%';
            stage++;
            setTimeout(nextStage, 400);
        } else {
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 300);
        }
    }
    nextStage();
});
</script>