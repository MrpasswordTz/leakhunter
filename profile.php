<?php
require_once 'config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // Verify CSRF token
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } else {
        try {
            $db = Database::getInstance()->getConnection();
            
            if ($action === 'update_profile') {
                $full_name = sanitizeInput($_POST['full_name'] ?? '');
                $email = sanitizeInput($_POST['email'] ?? '');
                
                if (empty($full_name) || empty($email)) {
                    $error = 'Please fill in all required fields.';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = 'Please enter a valid email address.';
                } else {
                    // Check if email is already taken by another user
                    $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
                    $stmt->execute([$email, $user['id']]);
                    if ($stmt->fetch()) {
                        $error = 'This email address is already in use.';
                    } else {
                        $stmt = $db->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
                        $stmt->execute([$full_name, $email, $user['id']]);
                        
                        // Update session
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_name'] = $full_name;
                        
                        logActivity($user['id'], 'profile_update', "Updated profile information");
                        $success = 'Profile updated successfully.';
                        
                        // Refresh user data
                        $user = getUserInfo();
                    }
                }
            } elseif ($action === 'update_password') {
                $current_password = $_POST['current_password'] ?? '';
                $new_password = $_POST['new_password'] ?? '';
                $confirm_password = $_POST['confirm_password'] ?? '';
                
                if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                    $error = 'Please fill in all password fields.';
                } elseif (!password_verify($current_password, $user['password'])) {
                    $error = 'Current password is incorrect.';
                } elseif (strlen($new_password) < 8) {
                    $error = 'New password must be at least 8 characters long.';
                } elseif ($new_password !== $confirm_password) {
                    $error = 'New passwords do not match.';
                } else {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $stmt->execute([$hashed_password, $user['id']]);
                    
                    logActivity($user['id'], 'password_change', 'Password changed successfully');
                    $success = 'Password changed successfully.';
                }
            } elseif ($action === 'update_api_token') {
                $api_token = sanitizeInput($_POST['api_token'] ?? '');
                
                if (empty($api_token)) {
                    $error = 'Please enter an API token.';
                } else {
                    $stmt = $db->prepare("UPDATE users SET api_token = ? WHERE id = ?");
                    $stmt->execute([$api_token, $user['id']]);
                    
                    logActivity($user['id'], 'api_token_update', 'API token updated');
                    $success = 'API token updated successfully.';
                    
                    // Refresh user data
                    $user = getUserInfo();
                }
            }
        } catch (Exception $e) {
            error_log("Profile update error: " . $e->getMessage());
            $error = 'An error occurred. Please try again.';
        }
    }
}

// Get user statistics
try {
    $db = Database::getInstance()->getConnection();
    
    // Total searches
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM search_history WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $totalSearches = $stmt->fetch()['total'];
    
    // Total tokens used
    $stmt = $db->prepare("SELECT SUM(tokens_used) as total FROM search_history WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $totalTokensUsed = $stmt->fetch()['total'] ?? 0;
    
    // Account created
    $accountCreated = $user['created_at'];
    
} catch (Exception $e) {
    error_log("Profile stats error: " . $e->getMessage());
    $totalSearches = $totalTokensUsed = 0;
    $accountCreated = $user['created_at'];
}

// Log page view
logActivity($user['id'], 'profile_view', 'Viewed profile page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - LeakHunter</title>
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
</head>
<body class="bg-cyber-dark min-h-screen">
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-cyber-gray/80 backdrop-blur-sm border-b border-gray-800 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Profile Settings</h1>
                    <p class="text-gray-400">Manage your account information and preferences</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Account Status</p>
                        <p class="text-sm font-bold text-cyber-green">Active</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Content -->
        <main class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-user text-cyber-blue mr-2"></i>
                            Basic Information
                        </h3>
                        
                        <form method="POST" class="space-y-4">
                            <input type="hidden" name="action" value="update_profile">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                            
                            <?php if ($error && ($_POST['action'] ?? '') === 'update_profile'): ?>
                                <div class="bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($success && ($_POST['action'] ?? '') === 'update_profile'): ?>
                                <div class="bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-user mr-2"></i>Full Name
                                    </label>
                                    <input type="text" id="full_name" name="full_name" required
                                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all"
                                           value="<?php echo htmlspecialchars($user['full_name']); ?>">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-envelope mr-2"></i>Email Address
                                    </label>
                                    <input type="email" id="email" name="email" required
                                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all"
                                           value="<?php echo htmlspecialchars($user['email']); ?>">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white font-semibold py-3 px-6 rounded-lg hover:from-cyber-green/80 hover:to-cyber-blue/80 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:ring-offset-2 focus:ring-offset-cyber-dark transition-all">
                                <i class="fas fa-save mr-2"></i>Update Profile
                            </button>
                        </form>
                    </div>

                    <!-- Password Change -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-lock text-cyber-red mr-2"></i>
                            Change Password
                        </h3>
                        
                        <form method="POST" class="space-y-4">
                            <input type="hidden" name="action" value="update_password">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                            
                            <?php if ($error && ($_POST['action'] ?? '') === 'update_password'): ?>
                                <div class="bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($success && ($_POST['action'] ?? '') === 'update_password'): ?>
                                <div class="bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-key mr-2"></i>Current Password
                                </label>
                                <input type="password" id="current_password" name="current_password" required
                                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-lock mr-2"></i>New Password
                                    </label>
                                    <input type="password" id="new_password" name="new_password" required
                                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all">
                                </div>

                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-300 mb-2">
                                        <i class="fas fa-lock mr-2"></i>Confirm Password
                                    </label>
                                    <input type="password" id="confirm_password" name="confirm_password" required
                                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="bg-gradient-to-r from-cyber-red to-cyber-purple text-white font-semibold py-3 px-6 rounded-lg hover:from-cyber-red/80 hover:to-cyber-purple/80 focus:outline-none focus:ring-2 focus:ring-cyber-red focus:ring-offset-2 focus:ring-offset-cyber-dark transition-all">
                                <i class="fas fa-key mr-2"></i>Change Password
                            </button>
                        </form>
                    </div>

                    <!-- API Token -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-code text-cyber-purple mr-2"></i>
                            API Token Configuration
                        </h3>
                        
                        <form method="POST" class="space-y-4">
                            <input type="hidden" name="action" value="update_api_token">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                            
                            <?php if ($error && ($_POST['action'] ?? '') === 'update_api_token'): ?>
                                <div class="bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($success && ($_POST['action'] ?? '') === 'update_api_token'): ?>
                                <div class="bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-4 py-3 rounded-lg flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <div>
                                <label for="api_token" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-key mr-2"></i>API Token
                                </label>
                                <div class="relative">
                                    <input type="password" id="api_token" name="api_token" 
                                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all pr-12"
                                           value="<?php echo htmlspecialchars($user['api_token'] ?? ''); ?>"
                                           placeholder="Enter your LeakOSINT API token">
                                    <button type="button" onclick="toggleApiToken()" 
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors">
                                        <i class="fas fa-eye" id="apiTokenToggle"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Get your API token from the LeakOSINT bot using /API command
                                </p>
                            </div>

                            <button type="submit" 
                                    class="bg-gradient-to-r from-cyber-purple to-cyber-blue text-white font-semibold py-3 px-6 rounded-lg hover:from-cyber-purple/80 hover:to-cyber-blue/80 focus:outline-none focus:ring-2 focus:ring-cyber-purple focus:ring-offset-2 focus:ring-offset-cyber-dark transition-all">
                                <i class="fas fa-save mr-2"></i>Update API Token
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Account Statistics -->
                <div class="space-y-6">
                    <!-- Account Info -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-chart-bar text-cyber-green mr-2"></i>
                            Account Statistics
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Total Searches</span>
                                <span class="text-white font-semibold"><?php echo number_format($totalSearches); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Tokens Used</span>
                                <span class="text-white font-semibold"><?php echo number_format($totalTokensUsed); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Tokens Remaining</span>
                                <span class="text-cyber-green font-semibold"><?php echo number_format($user['tokens_remaining']); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Member Since</span>
                                <span class="text-white font-semibold"><?php echo date('M j, Y', strtotime($accountCreated)); ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Last Login</span>
                                <span class="text-white font-semibold">
                                    <?php echo $user['last_login'] ? date('M j, g:i A', strtotime($user['last_login'])) : 'Never'; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Security Info -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-shield-alt text-cyber-red mr-2"></i>
                            Security Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Account Status</span>
                                <span class="bg-cyber-green/20 text-cyber-green px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>Active
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Password Strength</span>
                                <span class="bg-cyber-green/20 text-cyber-green px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-shield-alt mr-1"></i>Strong
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">2FA Status</span>
                                <span class="bg-gray-600/20 text-gray-400 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-times-circle mr-1"></i>Disabled
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                        <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                            <i class="fas fa-bolt text-cyber-blue mr-2"></i>
                            Quick Actions
                        </h3>
                        
                        <div class="space-y-3">
                            <a href="dashboard.php" 
                               class="flex items-center w-full px-4 py-3 bg-gray-800/50 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Go to Dashboard</span>
                            </a>
                            
                            <a href="search.php" 
                               class="flex items-center w-full px-4 py-3 bg-gray-800/50 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all">
                                <i class="fas fa-search mr-3"></i>
                                <span>Start New Search</span>
                            </a>
                            
                            <a href="history.php" 
                               class="flex items-center w-full px-4 py-3 bg-gray-800/50 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all">
                                <i class="fas fa-history mr-3"></i>
                                <span>View Search History</span>
                            </a>
                            
                            <a href="logout.php" 
                               class="flex items-center w-full px-4 py-3 bg-cyber-red/20 text-cyber-red rounded-lg hover:bg-cyber-red/30 transition-all">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleApiToken() {
            const apiTokenInput = document.getElementById('api_token');
            const apiTokenToggle = document.getElementById('apiTokenToggle');
            
            if (apiTokenInput.type === 'password') {
                apiTokenInput.type = 'text';
                apiTokenToggle.classList.remove('fa-eye');
                apiTokenToggle.classList.add('fa-eye-slash');
            } else {
                apiTokenInput.type = 'password';
                apiTokenToggle.classList.remove('fa-eye-slash');
                apiTokenToggle.classList.add('fa-eye');
            }
        }

        // Form submission animations
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                    button.disabled = true;
                    
                    // Re-enable after 3 seconds in case of error
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }, 3000);
                });
            });
        });
    </script>
</body>
</html>
