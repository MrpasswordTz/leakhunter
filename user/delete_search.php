<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    header('Location: history.php');
    exit();
}

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT query FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user['id']]);
    $search = $stmt->fetch();

    if (!$search) {
        header('Location: history.php');
        exit();
    }

    // Delete the search
    $stmt = $db->prepare("DELETE FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user['id']]);

    // Log deletion
    logActivity($user['id'], 'delete_search', "Deleted search: {$search['query']}");

    // Redirect with success
    header('Location: history.php?success=Search deleted successfully');
    exit();

} catch (Exception $e) {
    error_log("Delete search error: " . $e->getMessage());
    header('Location: history.php?error=Failed to delete search');
    exit();
}
?>
