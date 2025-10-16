<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user || $user['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

$user_id = (int)($_GET['id'] ?? 0);

if ($user_id <= 0) {
    header('Location: users.php?error=invalid_id');
    exit();
}

// Prevent deleting admin users
try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id, email, full_name, role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $targetUser = $stmt->fetch();

    if (!$targetUser) {
        header('Location: users.php?error=user_not_found');
        exit();
    }

    if ($targetUser['role'] === 'admin') {
        header('Location: users.php?error=cannot_delete_admin');
        exit();
    }

    // Start transaction
    $db->beginTransaction();

    // Delete related data first
    $stmt = $db->prepare("DELETE FROM search_history WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $stmt = $db->prepare("DELETE FROM activity_logs WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Delete the user
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);

    $db->commit();

    // Log activity
    logActivity($user['id'], 'delete_user', "Deleted user: {$targetUser['email']} ({$targetUser['full_name']})");

    header('Location: users.php?success=user_deleted');
    exit();

} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    error_log("Delete user error: " . $e->getMessage());
    header('Location: users.php?error=delete_failed');
    exit();
}
?>
