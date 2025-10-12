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
                        'cyber-red': '#ff0040',
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

        .cyber-font {
            font-family: 'Orbitron', monospace;
        }

        .tech-font {
            font-family: 'Share Tech Mono', monospace;
        }
        

        .matrix-bg {
            background:
                linear-gradient(45deg, #0a0a0a 25%, transparent 25%) -50px 0,
                linear-gradient(-45deg, #0a0a0a 25%, transparent 25%) -50px 0,
                linear-gradient(45deg, transparent 75%, #0a0a0a 75%),
                linear-gradient(-45deg, transparent 75%, #0a0a0a 75%);
            background-size: 100px 100px;
            background-color: #000;
        }

        .cyber-grid {
            background-image:
                linear-gradient(rgba(0, 255, 65, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 65, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .data-stream {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg,
                transparent 0%,
                rgba(0, 255, 65, 0.1) 10%,
                rgba(0, 128, 255, 0.1) 30%,
                rgba(128, 0, 255, 0.1) 50%,
                rgba(0, 128, 255, 0.1) 70%,
                rgba(0, 255, 65, 0.1) 90%,
                transparent 100%);
            animation: dataFlow 8s linear infinite;
        }

        @keyframes dataFlow {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }

        .neon-glow {
            text-shadow:
                0 0 5px currentColor,
                0 0 10px currentColor,
                0 0 15px currentColor,
                0 0 20px currentColor;
        }

        .cyber-nav {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 255, 65, 0.3);
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.2);
        }

        .mobile-menu {
            display: none;
        }

        .mobile-menu.open {
            display: block;
        }

        .blink {
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .matrix-bg, .cyber-grid, .data-stream {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-cyber-dark min-h-screen tech-font">

    <!-- Animated Background Layers -->
    <div class="absolute inset-0 matrix-bg -z-10"></div>
    <div class="absolute inset-0 cyber-grid -z-10"></div>
    <div class="absolute inset-0 data-stream -z-10"></div>

    <!-- Navigation -->
    <nav class="cyber-nav fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="home.php" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                        <span class="cyber-font text-cyber-green text-xl font-bold neon-glow">LEAKHUNTER</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="home.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">HOME</a>
                    <a href="services.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">SERVICES</a>
                    <a href="about.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">ABOUT</a>
                    <a href="contact.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">CONTACT</a>
                    <a href="documentation.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">DOCS</a>
                    <a href="faq.php" class="text-cyber-green hover:text-cyber-blue transition-colors tech-font">FAQ</a>
                    <div class="flex items-center space-x-4">
                        <a href="login.php" class="bg-cyber-green/20 border border-cyber-green text-cyber-green px-4 py-2 rounded hover:bg-cyber-green/30 transition-colors tech-font text-sm">
                            LOGIN
                        </a>
                        <a href="register.php" class="bg-cyber-blue/20 border border-cyber-blue text-cyber-blue px-4 py-2 rounded hover:bg-cyber-blue/30 transition-colors tech-font text-sm">
                            REGISTER
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-cyber-green hover:text-cyber-blue transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu bg-cyber-gray border-t border-cyber-green/30">
            <div class="px-4 py-4 space-y-4">
                <a href="home.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">HOME</a>
                <a href="services.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">SERVICES</a>
                <a href="about.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">ABOUT</a>
                <a href="contact.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">CONTACT</a>
                <a href="documentation.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">DOCS</a>
                <a href="faq.php" class="block text-cyber-green hover:text-cyber-blue transition-colors tech-font py-2">FAQ</a>
                <div class="flex flex-col space-y-2 pt-4 border-t border-cyber-green/30">
                    <a href="login.php" class="bg-cyber-green/20 border border-cyber-green text-cyber-green px-4 py-2 rounded text-center hover:bg-cyber-green/30 transition-colors tech-font">
                        LOGIN
                    </a>
                    <a href="register.php" class="bg-cyber-blue/20 border border-cyber-blue text-cyber-blue px-4 py-2 rounded text-center hover:bg-cyber-blue/30 transition-colors tech-font">
                        REGISTER
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile overlay for header menu -->
    <div id="mobile-overlay-header" class="fixed inset-0 bg-black/50 z-40 md:hidden" style="display: none;"></div>

    <!-- Main Content Container -->
    <div class="pt-16">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay-header');

        if (mobileMenuButton && mobileMenu && mobileOverlay) {
            function toggleMobileMenu() {
                if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                    mobileMenu.style.display = 'block';
                    mobileOverlay.style.display = 'block';
                } else {
                    mobileMenu.style.display = 'none';
                    mobileOverlay.style.display = 'none';
                }
            }

            mobileMenuButton.addEventListener('click', toggleMobileMenu);
            mobileOverlay.addEventListener('click', toggleMobileMenu);

            // Close on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    mobileMenu.style.display = 'none';
                    mobileOverlay.style.display = 'none';
                }
            });
        }
    });

    // Terminal Preloader Animation
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

        let currentStage = 0;

        function updateProgress() {
            if (currentStage < stages.length) {
                loadingText.textContent = stages[currentStage].text;
                progressBar.style.width = stages[currentStage].percent + '%';
                percentage.textContent = stages[currentStage].percent + '%';
                currentStage++;
                setTimeout(updateProgress, 400); // Update every 400ms for ~2s total
            } else {
                // Hide preloader after completion
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 300);
                }, 500);
            }
        }

        updateProgress();
    });
    </script>
