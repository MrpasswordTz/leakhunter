<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user || $user['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

$userId = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (!$userId || !in_array($action, ['ban', 'unban'])) {
    header('Location: users.php?error=Invalid request');
    exit();
}

try {
    $db = Database::getInstance()->getConnection();

    // Get user info
    $stmt = $db->prepare("SELECT full_name, email, role FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $targetUser = $stmt->fetch();

    if (!$targetUser) {
        header('Location: users.php?error=User not found');
        exit();
    }

    if ($targetUser['role'] === 'admin') {
        header('Location: users.php?error=Cannot ban admin users');
        exit();
    }

    // Update ban status
    $isBanned = $action === 'ban' ? 1 : 0;
    $stmt = $db->prepare("UPDATE users SET is_banned = ? WHERE id = ?");
    $stmt->execute([$isBanned, $userId]);

    // Log activity
    $actionText = $action === 'ban' ? 'banned' : 'unbanned';
    logActivity($user['id'], 'user_' . $action, "User $actionText: " . $targetUser['full_name'] . " (" . $targetUser['email'] . ")");

    header('Location: users.php?success=User ' . $actionText . ' successfully');
    exit();

} catch (Exception $e) {
    error_log("Block user error: " . $e->getMessage());
    header('Location: users.php?error=An error occurred');
    exit();
}
?>
