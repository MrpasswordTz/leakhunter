<?php
require_once 'includes/config.php';

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
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1 AND is_banned = 0");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['login_time'] = time();
                
                // Update last login
                updateLastLogin($user['id']);
                
                // Log activity
                logActivity($user['id'], 'login', 'User logged in successfully');
                
                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: admin/dashboard.php');
                } else {
                    header('Location: user/dashboard.php');
                }
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
    <title>SECURE ACCESS - LeakHunter</title>
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
        
        .hacker-terminal {
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 255, 65, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 128, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(128, 0, 255, 0.15) 0%, transparent 50%),
                linear-gradient(135deg, rgba(10, 10, 10, 0.9) 0%, rgba(26, 26, 26, 0.95) 100%);
            border: 1px solid rgba(0, 255, 65, 0.3);
            box-shadow: 
                0 0 30px rgba(0, 255, 65, 0.2),
                inset 0 0 30px rgba(0, 255, 65, 0.1);
        }
        
        .cyber-scan {
            position: relative;
            overflow: hidden;
        }
        
        .cyber-scan::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(0, 255, 65, 1),
                rgba(0, 128, 255, 1),
                rgba(128, 0, 255, 1),
                rgba(0, 255, 65, 1),
                transparent);
            animation: cyberScan 3s ease-in-out infinite;
        }
        
        @keyframes cyberScan {
            0% { left: -100%; opacity: 0; }
            50% { opacity: 1; }
            100% { left: 100%; opacity: 0; }
        }
        
        .binary-rain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            overflow: hidden;
        }
        
        .binary-digit {
            position: absolute;
            color: rgba(0, 255, 65, 0.7);
            font-family: 'Share Tech Mono', monospace;
            font-size: 14px;
            animation: binaryFall linear infinite;
            text-shadow: 0 0 5px rgba(0, 255, 65, 0.8);
        }
        
        @keyframes binaryFall {
            0% { transform: translateY(-100px); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(100vh); opacity: 0; }
        }
        
        .pulse-alert {
            animation: pulseAlert 2s ease-in-out infinite;
        }
        
        @keyframes pulseAlert {
            0%, 100% { 
                box-shadow: 
                    0 0 20px rgba(255, 0, 64, 0.4),
                    inset 0 0 20px rgba(255, 0, 64, 0.1);
            }
            50% { 
                box-shadow: 
                    0 0 40px rgba(255, 0, 64, 0.8),
                    inset 0 0 30px rgba(255, 0, 64, 0.2);
            }
        }
        
        .neon-glow {
            text-shadow: 
                0 0 5px currentColor,
                0 0 10px currentColor,
                0 0 15px currentColor,
                0 0 20px currentColor;
        }
        
        .cyber-input {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(0, 255, 65, 0.3);
            box-shadow: 
                inset 0 0 10px rgba(0, 255, 65, 0.1),
                0 0 10px rgba(0, 255, 65, 0.1);
            transition: all 0.3s ease;
        }
        
        .cyber-input:focus {
            border-color: rgba(0, 128, 255, 0.6);
            box-shadow: 
                inset 0 0 20px rgba(0, 128, 255, 0.2),
                0 0 20px rgba(0, 128, 255, 0.3);
        }
        
        .access-granted {
            animation: accessGranted 0.5s ease-in-out;
        }
        
        @keyframes accessGranted {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .floating-holo {
            animation: floatingHolo 4s ease-in-out infinite;
        }
        
        @keyframes floatingHolo {
            0%, 100% { 
                transform: translateY(0px) rotateX(0deg); 
                box-shadow: 
                    0 0 30px rgba(0, 255, 65, 0.3),
                    inset 0 0 30px rgba(0, 255, 65, 0.1);
            }
            50% { 
                transform: translateY(-10px) rotateX(5deg); 
                box-shadow: 
                    0 0 50px rgba(0, 128, 255, 0.5),
                    inset 0 0 40px rgba(0, 128, 255, 0.2);
            }
        }
        
        .security-grid {
            background: 
                linear-gradient(90deg, rgba(0, 255, 65, 0.1) 1px, transparent 1px),
                linear-gradient(rgba(0, 255, 65, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-cyber-dark min-h-screen flex items-center justify-center overflow-hidden tech-font">
    <!-- Animated Background Layers -->
    <div class="absolute inset-0 matrix-bg"></div>
    <div class="absolute inset-0 cyber-grid"></div>
    <div class="absolute inset-0 security-grid"></div>
    <div class="absolute inset-0 data-stream"></div>
    
    <!-- Binary Rain Effect -->
    <div class="binary-rain" id="binaryRain"></div>
    
    <!-- Scanning Lines -->
    <div class="absolute inset-0">
        <div class="cyber-scan" style="animation-delay: 0s;"></div>
        <div class="cyber-scan" style="animation-delay: 1s;"></div>
        <div class="cyber-scan" style="animation-delay: 2s;"></div>
    </div>
    
    <!-- Floating Security Nodes -->
    <div class="absolute inset-0">
        <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-cyber-green rounded-full floating-holo" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-1/3 w-2 h-2 bg-cyber-blue rounded-full floating-holo" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-4 h-4 bg-cyber-purple rounded-full floating-holo" style="animation-delay: 2s;"></div>
        <div class="absolute top-2/3 right-1/4 w-2 h-2 bg-cyber-orange rounded-full floating-holo" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/3 right-1/2 w-3 h-3 bg-cyber-yellow rounded-full floating-holo" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-4 py-4">
        <!-- Security Header -->
        <div class="text-center mb-6 cyber-scan">
            <h1 class="text-3xl font-black text-cyber-green mb-2 cyber-font neon-glow">LEAKHUNTER</h1>
            <div class="w-32 h-1 bg-gradient-to-r from-cyber-green via-cyber-blue to-cyber-purple mx-auto rounded-full mb-2"></div>
            <p class="text-cyber-blue text-sm tech-font tracking-wider">CYBERSECURITY INTELLIGENCE PLATFORM</p>
            <p class="text-gray-400 text-xs mt-1 tech-font">SECURE DATA BREACH MONITORING SYSTEM</p>
        </div>

        <!-- Login Terminal -->
        <div class="hacker-terminal rounded-xl p-6 cyber-scan relative overflow-hidden">
            <!-- Terminal Header -->
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-cyber-green/30">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-cyber-red rounded-full pulse-alert"></div>
                    <div class="w-3 h-3 bg-cyber-yellow rounded-full"></div>
                    <div class="w-3 h-3 bg-cyber-green rounded-full"></div>
                </div>
                <div class="text-cyber-green text-sm tech-font">
                    <span class="blink">█</span> SECURE ACCESS TERMINAL
                </div>
            </div>

            <form method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                
                <?php if ($error): ?>
                    <div class="bg-cyber-red/20 border border-cyber-red text-cyber-red px-4 py-3 rounded tech-font text-sm pulse-alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="font-bold">SECURITY ALERT:</span> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-cyber-green text-sm tech-font tracking-wider">
                        <i class="fas fa-user-secret mr-2"></i>[IDENTITY VERIFICATION]
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-4 cyber-input rounded text-cyber-green placeholder-cyber-green/50 focus:outline-none tech-font text-sm"
                               placeholder="ENTER_EMAIL_ADDRESS"
                               value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-terminal text-cyber-green/50"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-cyber-blue text-sm tech-font tracking-wider">
                        <i class="fas fa-key mr-2"></i>[ACCESS CREDENTIALS]
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-4 cyber-input rounded text-cyber-blue placeholder-cyber-blue/50 focus:outline-none tech-font text-sm pr-12"
                               placeholder="ENTER_PASSWORD">
                        <button type="button" onclick="togglePassword()" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyber-blue/50 hover:text-cyber-blue transition-colors">
                            <i class="fas fa-eye" id="passwordToggle"></i>
                        </button>
                    </div>
                </div>

                <!-- Access Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white font-bold py-4 px-6 rounded border border-cyber-green/50 hover:from-cyber-green/80 hover:to-cyber-blue/80 focus:outline-none focus:ring-4 focus:ring-cyber-blue/30 transition-all duration-300 cyber-font text-sm tracking-wider hover:scale-105 access-granted group">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-fingerprint mr-3 group-hover:scale-110 transition-transform"></i>
                        <span>INITIATE SYSTEM ACCESS</span>
                        <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </button>
                
                <div class="mt-4 text-center">
                    <a href="index.php" class="inline-flex items-center text-cyber-green/70 hover:text-cyber-green transition-colors text-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Home
                    </a>
                </div>
            </form>

            <!-- Terminal Footer -->
            <div class="mt-6 pt-4 border-t border-cyber-green/30">
                <div class="flex justify-between text-xs text-cyber-green/70 tech-font">
                    <span>ENCRYPTION: AES-256</span>
                    <span>PROTOCOL: SSL/TLS</span>
                    <span>STATUS: <span class="text-cyber-green blink">SECURE</span></span>
                </div>
            </div>
        </div>

        <!-- Security Footer -->
        <div class="text-center mt-6 text-cyber-green/50 text-xs tech-font">
            <div class="flex justify-center space-x-6 mb-3">
                <span><i class="fas fa-shield-alt mr-1"></i>ENCRYPTED</span>
                <span><i class="fas fa-lock mr-1"></i>SECURE</span>
                <span><i class="fas fa-clock mr-1"></i>24/7 MONITORED</span>
            </div>
            <p class="mb-2">&copy; 2025 LEAKHUNTER CYBERSECURITY</p>
            <p class="text-cyber-blue/50">UNAUTHORIZED ACCESS PROHIBITED</p>
            <div class="w-20 h-0.5 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-3 rounded-full"></div>
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

        // Create binary rain effect
        function createBinaryRain() {
            const binaryRain = document.getElementById('binaryRain');
            const characters = '0101010101010101';
            
            for (let i = 0; i < 50; i++) {
                const digit = document.createElement('div');
                digit.className = 'binary-digit';
                digit.textContent = characters.charAt(Math.floor(Math.random() * characters.length));
                digit.style.left = Math.random() * 100 + '%';
                digit.style.animationDelay = Math.random() * 5 + 's';
                digit.style.animationDuration = (3 + Math.random() * 5) + 's';
                binaryRain.appendChild(digit);
            }
        }

        // Enhanced cyberpunk interactions
        document.addEventListener('DOMContentLoaded', function() {
            createBinaryRain();
            
            const form = document.querySelector('form');
            const inputs = document.querySelectorAll('input');
            const button = document.querySelector('button[type="submit"]');
            
            // Form submission with enhanced effects
            form.addEventListener('submit', function(e) {
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>ACCESSING SECURE SYSTEM...';
                button.disabled = true;
                button.classList.add('opacity-75', 'pulse-alert');
                
                // Add typing effect to inputs during submission
                inputs.forEach(input => {
                    input.style.color = '#00ff41';
                    input.style.textShadow = '0 0 10px #00ff41';
                });
            });
            
            // Input focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.boxShadow = 'inset 0 0 20px rgba(0, 128, 255, 0.3), 0 0 30px rgba(0, 128, 255, 0.4)';
                    this.style.borderColor = 'rgba(0, 128, 255, 0.8)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.boxShadow = 'inset 0 0 10px rgba(0, 255, 65, 0.1), 0 0 10px rgba(0, 255, 65, 0.1)';
                    this.style.borderColor = 'rgba(0, 255, 65, 0.3)';
                });
                
                // Real-time validation effect
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.style.color = this.type === 'password' ? '#0080ff' : '#00ff41';
                    } else {
                        this.style.color = this.type === 'password' ? '#0080ff' : '#00ff41';
                    }
                });
            });
            
            // Add blinking cursor effect to labels
            const labels = document.querySelectorAll('label');
            labels.forEach(label => {
                setInterval(() => {
                    label.classList.toggle('opacity-70');
                }, 1000);
            });
            
            // Continuous binary rain generation
            setInterval(() => {
                const digits = document.querySelectorAll('.binary-digit');
                if (digits.length < 100) {
                    createBinaryRain();
                }
            }, 5000);
        });

        // Add blinking animation
        const style = document.createElement('style');
        style.textContent = `
            .blink {
                animation: blink 1s step-end infinite;
            }
            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
