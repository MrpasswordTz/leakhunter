<?php
require_once 'includes/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';

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
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['login_time'] = time();

                updateLastLogin($user['id']);
                logActivity($user['id'], 'login', 'User logged in successfully');

                header('Location: ' . ($user['role'] === 'admin' ? 'admin/dashboard.php' : 'user/dashboard.php'));
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
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap');
        * { box-sizing: border-box; }

        body {
            font-family: 'Share Tech Mono', monospace;
            overflow-x: hidden;
            background: #000;
        }

        .cyber-font { font-family: 'Orbitron', sans-serif; }
        .matrix-bg {
            background: radial-gradient(circle at center, #000 0%, #0a0a0a 100%);
        }
        .cyber-grid {
            background-image: linear-gradient(rgba(0,255,65,0.1) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(0,255,65,0.1) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .data-stream {
            background: linear-gradient(180deg, transparent 0%, rgba(0,255,65,0.05) 50%, transparent 100%);
            animation: flow 8s linear infinite;
        }
        @keyframes flow { 0%{transform:translateY(-100%);}100%{transform:translateY(100%);} }

        .binary-rain {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .binary-digit {
            position: absolute;
            color: rgba(0,255,65,0.7);
            font-size: 12px;
            animation: fall linear infinite;
        }
        @keyframes fall {
            0% {transform:translateY(-100px); opacity:0;}
            10% {opacity:1;}
            90% {opacity:1;}
            100% {transform:translateY(100vh); opacity:0;}
        }

        .hacker-terminal {
            background: rgba(10,10,10,0.95);
            border: 1px solid rgba(0,255,65,0.3);
            box-shadow: 0 0 20px rgba(0,255,65,0.2), inset 0 0 20px rgba(0,255,65,0.1);
        }

        .cyber-input {
            background: rgba(0,0,0,0.8);
            border: 1px solid rgba(0,255,65,0.3);
            transition: all 0.3s ease;
        }
        .cyber-input:focus {
            border-color: rgba(0,128,255,0.6);
            box-shadow: 0 0 10px rgba(0,128,255,0.3);
        }

        .pulse-alert { animation: pulse 2s infinite; }
        @keyframes pulse {
            0%,100% { box-shadow:0 0 15px rgba(255,0,64,0.4); }
            50% { box-shadow:0 0 25px rgba(255,0,64,0.8); }
        }

        @media (max-width: 640px) {
            .hacker-terminal { padding: 1.5rem !important; }
            h1 { font-size: 1.75rem !important; }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center relative bg-cyber-dark text-white">
    <!-- Animated Layers -->
    <div class="absolute inset-0 matrix-bg"></div>
    <div class="absolute inset-0 cyber-grid opacity-50"></div>
    <div class="absolute inset-0 data-stream opacity-20"></div>
    <div class="binary-rain" id="binaryRain"></div>

    <!-- Main Container -->
    <div class="relative z-10 w-full max-w-md mx-auto p-6 sm:p-8">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-cyber-green cyber-font neon-glow">LEAKHUNTER</h1>
            <div class="w-24 sm:w-32 h-1 bg-gradient-to-r from-cyber-green via-cyber-blue to-cyber-purple mx-auto my-2 rounded-full"></div>
            <p class="text-cyber-blue text-xs sm:text-sm tracking-wider">CYBERSECURITY INTELLIGENCE PLATFORM</p>
            <p class="text-gray-400 text-[10px] sm:text-xs">SECURE DATA BREACH MONITORING SYSTEM</p>
        </div>

        <!-- Terminal Box -->
        <div class="hacker-terminal rounded-xl p-5 sm:p-6 backdrop-blur-lg">
            <div class="flex justify-between items-center mb-6 border-b border-cyber-green/30 pb-2">
                <div class="flex space-x-2">
                    <span class="w-3 h-3 bg-cyber-red rounded-full pulse-alert"></span>
                    <span class="w-3 h-3 bg-cyber-yellow rounded-full"></span>
                    <span class="w-3 h-3 bg-cyber-green rounded-full"></span>
                </div>
                <span class="text-cyber-green text-xs sm:text-sm">█ SECURE ACCESS TERMINAL</span>
            </div>

            <form method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <?php if ($error): ?>
                    <div class="bg-cyber-red/20 border border-cyber-red text-cyber-red px-4 py-3 rounded text-xs sm:text-sm pulse-alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>SECURITY ALERT:</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- Email -->
                <div>
                    <label for="email" class="text-cyber-green text-xs sm:text-sm">
                        <i class="fas fa-user-secret mr-2"></i>[IDENTITY VERIFICATION]
                    </label>
                    <div class="relative mt-2">
                        <input type="email" id="email" name="email" required
                            class="cyber-input w-full rounded px-3 py-3 text-cyber-green text-sm placeholder-cyber-green/50 focus:outline-none"
                            placeholder="ENTER_EMAIL_ADDRESS"
                            value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        <i class="fas fa-terminal absolute right-3 top-1/2 -translate-y-1/2 text-cyber-green/50"></i>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="text-cyber-blue text-xs sm:text-sm">
                        <i class="fas fa-key mr-2"></i>[ACCESS CREDENTIALS]
                    </label>
                    <div class="relative mt-2">
                        <input type="password" id="password" name="password" required
                            class="cyber-input w-full rounded px-3 py-3 text-cyber-blue text-sm placeholder-cyber-blue/50 focus:outline-none pr-10"
                            placeholder="ENTER_PASSWORD">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-cyber-blue/50 hover:text-cyber-blue transition">
                            <i class="fas fa-eye" id="passwordToggle"></i>
                        </button>
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white py-3 rounded font-bold text-sm tracking-wider hover:scale-105 transition transform">
                    <i class="fas fa-fingerprint mr-2"></i>INITIATE SYSTEM ACCESS
                </button>

                <!-- Footer links -->
                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center text-xs sm:text-sm text-cyber-green/70">
                    <a href="index.php" class="mb-2 sm:mb-0 hover:text-cyber-green flex items-center">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Home
                    </a>
                    <div class="hidden sm:block text-cyber-green/40">|</div>
                    <p>Don’t have an account? 
                        <a href="register.php" class="text-cyber-blue hover:text-cyber-blue/80 font-semibold">Create Account</a>
                    </p>
                </div>
            </form>

            <!-- Terminal footer -->
            <div class="mt-6 border-t border-cyber-green/30 pt-3 text-[10px] sm:text-xs text-cyber-green/70 flex justify-between">
                <span>ENCRYPTION: AES-256</span>
                <span>PROTOCOL: SSL/TLS</span>
                <span>STATUS: <span class="text-cyber-green">SECURE</span></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-cyber-green/50 text-xs">
            <div class="flex flex-wrap justify-center gap-4 mb-2">
                <span><i class="fas fa-shield-alt mr-1"></i>ENCRYPTED</span>
                <span><i class="fas fa-lock mr-1"></i>SECURE</span>
                <span><i class="fas fa-clock mr-1"></i>24/7 MONITORED</span>
            </div>
            <p>&copy; 2025 LEAKHUNTER CYBERSECURITY</p>
            <p class="text-cyber-blue/50">UNAUTHORIZED ACCESS PROHIBITED</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const toggle = document.getElementById('passwordToggle');
            if (password.type === 'password') {
                password.type = 'text';
                toggle.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                toggle.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Binary rain
        function createBinaryRain() {
            const container = document.getElementById('binaryRain');
            const chars = '01';
            for (let i = 0; i < 40; i++) {
                const d = document.createElement('div');
                d.className = 'binary-digit';
                d.textContent = chars.charAt(Math.floor(Math.random() * chars.length));
                d.style.left = Math.random() * 100 + '%';
                d.style.animationDelay = Math.random() * 5 + 's';
                d.style.animationDuration = (3 + Math.random() * 5) + 's';
                container.appendChild(d);
            }
        }
        document.addEventListener('DOMContentLoaded', createBinaryRain);
    </script>
</body>
</html>
