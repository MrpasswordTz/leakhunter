<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$search_id = (int)($_GET['id'] ?? 0);

if ($search_id <= 0) {
    header('Location: history.php');
    exit();
}

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$search_id, $user['id']]);
    $search = $stmt->fetch();
    
    if (!$search) {
        header('Location: history.php');
        exit();
    }
    
    $results = json_decode($search['results_data'], true);
    
    if (!$results) {
        header('Location: history.php');
        exit();
    }
    
    // Log results view
    logActivity($user['id'], 'results_view', "Viewed detailed results for search: {$search['query']}");
    
} catch (Exception $e) {
    error_log("Results view error: " . $e->getMessage());
    header('Location: history.php');
    exit();
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
    
    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Search Results</h1>
                    <p class="text-gray-400">Detailed view of search results</p>
                </div>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="history.php" 
                       class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600 hover:text-white transition-all flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>Back to History
                    </a>
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Search Date</p>
                        <p class="text-sm text-white"><?php echo date('M j, Y g:i A', strtotime($search['created_at'])); ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Results Content -->
        <main class="p-4 sm:p-6">
            <!-- Search Info Card -->
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Search Information
                    </h3>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="export.php?id=<?php echo $search_id; ?>&format=html" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i>Export HTML
                        </a>
                        <a href="export.php?id=<?php echo $search_id; ?>&format=csv" 
                           class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-all flex items-center justify-center">
                            <i class="fas fa-file-csv mr-2"></i>Export CSV
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Search Query</div>
                        <div class="text-white font-semibold break-all"><?php echo htmlspecialchars($search['query']); ?></div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Search Type</div>
                        <div class="text-white font-semibold"><?php echo ucfirst($search['search_type']); ?></div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Total Results</div>
                        <div class="text-green-400 font-semibold text-xl"><?php echo number_format($search['results_count']); ?></div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Tokens Used</div>
                        <div class="text-purple-400 font-semibold text-xl"><?php echo number_format($search['tokens_used']); ?></div>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <?php if (empty($results['List']) || (count($results['List']) === 1 && isset($results['List']['No results found']))): ?>
                <div class="bg-gray-800 rounded-lg p-8 sm:p-12 border border-gray-700 text-center">
                    <i class="fas fa-search text-gray-600 text-4xl sm:text-6xl mb-4 sm:mb-6"></i>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-400 mb-4">No Results Found</h3>
                    <p class="text-gray-500 mb-6">No data breaches or leaked information found for this query.</p>
                    <a href="search.php" 
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Try Another Search
                    </a>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($results['List'] as $database => $data): ?>
                        <?php if ($database === 'No results found') continue; ?>
                        
                        <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-4 sm:px-6 py-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg sm:text-xl font-bold text-white flex items-center">
                                            <i class="fas fa-database mr-3"></i>
                                            <?php echo htmlspecialchars($database); ?>
                                        </h3>
                                        <?php if (isset($data['InfoLeak'])): ?>
                                            <p class="text-blue-100 mt-2 text-sm"><?php echo htmlspecialchars($data['InfoLeak']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                        <div class="bg-white/20 text-white px-3 py-2 rounded-full text-sm">
                                            <i class="fas fa-list mr-2"></i>
                                            <?php echo count($data['Data']); ?> records
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                <div class="p-4 sm:p-6">
                                    <div class="space-y-4">
                                        <?php foreach ($data['Data'] as $index => $record): ?>
                                            <div class="bg-gray-700 rounded-lg p-4 sm:p-6 border border-gray-600">
                                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
                                                    <h4 class="text-md sm:text-lg font-semibold text-white flex items-center">
                                                        <i class="fas fa-file-alt text-green-400 mr-2"></i>
                                                        Record #<?php echo $index + 1; ?>
                                                    </h4>
                                                    <span class="bg-green-900 text-green-400 px-3 py-1 rounded-full text-sm">
                                                        <?php echo count($record); ?> fields
                                                    </span>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                                                    <?php foreach ($record as $field => $value): ?>
                                                        <div class="bg-gray-600 rounded-lg p-3 sm:p-4">
                                                            <div class="text-xs text-gray-400 uppercase tracking-wide mb-2 flex items-center">
                                                                <i class="fas fa-tag mr-1"></i>
                                                                <?php echo htmlspecialchars($field); ?>
                                                            </div>
                                                            <div class="text-white font-medium break-all text-sm sm:text-base cursor-pointer hover:text-blue-300 transition-colors copy-field" 
                                                                 data-value="<?php echo htmlspecialchars($value); ?>">
                                                                <?php echo htmlspecialchars($value); ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="p-6 text-center">
                                    <p class="text-gray-400">No data available for this database.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Copy Success Notification -->
    <div id="copyNotification" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50">
        <i class="fas fa-check-circle mr-2"></i>
        <span>Copied to clipboard!</span>
    </div>

    <script>
        // Copy functionality with better feedback
        document.addEventListener('DOMContentLoaded', function() {
            const copyFields = document.querySelectorAll('.copy-field');
            const notification = document.getElementById('copyNotification');
            
            copyFields.forEach(field => {
                field.addEventListener('click', async function() {
                    const text = this.getAttribute('data-value');
                    
                    try {
                        await navigator.clipboard.writeText(text);
                        
                        // Show notification
                        notification.classList.remove('translate-y-full');
                        
                        // Hide notification after 2 seconds
                        setTimeout(() => {
                            notification.classList.add('translate-y-full');
                        }, 2000);
                        
                    } catch (err) {
                        console.error('Failed to copy text: ', err);
                        // Fallback for older browsers
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        // Show notification even with fallback
                        notification.classList.remove('translate-y-full');
                        setTimeout(() => {
                            notification.classList.add('translate-y-full');
                        }, 2000);
                    }
                });
            });
            
            // Add hover effects to records
            const records = document.querySelectorAll('.bg-gray-700');
            records.forEach(record => {
                record.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'transform 0.2s ease';
                });
                
                record.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Add loading state to export buttons
            const exportButtons = document.querySelectorAll('a[href*="export.php"]');
            exportButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Preparing...';
                    this.style.pointerEvents = 'none';
                    
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.style.pointerEvents = 'auto';
                    }, 3000);
                });
            });
        });

        // Handle responsive behavior
        function handleResponsive() {
            const cards = document.querySelectorAll('.bg-gray-600');
            if (window.innerWidth < 640) {
                cards.forEach(card => {
                    card.style.minHeight = 'auto';
                });
            }
        }

        // Initial call and event listener
        handleResponsive();
        window.addEventListener('resize', handleResponsive);
    </script>
</body>
</html>
