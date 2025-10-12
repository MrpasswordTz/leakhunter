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

        .cyber-nav.scrolled {
            background: rgba(10,10,15,0.95);
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        /* Desktop Menu */
        .desktop-menu a {
            color: var(--cyber-green, #00ff41);
            transition: color 0.3s;
        }
        .desktop-menu a:hover {
            color: var(--cyber-blue, #0080ff);
        }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: rgba(20,20,30,0.98);
            backdrop-filter: blur(10px);
            padding: 2rem;
            transition: right 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }
        .mobile-menu.open { right: 0; }

        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            z-index: 900;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .mobile-overlay.visible {
            opacity: 1;
            visibility: visible;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(45deg, var(--cyber-green,#00ff41), var(--cyber-blue,#0080ff));
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover { transform: translateY(-2px); }

        .btn-secondary {
            border: 2px solid var(--cyber-green,#00ff41);
            color: var(--cyber-green,#00ff41);
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover { background: rgba(0,255,65,0.1); }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(45deg, var(--cyber-green,#00ff41), var(--cyber-blue,#0080ff));
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
    </style>
</head>
<body class="min-h-screen tech-font">

    <!-- Grid background -->
    <div class="fixed inset-0 z-[-1] bg-[linear-gradient(135deg,#0f0f1a,#1a1a2e)]"></div>

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
                    <button id="mobile-menu-button" class="text-cyber-green">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu & Overlay -->
    <div id="mobile-menu" class="mobile-menu">
        <a href="home.php" class="block py-2">HOME</a>
        <a href="services.php" class="block py-2">SERVICES</a>
        <a href="about.php" class="block py-2">ABOUT</a>
        <a href="contact.php" class="block py-2">CONTACT</a>
        <a href="documentation.php" class="block py-2">DOCS</a>
        <a href="faq.php" class="block py-2">FAQ</a>
        <a href="login.php" class="block py-2 btn-secondary text-center mt-4">LOGIN</a>
        <a href="register.php" class="block py-2 btn-primary text-center mt-2">REGISTER</a>
    </div>
    <div id="mobile-overlay-header" class="mobile-overlay"></div>

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
                mobileMenu.classList.toggle('open');
                overlay.classList.toggle('visible');
            }
            mobileButton.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu);

            // Close on resize
            window.addEventListener('resize', () => {
                if(window.innerWidth >= 768){
                    mobileMenu.classList.remove('open');
                    overlay.classList.remove('visible');
                }
            });
        });
    </script>
