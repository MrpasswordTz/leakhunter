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

$error = '';
$success = '';
$results = null;
$searchInfo = null;

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT query, search_type, results_count, tokens_used, created_at, results_data FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user['id']]);
    $searchInfo = $stmt->fetch();

    if (!$searchInfo) {
        $error = 'Search results not found.';
    } else {
        $results = json_decode($searchInfo['results_data'], true);
        if (!$results) {
            $error = 'Invalid results data.';
        }
    }
} catch (Exception $e) {
    error_log("Results fetch error: " . $e->getMessage());
    $error = 'Failed to load search results.';
}

// Log page view
if ($searchInfo) {
    logActivity($user['id'], 'view_results', "Viewed results for search: {$searchInfo['query']}");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>

    <div class="lg:ml-64 min-h-screen p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Search Results</h1>
                <?php if ($searchInfo): ?>
                    <p class="text-gray-400">Query: <?php echo htmlspecialchars($searchInfo['query']); ?></p>
                    <p class="text-gray-400 text-sm">Date: <?php echo date('M j, Y g:i A', strtotime($searchInfo['created_at'])); ?> | Type: <?php echo htmlspecialchars($searchInfo['search_type']); ?> | Tokens Used: <?php echo number_format($searchInfo['tokens_used']); ?></p>
                <?php endif; ?>
            </div>
            <div class="space-x-2">
                <a href="history.php" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">Back to History</a>
                <?php if ($searchInfo): ?>
                    <a href="export.php?id=<?php echo $id; ?>" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">
                        <i class="fas fa-download mr-2"></i>Export JSON
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-800 text-red-200 p-4 rounded mb-4"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($results && isset($results['List']) && is_array($results['List'])): ?>
            <h2 class="text-xl font-bold mb-4">Results (<?php echo number_format($searchInfo['results_count']); ?> found)</h2>
            <?php foreach ($results['List'] as $dbName => $data): ?>
                <?php if ($dbName === 'No results found'): ?>
                    <div class="bg-gray-800 p-4 rounded mb-4">
                        <p class="text-gray-400">No records found in this database.</p>
                    </div>
                <?php else: ?>
                    <div class="bg-gray-800 p-4 rounded mb-4">
                        <h3 class="font-semibold mb-2"><?php echo htmlspecialchars($dbName); ?></h3>
                        <?php if (isset($data['Data']) && is_array($data['Data'])): ?>
                            <?php foreach ($data['Data'] as $record): ?>
                                <div class="bg-gray-700 p-3 rounded mt-2">
                                    <?php foreach ($record as $field => $value): ?>
                                        <p><strong><?php echo htmlspecialchars($field); ?>:</strong> <?php echo htmlspecialchars($value); ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-400">No records available.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php elseif ($results && !empty($results)): ?>
            <div class="bg-gray-800 p-4 rounded">
                <pre class="text-sm text-gray-300"><?php echo htmlspecialchars(json_encode($results, JSON_PRETTY_PRINT)); ?></pre>
            </div>
        <?php else: ?>
            <div class="bg-gray-800 p-8 rounded text-center">
                <i class="fas fa-search text-gray-600 text-4xl mb-4"></i>
                <p class="text-gray-400">No results to display.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
