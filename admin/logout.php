<?php
require_once '../includes/config.php';

// Log the logout activity before destroying session
if (isLoggedIn()) {
    logActivity($_SESSION['user_id'], 'logout', 'User logged out successfully');
}

// Destroy session
session_destroy();

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page
header('Location: ../login.php?logged_out=1');
exit();
?>
