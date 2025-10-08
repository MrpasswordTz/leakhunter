<?php
require_once 'config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$search_id = (int)($_GET['id'] ?? 0);
$csrf_token = $_GET['token'] ?? '';

if ($search_id <= 0) {
    header('Location: history.php?error=invalid_id');
    exit();
}

// Verify CSRF token
if (!verifyCSRFToken($csrf_token)) {
    header('Location: history.php?error=invalid_token');
    exit();
}

try {
    $db = Database::getInstance()->getConnection();
    
    // Check if search belongs to user
    $stmt = $db->prepare("SELECT query FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$search_id, $user['id']]);
    $search = $stmt->fetch();
    
    if (!$search) {
        header('Location: history.php?error=not_found');
        exit();
    }
    
    // Delete the search
    $stmt = $db->prepare("DELETE FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$search_id, $user['id']]);
    
    // Log activity
    logActivity($user['id'], 'delete_search', "Deleted search: {$search['query']}");
    
    header('Location: history.php?success=deleted');
    exit();
    
} catch (Exception $e) {
    error_log("Delete search error: " . $e->getMessage());
    header('Location: history.php?error=delete_failed');
    exit();
}
?>
