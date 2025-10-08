<?php
require_once 'config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // Verify CSRF token
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } elseif (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['login_time'] = time();
                
                // Update last login
                updateLastLogin($user['id']);
                
                // Log activity
                logActivity($user['id'], 'login', 'User logged in successfully');
                
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Invalid email or password.';
                logActivity(null, 'failed_login', "Failed login attempt for email: $email");
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $error = 'An error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LeakHunter</title>
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
                        'cyber-purple': '#8000ff'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
        .cyber-font {
            font-family: 'Orbitron', monospace;
        }
        
        .glow {
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
        }
        
        .glow-blue {
            box-shadow: 0 0 20px rgba(0, 128, 255, 0.3);
        }
        
        .glow-purple {
            box-shadow: 0 0 20px rgba(128, 0, 255, 0.3);
        }
        
        .matrix-bg {
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 255, 65, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 128, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(128, 0, 255, 0.1) 0%, transparent 50%);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(0, 255, 65, 0.3); }
            to { box-shadow: 0 0 30px rgba(0, 255, 65, 0.6); }
        }
        
        .scan-line {
            position: relative;
            overflow: hidden;
        }
        
        .scan-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 65, 0.3), transparent);
            animation: scan 3s linear infinite;
        }
        
        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        .hologram {
            background: linear-gradient(45deg, 
                rgba(0, 255, 65, 0.1) 0%, 
                rgba(0, 128, 255, 0.1) 25%, 
                rgba(128, 0, 255, 0.1) 50%, 
                rgba(0, 128, 255, 0.1) 75%, 
                rgba(0, 255, 65, 0.1) 100%);
            background-size: 400% 400%;
            animation: hologram 4s ease-in-out infinite;
        }
        
        @keyframes hologram {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
    </style>
</head>
<body class="bg-cyber-dark min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 matrix-bg"></div>
    
    <!-- Floating Particles -->
    <div class="absolute inset-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-cyber-green rounded-full opacity-60 floating" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-cyber-blue rounded-full opacity-40 floating" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-3 h-3 bg-cyber-purple rounded-full opacity-50 floating" style="animation-delay: 2s;"></div>
        <div class="absolute top-2/3 right-1/4 w-1 h-1 bg-cyber-green rounded-full opacity-60 floating" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/3 right-1/2 w-2 h-2 bg-cyber-blue rounded-full opacity-40 floating" style="animation-delay: 1.5s;"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-md px-4 py-4">
        <!-- Logo and Title -->
        <div class="text-center mb-4 sm:mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-cyber-green via-cyber-blue to-cyber-purple rounded-full mb-3 sm:mb-4 pulse-glow floating">
                <i class="fas fa-shield-alt text-lg sm:text-2xl text-white"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-white mb-2 cyber-font glow">LeakHunter</h1>
            <div class="w-20 sm:w-24 h-0.5 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto rounded-full"></div>
            <p class="text-gray-300 mt-2 text-xs sm:text-sm">Cybersecurity Data Breach Monitor</p>
        </div>

        <!-- Login Form -->
        <div class="bg-cyber-gray/90 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-2xl border border-gray-700/50 p-4 sm:p-6 hologram scan-line">
            <form method="POST" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                
                <?php if ($error): ?>
                    <div class="bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-3 py-2 rounded-lg flex items-center backdrop-blur-sm text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="font-medium"><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-3 py-2 rounded-lg flex items-center backdrop-blur-sm text-sm">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-medium"><?php echo $success; ?></span>
                    </div>
                <?php endif; ?>

                <div class="space-y-3">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-200 mb-2 cyber-font">
                            <i class="fas fa-envelope mr-1 text-cyber-blue"></i>Email Address
                        </label>
                        <div class="relative">
                            <input type="email" id="email" name="email" required
                                   class="w-full px-3 py-3 bg-gray-800/80 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-blue focus:glow-blue transition-all duration-300 backdrop-blur-sm text-sm"
                                   placeholder="Enter Your Email"
                                   value="<?php echo htmlspecialchars($email ?? ''); ?>">
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyber-blue/10 to-cyber-purple/10 opacity-0 hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-200 mb-2 cyber-font">
                            <i class="fas fa-lock mr-1 text-cyber-green"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   class="w-full px-3 py-3 bg-gray-800/80 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-green focus:glow transition-all duration-300 backdrop-blur-sm pr-10 text-sm"
                                   placeholder="Enter your password">
                            <button type="button" onclick="togglePassword()" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-cyber-green transition-colors duration-300">
                                <i class="fas fa-eye" id="passwordToggle"></i>
                            </button>
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyber-green/10 to-cyber-blue/10 opacity-0 hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyber-green via-cyber-blue to-cyber-purple text-white font-bold py-3 px-6 rounded-lg hover:from-cyber-green/80 hover:via-cyber-blue/80 hover:to-cyber-purple/80 focus:outline-none focus:ring-4 focus:ring-cyber-blue/50 transition-all duration-300 transform hover:scale-105 cyber-font text-sm glow">
                    <i class="fas fa-sign-in-alt mr-2"></i>ACCESS SYSTEM
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-gray-400 text-xs cyber-font">
            <p class="mb-1">&copy; 2025 LeakHunter. All rights reserved.</p>
            <p class="text-xs opacity-75">Cybersecurity Data Breach Monitoring System</p>
            <div class="w-12 h-0.5 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-2 rounded-full"></div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        // Enhanced cyberpunk animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            const button = document.querySelector('button[type="submit"]');
            
            // Form submission animation
            form.addEventListener('submit', function() {
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>ACCESSING...';
                button.disabled = true;
                button.classList.add('opacity-75');
            });
            
            // Input focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
                
                // Typing effect
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('border-cyber-green');
                    } else {
                        this.classList.remove('border-cyber-green');
                    }
                });
            });
            
            // Add random particle generation
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'absolute w-1 h-1 bg-cyber-green rounded-full opacity-30';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = '100%';
                particle.style.animation = 'float-up 4s linear forwards';
                
                document.querySelector('.absolute.inset-0').appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 4000);
            }
            
            // Create particles periodically
            setInterval(createParticle, 2000);
            
            // Add CSS for particle animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes float-up {
                    0% {
                        transform: translateY(0) rotate(0deg);
                        opacity: 0.3;
                    }
                    50% {
                        opacity: 0.6;
                    }
                    100% {
                        transform: translateY(-100vh) rotate(360deg);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
