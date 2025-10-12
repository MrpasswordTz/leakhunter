<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user || $user['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

// Handle search/filter
$search = $_GET['search'] ?? '';
$role_filter = $_GET['role'] ?? '';
$status_filter = $_GET['status'] ?? '';

// Build query
$query = "SELECT id, email, full_name, role, is_banned, tokens_remaining, registration_date, last_login FROM users WHERE 1=1";
$params = [];

if (!empty($search)) {
    $query .= " AND (email LIKE ? OR full_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($role_filter)) {
    $query .= " AND role = ?";
    $params[] = $role_filter;
}

if ($status_filter === 'banned') {
    $query .= " AND is_banned = 1";
} elseif ($status_filter === 'active') {
    $query .= " AND is_banned = 0";
}

$query .= " ORDER BY registration_date DESC";

// Get users
try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    error_log("Users list error: " . $e->getMessage());
    $users = [];
}

// Log page view
logActivity($user['id'], 'users_page_view', 'Viewed users management page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>

    <div class="lg:ml-64 min-h-screen p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">User Management</h1>
            <div class="flex space-x-2">
                <a href="adduser.php" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Add User
                </a>
                <a href="assign_token.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>Assign Tokens
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-gray-800 rounded-lg p-4 mb-6 border border-gray-700">
            <form method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                           placeholder="Search by email or name..."
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <select name="role" class="p-2 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none">
                        <option value="">All Roles</option>
                        <option value="user" <?php echo $role_filter === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $role_filter === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div>
                    <select name="status" class="p-2 rounded bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:outline-none">
                        <option value="">All Status</option>
                        <option value="active" <?php echo $status_filter === 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="banned" <?php echo $status_filter === 'banned' ? 'selected' : ''; ?>>Banned</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <?php if (!empty($search) || !empty($role_filter) || !empty($status_filter)): ?>
                    <a href="users.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition-colors">
                        <i class="fas fa-times mr-2"></i>Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Messages -->
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-600 text-white p-4 rounded mb-4">
                <i class="fas fa-check-circle mr-2"></i>User deleted successfully.
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="bg-red-600 text-white p-4 rounded mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <?php
                switch ($_GET['error']) {
                    case 'invalid_id': echo 'Invalid user ID.'; break;
                    case 'user_not_found': echo 'User not found.'; break;
                    case 'cannot_delete_admin': echo 'Cannot delete admin users.'; break;
                    case 'delete_failed': echo 'Failed to delete user.'; break;
                    default: echo 'An error occurred.';
                }
                ?>
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tokens</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Registered</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Last Login</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php foreach ($users as $u): ?>
                            <tr class="hover:bg-gray-700/50">
                                <td class="px-4 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-white"><?php echo htmlspecialchars($u['full_name']); ?></div>
                                        <div class="text-sm text-gray-400"><?php echo htmlspecialchars($u['email']); ?></div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        <?php echo $u['role'] === 'admin' ? 'bg-purple-900 text-purple-200' : 'bg-blue-900 text-blue-200'; ?>">
                                        <?php echo ucfirst($u['role']); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        <?php echo $u['is_banned'] ? 'bg-red-900 text-red-200' : 'bg-green-900 text-green-200'; ?>">
                                        <?php echo $u['is_banned'] ? 'Banned' : 'Active'; ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-white">
                                    <?php echo number_format($u['tokens_remaining']); ?>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-300">
                                    <?php echo date('M j, Y', strtotime($u['registration_date'])); ?>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-300">
                                    <?php echo $u['last_login'] ? date('M j, Y g:i A', strtotime($u['last_login'])) : 'Never'; ?>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="assign_token.php?user_id=<?php echo $u['id']; ?>"
                                           class="text-blue-400 hover:text-blue-300 transition-colors"
                                           title="Assign Tokens">
                                            <i class="fas fa-coins"></i>
                                        </a>
                                        <?php if ($u['role'] !== 'admin'): ?>
                                            <a href="block_user.php?id=<?php echo $u['id']; ?>&action=<?php echo $u['is_banned'] ? 'unban' : 'ban'; ?>"
                                               class="text-<?php echo $u['is_banned'] ? 'green' : 'yellow'; ?>-400 hover:text-<?php echo $u['is_banned'] ? 'green' : 'yellow'; ?>-300 transition-colors"
                                               title="<?php echo $u['is_banned'] ? 'Unban' : 'Ban'; ?> User">
                                                <i class="fas fa-<?php echo $u['is_banned'] ? 'check' : 'ban'; ?>"></i>
                                            </a>
                                            <a href="delete_user.php?id=<?php echo $u['id']; ?>"
                                               class="text-red-400 hover:text-red-300 transition-colors"
                                               title="Delete User"
                                               onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (empty($users)): ?>
                <div class="text-center py-8">
                    <i class="fas fa-users text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">No users found matching the criteria.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
            <?php
            try {
                // Total users
                $stmt = $db->prepare("SELECT COUNT(*) as total FROM users");
                $stmt->execute();
                $totalUsers = $stmt->fetch()['total'];

                // Active users
                $stmt = $db->prepare("SELECT COUNT(*) as total FROM users WHERE is_banned = 0");
                $stmt->execute();
                $activeUsers = $stmt->fetch()['total'];

                // Banned users
                $stmt = $db->prepare("SELECT COUNT(*) as total FROM users WHERE is_banned = 1");
                $stmt->execute();
                $bannedUsers = $stmt->fetch()['total'];

                // Admin users
                $stmt = $db->prepare("SELECT COUNT(*) as total FROM users WHERE role = 'admin'");
                $stmt->execute();
                $adminUsers = $stmt->fetch()['total'];
            } catch (Exception $e) {
                $totalUsers = $activeUsers = $bannedUsers = $adminUsers = 0;
            }
            ?>
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-users text-blue-400"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Total Users</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($totalUsers); ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Active Users</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($activeUsers); ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-ban text-red-400"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Banned Users</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($bannedUsers); ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crown text-purple-400"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Admin Users</p>
                        <p class="text-2xl font-bold text-white"><?php echo number_format($adminUsers); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
