<?php
require_once '../includes/config.php';

// Redirect based on login status and role
if (isLoggedIn()) {
    $user = getUserInfo();
    if ($user && $user['role'] === 'admin') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: user/dashboard.php');
    }
} else {
    header('Location: ../login.php');
}
exit();
?>
