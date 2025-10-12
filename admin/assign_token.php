<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user || $user['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)($_POST['user_id'] ?? 0);
    $tokensToAssign = (int)($_POST['tokens'] ?? 0);
    $reason = sanitizeInput($_POST['reason'] ?? '');
    $csrf_token = $_POST['csrf_token'] ?? '';

    // Verify CSRF token
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } elseif ($userId <= 0 || $tokensToAssign <= 0) {
        $error = 'Please select a user and enter a valid number of tokens.';
    } elseif (empty($reason)) {
        $error = 'Please provide a reason for token assignment.';
    } else {
        try {
            $db = Database::getInstance()->getConnection();

            // Check if user exists and is not banned
            $stmt = $db->prepare("SELECT id, full_name, email FROM users WHERE id = ? AND is_active = 1 AND is_banned = 0");
            $stmt->execute([$userId]);
            $targetUser = $stmt->fetch();

            if (!$targetUser) {
                $error = 'Selected user not found or inactive.';
            } else {
                // Update user tokens
                $stmt = $db->prepare("UPDATE users SET tokens_remaining = tokens_remaining + ? WHERE id = ?");
                $stmt->execute([$tokensToAssign, $userId]);

                // Log token transaction
                $stmt = $db->prepare("INSERT INTO token_transactions (user_id, admin_id, tokens_assigned, reason) VALUES (?, ?, ?, ?)");
                $stmt->execute([$userId, $user['id'], $tokensToAssign, $reason]);

                $success = "Successfully assigned $tokensToAssign tokens to " . htmlspecialchars($targetUser['full_name']) . " (" . htmlspecialchars($targetUser['email']) . ").";

                // Log activity
                logActivity($user['id'], 'token_assignment', "Assigned $tokensToAssign tokens to user ID $userId: $reason");
            }
        } catch (Exception $e) {
            error_log("Token assignment error: " . $e->getMessage());
            $error = 'An error occurred during token assignment. Please try again.';
        }
    }
}

// Get list of users for dropdown
try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id, full_name, email, tokens_remaining FROM users WHERE is_active = 1 AND is_banned = 0 ORDER BY full_name");
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    $users = [];
}

// Log page view
logActivity($user['id'], 'assign_token_page_view', 'Viewed token assignment page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tokens - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>

    <div class="lg:ml-64 min-h-screen p-6">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Assign Tokens to User</h1>

            <?php if ($error): ?>
                <div class="bg-red-800 text-red-200 p-4 rounded mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="bg-green-800 text-green-200 p-4 rounded mb-4"><?php echo $success; ?></div>
            <?php endif; ?>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <form method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                    <div class="mb-4">
                        <label class="block text-gray-300 mb-2">Select User</label>
                        <select name="user_id" required class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none">
                            <option value="">Choose a user...</option>
                            <?php foreach ($users as $u): ?>
                                <option value="<?php echo $u['id']; ?>" <?php echo (isset($_POST['user_id']) && $_POST['user_id'] == $u['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($u['full_name']); ?> (<?php echo htmlspecialchars($u['email']); ?>) - <?php echo $u['tokens_remaining']; ?> tokens
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 mb-2">Tokens to Assign</label>
                        <input type="number" name="tokens" min="1" max="1000" required
                               class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none"
                               value="<?php echo htmlspecialchars($_POST['tokens'] ?? ''); ?>"
                               placeholder="Enter number of tokens">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-300 mb-2">Reason</label>
                        <textarea name="reason" rows="4" required
                                  class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none"
                                  placeholder="Provide a reason for this token assignment"><?php echo htmlspecialchars($_POST['reason'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>Assign Tokens
                    </button>
                </form>
            </div>

            <!-- Recent Token Assignments -->
            <div class="mt-8 bg-gray-800 rounded-lg p-6 border border-gray-700">
                <h2 class="text-xl font-semibold mb-4">Recent Token Assignments</h2>
                <?php
                try {
                    $stmt = $db->prepare("
                        SELECT tt.*, u.full_name, u.email, a.full_name as admin_name
                        FROM token_transactions tt
                        JOIN users u ON tt.user_id = u.id
                        JOIN users a ON tt.admin_id = a.id
                        ORDER BY tt.created_at DESC LIMIT 10
                    ");
                    $stmt->execute();
                    $transactions = $stmt->fetchAll();
                } catch (Exception $e) {
                    $transactions = [];
                }
                ?>

                <?php if (empty($transactions)): ?>
                    <p class="text-gray-400">No token assignments yet.</p>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach ($transactions as $t): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-700 rounded">
                                <div>
                                    <p class="text-white font-medium">
                                        <?php echo htmlspecialchars($t['full_name']); ?> (<?php echo htmlspecialchars($t['email']); ?>)
                                    </p>
                                    <p class="text-gray-400 text-sm"><?php echo htmlspecialchars($t['reason']); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-green-400 font-semibold">+<?php echo $t['tokens_assigned']; ?> tokens</p>
                                    <p class="text-gray-400 text-sm">
                                        by <?php echo htmlspecialchars($t['admin_name']); ?><br>
                                        <?php echo date('M j, Y g:i A', strtotime($t['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
