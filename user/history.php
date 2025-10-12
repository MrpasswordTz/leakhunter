<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$error = '';
$success = '';

// Get search history
try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id, query, search_type, results_count, tokens_used, created_at FROM search_history WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user['id']]);
    $searchHistory = $stmt->fetchAll();
} catch (Exception $e) {
    error_log("History fetch error: " . $e->getMessage());
    $error = 'Failed to load search history.';
    $searchHistory = [];
}

// Log page view
logActivity($user['id'], 'history_page_view', 'Viewed search history page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search History - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>

    <div class="lg:ml-64 min-h-screen p-6">
        <h1 class="text-2xl font-bold mb-4">Search History</h1>

        <?php if ($error): ?>
            <div class="bg-red-800 text-red-200 p-4 rounded mb-4"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-800 text-green-200 p-4 rounded mb-4"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (empty($searchHistory)): ?>
            <div class="bg-gray-800 p-8 rounded text-center">
                <i class="fas fa-history text-gray-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">No Search History</h3>
                <p class="text-gray-400 mb-4">You haven't performed any searches yet.</p>
                <a href="search.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Start Your First Search</a>
            </div>
        <?php else: ?>
            <div class="bg-gray-800 rounded overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Query</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Results</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tokens Used</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php foreach ($searchHistory as $search): ?>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white font-medium"><?php echo htmlspecialchars(substr($search['query'], 0, 50)); ?><?php echo strlen($search['query']) > 50 ? '...' : ''; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <?php echo htmlspecialchars($search['search_type']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo number_format($search['results_count']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo number_format($search['tokens_used']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo date('M j, Y g:i A', strtotime($search['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="results.php?id=<?php echo $search['id']; ?>" class="text-blue-400 hover:text-blue-300 mr-3">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="export.php?id=<?php echo $search['id']; ?>" class="text-green-400 hover:text-green-300 mr-3">
                                            <i class="fas fa-download"></i> Export
                                        </a>
                                        <a href="delete_search.php?id=<?php echo $search['id']; ?>" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this search?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
