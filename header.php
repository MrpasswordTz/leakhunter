<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'LeakHunter - Cybersecurity Intelligence Platform'; ?></title>
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
                        'cyber-yellow': '#ffff00'
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
            --cyber-dark: #0a0a0a;
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

        /* Navigation */
        .cyber-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,255,65,0.2);
            transition: all 0.3s ease;
        }
        .cyber-nav.scrolled { background: rgba(10,10,15,0.95); box-shadow: 0 4px 20px rgba(0,0,0,0.5); }

        .desktop-menu a { color: var(--cyber-green); transition: color 0.3s; }
        .desktop-menu a:hover { color: var(--cyber-blue); }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(45deg, var(--cyber-green), var(--cyber-blue));
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }
        .btn-primary:hover { transform: translateY(-2px); }

        .btn-secondary {
            border: 2px solid var(--cyber-green);
            color: var(--cyber-green);
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            transition: all var(--transition-speed) ease;
        }
        .btn-secondary:hover { background: rgba(0,255,65,0.1); }

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
        }
        .back-to-top.visible { opacity: 1; visibility: visible; }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: rgba(20, 20, 30, 0.98);
            backdrop-filter: blur(10px);
            padding: 2rem;
            padding-top: 5rem; /* Add padding to account for header */
            transition: right 0.3s ease;
            z-index: 1100; /* Higher than overlay */
            overflow-y: auto;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
        }
        .mobile-menu.open { 
            right: 0;
            display: block;
        }

        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000; /* Below menu but above everything else */
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
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
            background-image: linear-gradient(to bottom, rgba(0,255,65,0.05) 1px, transparent 1px);
            background-size: 2px 20px;
            animation: matrix 1s linear infinite;
            pointer-events: none;
        }
        @keyframes matrix {
            0% { background-position: 0 0; }
            100% { background-position: 0 100%; }
        }
        #loading-text { color: var(--cyber-green); font-family: 'Orbitron', monospace; font-size: 1.2rem; margin-bottom: 0.5rem; }
        #progress-bar { width: 0%; height: 8px; background: var(--cyber-green); border-radius: 4px; transition: width 0.4s ease; }
        #percentage { color: var(--cyber-green); font-size: 0.9rem; margin-top: 0.3rem; }
    </style>
</head>
<body class="min-h-screen tech-font">

    <!-- Terminal Preloader -->
    <div id="terminal-preloader">
        <div class="w-4/5 max-w-xl text-center z-10">
            <div id="loading-text">Initializing hack...</div>
            <div class="w-full bg-gray-800 rounded h-2 overflow-hidden">
                <div id="progress-bar"></div>
            </div>
            <div id="percentage">0%</div>
        </div>
    </div>

    <!-- Back to Top -->
    <div id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Navigation -->
    <nav class="cyber-nav" id="mainNav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="home.php" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center">
                        <i class="fas fa-globe text-white text-sm"></i>
                    </div>
                    <span class="cyber-font text-cyber-green text-xl font-bold">LEAKHUNTER</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6 desktop-menu">
                    <a href="home.php">HOME</a>
                    <a href="services.php">SERVICES</a>
                    <a href="about.php">ABOUT</a>
                    <a href="contact.php">CONTACT</a>
                    <a href="documentation.php">DOCS</a>
                    <a href="faq.php">FAQ</a>
                    <a href="login.php" class="btn-secondary">LOGIN</a>
                    <a href="register.php" class="btn-primary">REGISTER</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-cyber-green focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu & Overlay -->
    <div id="mobile-menu" class="mobile-menu" style="display: none;">
        <a href="home.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">HOME</a>
        <a href="services.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">SERVICES</a>
        <a href="about.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">ABOUT</a>
        <a href="contact.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">CONTACT</a>
        <a href="documentation.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">DOCS</a>
        <a href="faq.php" class="block py-3 text-cyber-green hover:text-cyber-blue transition-colors duration-200">FAQ</a>
        <div class="mt-6 pt-4 border-t border-gray-700">
            <a href="login.php" class="block py-3 px-4 text-center btn-secondary rounded-md mb-3">LOGIN</a>
            <a href="register.php" class="block py-3 px-4 text-center btn-primary rounded-md">REGISTER</a>
        </div>
    </div>
    <div id="mobile-overlay-header" class="mobile-overlay"></div>

    <!-- Padding to avoid content hidden under nav -->
    <div class="pt-16">

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
        const isOpen = mobileMenu.classList.toggle('open');
        overlay.classList.toggle('visible');
        
        // Toggle between menu and close icon
        const icon = mobileButton.querySelector('i');
        if (isOpen) {
            mobileMenu.style.display = 'block';
            setTimeout(() => {
                mobileMenu.classList.add('open');
            }, 10);
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        } else {
            mobileMenu.classList.remove('open');
            setTimeout(() => {
                if (!mobileMenu.classList.contains('open')) {
                    mobileMenu.style.display = 'none';
                }
            }, 300); // Match this with your CSS transition time
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            document.body.style.overflow = ''; // Re-enable scrolling
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
