<?php
require_once 'includes/config.php';
require_once 'includes/device_fingerprint.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: admin/dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $full_name = sanitizeInput($_POST['full_name'] ?? '');
    $csrf_token = $_POST['csrf_token'] ?? '';

    // Verify CSRF token
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } elseif (empty($email) || empty($password) || empty($confirm_password) || empty($full_name)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        try {
            $db = Database::getInstance()->getConnection();
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

            // IP rate limit: 1 registration per 24h
            $stmt = $db->prepare("SELECT COUNT(*) AS count FROM activity_logs WHERE user_id IS NULL AND action = 'user_registration' AND ip_address = ? AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
            $stmt->execute([$ip]);
            $result = $stmt->fetch();

            if ($result['count'] > 0) {
                $error = 'Registration limit exceeded. Please try again later.';
            } else {
                // Check if email already exists
                $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = 'Email address is already registered.';
                } else {
                    // Check if full_name already exists
                    $stmt = $db->prepare("SELECT id FROM users WHERE full_name = ?");
                    $stmt->execute([$full_name]);
                    if ($stmt->fetch()) {
                        $error = 'Full name is already taken.';
                    } else {
                        // Generate device fingerprint
                        $deviceFingerprint = generateDeviceFingerprint();
                        
                        // Check if device was already used
                        if (isDeviceUsed($deviceFingerprint)) {
                            $error = 'This device has already been used to create an account. Each device can only have one free trial account.';
                        } else {
                            // Start transaction
                            $db->beginTransaction();
                            
                            try {
                                // Register new user
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                $stmt = $db->prepare("INSERT INTO users (email, password, full_name, tokens_remaining, role, device_id) VALUES (?, ?, ?, 9, 'user', ?)");
                                $stmt->execute([$email, $hashed_password, $full_name, $deviceFingerprint]);
                                
                                $userId = $db->lastInsertId();
                                
                                // Save device fingerprint
                                if (!saveDeviceFingerprint($userId, $deviceFingerprint)) {
                                    throw new Exception('Failed to save device information');
                                }
                                
                                $db->commit();
                                
                                logActivity($userId, 'user_registration', "New user registered: $email", $ip);
                                $success = 'Registration successful! You have been assigned 9 trial tokens. Please log in.';
                            } catch (Exception $e) {
                                $db->rollBack();
                                throw $e; // This will be caught by the outer try-catch
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $error = 'An error occurred during registration. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REGISTRATION - LeakHunter</title>
    <?php echo getFingerprintJS(); ?>
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
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Share+Tech+Mono&display=swap');
        .cyber-font { font-family: 'Orbitron', monospace; }
        .tech-font { font-family: 'Share Tech Mono', monospace; }
        .blink { animation: blink 1s step-end infinite; }
        @keyframes blink { 50% { opacity: 0; } }
    </style>
</head>
<body class="bg-cyber-dark min-h-screen flex flex-col items-center justify-start pt-8 pb-8 tech-font text-cyber-green">
    <div class="relative z-10 w-full max-w-md px-4 py-4">
        <div class="rounded-xl p-6 border border-cyber-green/50 bg-cyber-gray/60 backdrop-blur-md">
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-cyber-green/30">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-cyber-green rounded-full"></div>
                    <div class="w-3 h-3 bg-cyber-blue rounded-full"></div>
                    <div class="w-3 h-3 bg-cyber-purple rounded-full"></div>
                </div>
                <div class="text-cyber-green text-sm">
                    <span class="blink">█</span> REGISTRATION TERMINAL
                </div>
            </div>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <?php if ($error): ?>
                    <div class="bg-cyber-red/20 border border-cyber-red text-cyber-red px-4 py-3 rounded">
                        <i class="fas fa-exclamation-triangle mr-2"></i><?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="bg-cyber-green/20 border border-cyber-green text-cyber-green px-4 py-3 rounded">
                        <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
                        <div class="mt-2"><a href="login.php" class="underline text-cyber-blue hover:text-cyber-green">Login now</a></div>
                    </div>
                <?php endif; ?>

                <div>
                    <label class="block text-sm mb-1">Full Name</label>
                    <input type="text" name="full_name" required class="w-full bg-black/70 border border-cyber-green/40 rounded px-3 py-2 text-cyber-green focus:border-cyber-green focus:ring-0">
                </div>

                <div>
                    <label class="block text-sm mb-1">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-black/70 border border-cyber-green/40 rounded px-3 py-2 text-cyber-green focus:border-cyber-green focus:ring-0">
                </div>

                <div>
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password" required class="w-full bg-black/70 border border-cyber-green/40 rounded px-3 py-2 text-cyber-green focus:border-cyber-green focus:ring-0">
                </div>

                <div>
                    <label class="block text-sm mb-1">Confirm Password</label>
                    <input type="password" name="confirm_password" required class="w-full bg-black/70 border border-cyber-green/40 rounded px-3 py-2 text-cyber-green focus:border-cyber-green focus:ring-0">
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white font-bold py-3 rounded border border-cyber-green/50 hover:from-cyber-green/80 hover:to-cyber-blue/80 focus:outline-none transition-all duration-300 hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i> INITIATE USER REGISTRATION
                </button>
            </form>

            <div class="mt-4 text-center text-cyber-blue text-sm">
                <a href="login.php" class="underline hover:text-cyber-green">Already have an account? Log in</a>
            </div>
        </div>
    </div>
</body>
</html>
