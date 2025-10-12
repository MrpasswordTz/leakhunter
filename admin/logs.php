<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

// Pagination
$page = (int)($_GET['page'] ?? 1);
$limit = 20;
$offset = ($page - 1) * $limit;

// Filter parameters
$action_filter = sanitizeInput($_GET['action'] ?? '');
$date_from = sanitizeInput($_GET['date_from'] ?? '');
$date_to = sanitizeInput($_GET['date_to'] ?? '');

try {
    $db = Database::getInstance()->getConnection();
    
    // Build query with filters
    $where_conditions = ["user_id = ?"];
    $params = [$user['id']];
    
    if (!empty($action_filter)) {
        $where_conditions[] = "action LIKE ?";
        $params[] = "%$action_filter%";
    }
    
    if (!empty($date_from)) {
        $where_conditions[] = "DATE(created_at) >= ?";
        $params[] = $date_from;
    }
    
    if (!empty($date_to)) {
        $where_conditions[] = "DATE(created_at) <= ?";
        $params[] = $date_to;
    }
    
    $where_clause = implode(' AND ', $where_conditions);
    
    // Get total count
    $count_sql = "SELECT COUNT(*) as total FROM activity_logs WHERE $where_clause";
    $stmt = $db->prepare($count_sql);
    $stmt->execute($params);
    $total_logs = $stmt->fetch()['total'];
    $total_pages = ceil($total_logs / $limit);
    
    // Get logs with pagination
    $sql = "SELECT * FROM activity_logs WHERE $where_clause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $logs = $stmt->fetchAll();
    
    // Get unique actions for filter dropdown
    $stmt = $db->prepare("SELECT DISTINCT action FROM activity_logs WHERE user_id = ? ORDER BY action");
    $stmt->execute([$user['id']]);
    $actions = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
} catch (Exception $e) {
    error_log("Logs error: " . $e->getMessage());
    $logs = [];
    $total_logs = 0;
    $total_pages = 0;
    $actions = [];
}

// Log page view
logActivity($user['id'], 'logs_view', 'Viewed activity logs');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Activity Logs</h1>
                    <p class="text-gray-400">Monitor your account activity and security events</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Total Logs</p>
                        <p class="text-lg font-bold text-blue-400"><?php echo number_format($total_logs); ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Logs Content -->
        <main class="p-6">
            <!-- Filters -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 mb-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-filter text-purple-400 mr-2"></i>
                    Filter Logs
                </h3>
                
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="action" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-tag mr-2"></i>Action
                        </label>
                        <select id="action" name="action" 
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Actions</option>
                            <?php foreach ($actions as $action): ?>
                                <option value="<?php echo htmlspecialchars($action); ?>" 
                                        <?php echo $action_filter === $action ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($action); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-calendar mr-2"></i>From Date
                        </label>
                        <input type="date" id="date_from" name="date_from" 
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               value="<?php echo htmlspecialchars($date_from); ?>">
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-calendar mr-2"></i>To Date
                        </label>
                        <input type="date" id="date_to" name="date_to" 
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               value="<?php echo htmlspecialchars($date_to); ?>">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Logs Table -->
            <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-list text-blue-400 mr-2"></i>
                        Activity Logs
                        <?php if ($total_logs > 0): ?>
                            <span class="ml-2 bg-blue-900 text-blue-400 px-2 py-1 rounded-full text-sm">
                                <?php echo number_format($total_logs); ?> entries
                            </span>
                        <?php endif; ?>
                    </h3>
                </div>

                <?php if (empty($logs)): ?>
                    <div class="text-center py-12">
                        <i class="fas fa-clipboard-list text-gray-600 text-4xl mb-4"></i>
                        <p class="text-gray-400 text-lg">No activity logs found</p>
                        <p class="text-gray-500 text-sm">Your activity will appear here once you start using the system</p>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>Timestamp
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-2"></i>Action
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Details
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-globe mr-2"></i>IP Address
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <?php foreach ($logs as $log): ?>
                                    <tr class="hover:bg-gray-700 transition-all">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">
                                                <?php echo date('M j, Y', strtotime($log['created_at'])); ?>
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                <?php echo date('g:i:s A', strtotime($log['created_at'])); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                <?php 
                                                $action = $log['action'];
                                                if (strpos($action, 'login') !== false) echo 'bg-green-900 text-green-400';
                                                elseif (strpos($action, 'logout') !== false) echo 'bg-red-900 text-red-400';
                                                elseif (strpos($action, 'search') !== false) echo 'bg-blue-900 text-blue-400';
                                                elseif (strpos($action, 'profile') !== false) echo 'bg-purple-900 text-purple-400';
                                                else echo 'bg-gray-700 text-gray-400';
                                                ?>">
                                                <i class="fas fa-<?php 
                                                    if (strpos($action, 'login') !== false) echo 'sign-in-alt';
                                                    elseif (strpos($action, 'logout') !== false) echo 'sign-out-alt';
                                                    elseif (strpos($action, 'search') !== false) echo 'search';
                                                    elseif (strpos($action, 'profile') !== false) echo 'user-cog';
                                                    elseif (strpos($action, 'view') !== false) echo 'eye';
                                                    else echo 'circle';
                                                ?> mr-1"></i>
                                                <?php echo htmlspecialchars($log['action']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-300 max-w-md">
                                                <?php echo htmlspecialchars($log['details']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400 font-mono">
                                                <?php echo htmlspecialchars($log['ip_address']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="px-6 py-4 border-t border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-400">
                                    Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $total_logs); ?> of <?php echo number_format($total_logs); ?> entries
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?>&action=<?php echo urlencode($action_filter); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 hover:text-white transition-all">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                        <a href="?page=<?php echo $i; ?>&action=<?php echo urlencode($action_filter); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 rounded-lg transition-all <?php echo $i === $page ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white'; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?>&action=<?php echo urlencode($action_filter); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 hover:text-white transition-all">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-refresh logs every 30 seconds
            setInterval(function() {
                if (document.visibilityState === 'visible') {
                    // Only refresh if no filters are applied to avoid disrupting user
                    const hasFilters = document.getElementById('action').value || 
                                     document.getElementById('date_from').value || 
                                     document.getElementById('date_to').value;
                    if (!hasFilters) {
                        window.location.reload();
                    }
                }
            }, 30000);
            
            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>
