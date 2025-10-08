<?php
// LeakHunter Configuration File
// Cybersecurity Data Breach Monitoring System

// Database Configuration   
define('DB_HOST', 'localhost');
define('DB_NAME', 'leakhunter');
define('DB_USER', 'elliot');
define('DB_PASS', 'elliot');
define('DB_CHARSET', 'utf8mb4');

// API Configuration
define('LEAKOSINT_API_URL', 'https://leakosintapi.com/');
define('LEAKOSINT_API_TOKEN', '7856755457:KGSQ0v5m');
define('DEFAULT_SEARCH_LIMIT', 100);
define('DEFAULT_LANGUAGE', 'en');

// Security Configuration
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 minutes

// Application Configuration
define('APP_NAME', 'LeakHunter');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/pawned/');

// File Upload Configuration
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);

// Logging Configuration
define('LOG_LEVEL', 'INFO'); // DEBUG, INFO, WARNING, ERROR
define('LOG_FILE', __DIR__ . '/logs/app.log');

// Create logs directory if it doesn't exist
if (!file_exists(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('UTC');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Connection Class
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please check your configuration.");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

// Utility Functions
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function logActivity($userId, $action, $details = '', $ipAddress = null, $userAgent = null) {
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, details, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId,
            $action,
            $details,
            $ipAddress ?: $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            $userAgent ?: $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
    } catch (Exception $e) {
        error_log("Failed to log activity: " . $e->getMessage());
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function getUserInfo() {
    if (!isLoggedIn()) {
        return null;
    }
    
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ? AND is_active = 1");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log("Failed to get user info: " . $e->getMessage());
        return null;
    }
}

function updateLastLogin($userId) {
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$userId]);
    } catch (Exception $e) {
        error_log("Failed to update last login: " . $e->getMessage());
    }
}

function checkRateLimit($userId, $action, $limit = 10, $window = 3600) {
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT COUNT(*) as count 
            FROM activity_logs 
            WHERE user_id = ? AND action = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)
        ");
        $stmt->execute([$userId, $action, $window]);
        $result = $stmt->fetch();
        
        return $result['count'] < $limit;
    } catch (Exception $e) {
        error_log("Failed to check rate limit: " . $e->getMessage());
        return false;
    }
}
?>
