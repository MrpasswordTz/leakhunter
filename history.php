<?php
require_once 'config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

// Handle success/error messages
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';

// Pagination
$page = (int)($_GET['page'] ?? 1);
$limit = 20;
$offset = ($page - 1) * $limit;

// Filter parameters
$search_type = sanitizeInput($_GET['search_type'] ?? '');
$date_from = sanitizeInput($_GET['date_from'] ?? '');
$date_to = sanitizeInput($_GET['date_to'] ?? '');

try {
    $db = Database::getInstance()->getConnection();
    
    // Build query with filters
    $where_conditions = ["user_id = ?"];
    $params = [$user['id']];
    
    if (!empty($search_type)) {
        $where_conditions[] = "search_type = ?";
        $params[] = $search_type;
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
    $count_sql = "SELECT COUNT(*) as total FROM search_history WHERE $where_clause";
    $stmt = $db->prepare($count_sql);
    $stmt->execute($params);
    $total_searches = $stmt->fetch()['total'];
    $total_pages = ceil($total_searches / $limit);
    
    // Get search history with pagination
    $sql = "SELECT * FROM search_history WHERE $where_clause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $searches = $stmt->fetchAll();
    
    // Get search statistics
    $stmt = $db->prepare("
        SELECT 
            COUNT(*) as total_searches,
            COALESCE(SUM(results_count), 0) as total_results,
            COALESCE(SUM(tokens_used), 0) as total_tokens,
            COALESCE(AVG(results_count), 0) as avg_results
        FROM search_history 
        WHERE user_id = ?
    ");
    $stmt->execute([$user['id']]);
    $stats = $stmt->fetch();
    
    // Get search types distribution
    $stmt = $db->prepare("
        SELECT search_type, COUNT(*) as count, COALESCE(SUM(tokens_used), 0) as tokens 
        FROM search_history 
        WHERE user_id = ? 
        GROUP BY search_type 
        ORDER BY count DESC
    ");
    $stmt->execute([$user['id']]);
    $type_stats = $stmt->fetchAll();
    
} catch (Exception $e) {
    error_log("History error: " . $e->getMessage());
    $searches = [];
    $total_searches = 0;
    $total_pages = 0;
    $stats = ['total_searches' => 0, 'total_results' => 0, 'total_tokens' => 0, 'avg_results' => 0];
    $type_stats = [];
}

// Log page view
logActivity($user['id'], 'history_view', 'Viewed search history');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search History - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber-dark': '#0a0a0a',
                        'cyber-gray': '#1a1a1a',
                        'cyber-green': '#00ff41',
                        'cyber-red': '#ff0040',
                        'cyber-blue': '#0080ff',
                        'cyber-purple': '#8000ff'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cyber-dark min-h-screen">
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-cyber-gray/80 backdrop-blur-sm border-b border-gray-800 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Search History</h1>
                    <p class="text-gray-400">View and analyze your past searches</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Total Searches</p>
                        <p class="text-lg font-bold text-cyber-blue"><?php echo number_format($stats['total_searches'] ?? 0); ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- History Content -->
        <main class="p-6">
            <!-- Success/Error Messages -->
            <?php if ($success === 'deleted'): ?>
                <div class="mb-6 bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-4 py-3 rounded-lg flex items-center backdrop-blur-sm">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    <span class="font-medium">Search record deleted successfully.</span>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="mb-6 bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-4 py-3 rounded-lg flex items-center backdrop-blur-sm">
                    <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
                    <span class="font-medium">
                        <?php 
                        switch($error) {
                            case 'invalid_id': echo 'Invalid search ID.'; break;
                            case 'invalid_token': echo 'Invalid security token.'; break;
                            case 'not_found': echo 'Search record not found.'; break;
                            case 'delete_failed': echo 'Failed to delete search record.'; break;
                            default: echo 'An error occurred.'; break;
                        }
                        ?>
                    </span>
                </div>
            <?php endif; ?>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-br from-cyber-blue/20 to-cyber-purple/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total Searches</p>
                            <p class="text-2xl font-bold text-cyber-blue mt-2"><?php echo number_format($stats['total_searches'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-cyber-blue/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-cyber-blue"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-cyber-green/20 to-cyber-blue/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total Results</p>
                            <p class="text-2xl font-bold text-cyber-green mt-2"><?php echo number_format($stats['total_results'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-cyber-green/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-database text-cyber-green"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-cyber-purple/20 to-cyber-red/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Tokens Used</p>
                            <p class="text-2xl font-bold text-cyber-purple mt-2"><?php echo number_format($stats['total_tokens'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-cyber-purple/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-coins text-cyber-purple"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-cyber-red/20 to-cyber-green/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Avg Results</p>
                            <p class="text-2xl font-bold text-cyber-red mt-2"><?php echo number_format($stats['avg_results'] ?? 0, 1); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-cyber-red/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-cyber-red"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Type Distribution -->
            <?php if (!empty($type_stats)): ?>
                <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800 mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-pie text-cyber-purple mr-2"></i>
                        Search Types Distribution
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <?php foreach ($type_stats as $type): ?>
                            <div class="bg-gray-800/50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400 capitalize"><?php echo htmlspecialchars($type['search_type']); ?></span>
                                    <span class="text-sm font-bold text-cyber-blue"><?php echo $type['count']; ?></span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?php echo number_format($type['tokens']); ?> tokens
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Filters -->
            <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800 mb-6">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-filter text-cyber-purple mr-2"></i>
                    Filter History
                </h3>
                
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search_type" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-tag mr-2"></i>Search Type
                        </label>
                        <select id="search_type" name="search_type" 
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent">
                            <option value="">All Types</option>
                            <option value="email" <?php echo $search_type === 'email' ? 'selected' : ''; ?>>Email</option>
                            <option value="username" <?php echo $search_type === 'username' ? 'selected' : ''; ?>>Username</option>
                            <option value="name" <?php echo $search_type === 'name' ? 'selected' : ''; ?>>Name</option>
                            <option value="phone" <?php echo $search_type === 'phone' ? 'selected' : ''; ?>>Phone</option>
                            <option value="other" <?php echo $search_type === 'other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-calendar mr-2"></i>From Date
                        </label>
                        <input type="date" id="date_from" name="date_from" 
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent"
                               value="<?php echo htmlspecialchars($date_from); ?>">
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-calendar mr-2"></i>To Date
                        </label>
                        <input type="date" id="date_to" name="date_to" 
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent"
                               value="<?php echo htmlspecialchars($date_to); ?>">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white font-semibold py-3 px-6 rounded-lg hover:from-cyber-green/80 hover:to-cyber-blue/80 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:ring-offset-2 focus:ring-offset-cyber-dark transition-all">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Search History Table -->
            <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden shadow-2xl">
                <div class="px-6 py-4 border-b border-gray-800 bg-gradient-to-r from-cyber-gray/50 to-gray-800/50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-history text-cyber-blue mr-2"></i>
                            Search History
                            <?php if ($total_searches > 0): ?>
                                <span class="ml-2 bg-cyber-blue/20 text-cyber-blue px-3 py-1 rounded-full text-sm font-medium">
                                    <?php echo number_format($total_searches); ?> searches
                                </span>
                            <?php endif; ?>
                        </h3>
                        <div class="flex items-center space-x-2">
                            <div class="text-xs text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Click actions to manage your data
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (empty($searches)): ?>
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-r from-cyber-blue/20 to-cyber-purple/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-cyber-blue text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No Search History</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">Your search history will appear here once you start using the LeakHunter system. All your searches and results will be tracked for easy access.</p>
                        <a href="search.php" class="inline-flex items-center bg-gradient-to-r from-cyber-blue to-cyber-purple text-white px-6 py-3 rounded-lg hover:from-cyber-blue/80 hover:to-cyber-purple/80 transition-all font-medium">
                            <i class="fas fa-search mr-2"></i>Start Your First Search
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-800/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-clock mr-2"></i>Date & Time
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-search mr-2"></i>Query
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-2"></i>Type
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-database mr-2"></i>Results
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-coins mr-2"></i>Tokens
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        <i class="fas fa-cog mr-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                <?php foreach ($searches as $search): ?>
                                    <tr class="hover:bg-gray-800/30 transition-all">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">
                                                <?php echo date('M j, Y', strtotime($search['created_at'])); ?>
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                <?php echo date('g:i:s A', strtotime($search['created_at'])); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white font-medium max-w-xs truncate">
                                                <?php echo htmlspecialchars($search['query']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                <?php 
                                                $type = $search['search_type'];
                                                if ($type === 'email') echo 'bg-cyber-blue/20 text-cyber-blue';
                                                elseif ($type === 'username') echo 'bg-cyber-green/20 text-cyber-green';
                                                elseif ($type === 'name') echo 'bg-cyber-purple/20 text-cyber-purple';
                                                elseif ($type === 'phone') echo 'bg-cyber-red/20 text-cyber-red';
                                                else echo 'bg-gray-600/20 text-gray-400';
                                                ?>">
                                                <i class="fas fa-<?php 
                                                    if ($type === 'email') echo 'envelope';
                                                    elseif ($type === 'username') echo 'user';
                                                    elseif ($type === 'name') echo 'id-card';
                                                    elseif ($type === 'phone') echo 'phone';
                                                    else echo 'search';
                                                ?> mr-1"></i>
                                                <?php echo ucfirst($type); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white font-semibold">
                                                <?php echo number_format($search['results_count']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-cyber-green font-semibold">
                                                <?php echo number_format($search['tokens_used']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <?php if ($search['results_count'] > 0): ?>
                                                    <a href="results.php?id=<?php echo $search['id']; ?>" 
                                                       class="bg-gradient-to-r from-cyber-blue/20 to-cyber-blue/30 text-cyber-blue px-3 py-2 rounded-lg hover:from-cyber-blue/30 hover:to-cyber-blue/40 transition-all text-sm font-medium flex items-center group"
                                                       title="View detailed results">
                                                        <i class="fas fa-eye mr-2 group-hover:scale-110 transition-transform"></i>View
                                                    </a>
                                                    <a href="export.php?id=<?php echo $search['id']; ?>&format=html" 
                                                       class="bg-gradient-to-r from-cyber-green/20 to-cyber-green/30 text-cyber-green px-3 py-2 rounded-lg hover:from-cyber-green/30 hover:to-cyber-green/40 transition-all text-sm font-medium flex items-center group"
                                                       title="Download as HTML report">
                                                        <i class="fas fa-download mr-2 group-hover:scale-110 transition-transform"></i>Export
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-gray-500 text-sm italic">No results</span>
                                                <?php endif; ?>
                                                <button onclick="confirmDelete(<?php echo $search['id']; ?>, '<?php echo htmlspecialchars($search['query']); ?>')" 
                                                        class="bg-gradient-to-r from-cyber-red/20 to-cyber-red/30 text-cyber-red px-3 py-2 rounded-lg hover:from-cyber-red/30 hover:to-cyber-red/40 transition-all text-sm font-medium flex items-center group"
                                                        title="Delete this search record">
                                                    <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="px-6 py-4 border-t border-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-400">
                                    Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $total_searches); ?> of <?php echo number_format($total_searches); ?> entries
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?>&search_type=<?php echo urlencode($search_type); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                        <a href="?page=<?php echo $i; ?>&search_type=<?php echo urlencode($search_type); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 rounded-lg transition-all <?php echo $i === $page ? 'bg-cyber-blue text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?>&search_type=<?php echo urlencode($search_type); ?>&date_from=<?php echo urlencode($date_from); ?>&date_to=<?php echo urlencode($date_to); ?>" 
                                           class="px-3 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all">
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
        // Delete confirmation function
        function confirmDelete(searchId, query) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4';
            modal.innerHTML = `
                <div class="bg-cyber-gray/95 backdrop-blur-md rounded-2xl border border-gray-700/50 p-8 max-w-md w-full">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-cyber-red/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-cyber-red text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Confirm Deletion</h3>
                        <p class="text-gray-300 mb-6">Are you sure you want to delete this search record?</p>
                        <div class="bg-gray-800/50 rounded-lg p-3 mb-6">
                            <p class="text-sm text-gray-400">Search Query:</p>
                            <p class="text-cyber-blue font-mono text-sm break-all">${query}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button onclick="this.closest('.fixed').remove()" 
                                    class="flex-1 bg-gray-700 text-gray-300 px-4 py-3 rounded-lg hover:bg-gray-600 transition-all font-medium">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                            <button onclick="deleteSearch(${searchId})" 
                                    class="flex-1 bg-gradient-to-r from-cyber-red to-red-600 text-white px-4 py-3 rounded-lg hover:from-cyber-red/80 hover:to-red-600/80 transition-all font-medium">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        // Delete search function
        function deleteSearch(searchId) {
            const csrfToken = '<?php echo generateCSRFToken(); ?>';
            window.location.href = `delete_search.php?id=${searchId}&token=${csrfToken}`;
        }

        // Add interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 255, 65, 0.1)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Add click effects to action buttons
            const actionButtons = document.querySelectorAll('a, button');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.tagName === 'BUTTON' && this.onclick) return; // Skip delete buttons
                    
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            // Auto-hide success/error messages
            const messages = document.querySelectorAll('.bg-cyber-green\\/20, .bg-cyber-red\\/20');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        message.remove();
                    }, 300);
                }, 5000);
            });

            // Add loading states to export links
            const exportLinks = document.querySelectorAll('a[href*="export.php"]');
            exportLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Preparing...';
                    this.style.pointerEvents = 'none';
                    
                    // Reset after 3 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.pointerEvents = 'auto';
                    }, 3000);
                });
            });
        });
    </script>
</body>
</html>
