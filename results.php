<?php
require_once 'config.php';
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
                    <h1 class="text-2xl font-bold text-white">Search Results</h1>
                    <p class="text-gray-400">Detailed view of search results</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="history.php" 
                       class="bg-gray-800 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-700 hover:text-white transition-all">
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
        <main class="p-6">
            <!-- Search Info Card -->
            <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-info-circle text-cyber-blue mr-2"></i>
                        Search Information
                    </h3>
                    <div class="flex items-center space-x-3">
                        <a href="export.php?id=<?php echo $search_id; ?>&format=html" 
                           class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-4 py-2 rounded-lg hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all">
                            <i class="fas fa-download mr-2"></i>Export HTML
                        </a>
                        <a href="export.php?id=<?php echo $search_id; ?>&format=csv" 
                           class="bg-gradient-to-r from-cyber-purple to-cyber-red text-white px-4 py-2 rounded-lg hover:from-cyber-purple/80 hover:to-cyber-red/80 transition-all">
                            <i class="fas fa-file-csv mr-2"></i>Export CSV
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Search Query</div>
                        <div class="text-white font-semibold break-all"><?php echo htmlspecialchars($search['query']); ?></div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Search Type</div>
                        <div class="text-white font-semibold"><?php echo ucfirst($search['search_type']); ?></div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Total Results</div>
                        <div class="text-cyber-green font-semibold text-xl"><?php echo number_format($search['results_count']); ?></div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-sm text-gray-400 mb-1">Tokens Used</div>
                        <div class="text-cyber-purple font-semibold text-xl"><?php echo number_format($search['tokens_used']); ?></div>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <?php if (empty($results['List']) || (count($results['List']) === 1 && isset($results['List']['No results found']))): ?>
                <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-12 border border-gray-800 text-center">
                    <i class="fas fa-search text-gray-600 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-400 mb-4">No Results Found</h3>
                    <p class="text-gray-500 mb-6">No data breaches or leaked information found for this query.</p>
                    <a href="search.php" 
                       class="inline-block bg-cyber-blue text-white px-6 py-3 rounded-lg hover:bg-cyber-blue/80 transition-colors">
                        <i class="fas fa-search mr-2"></i>Try Another Search
                    </a>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($results['List'] as $database => $data): ?>
                        <?php if ($database === 'No results found') continue; ?>
                        
                        <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                            <div class="bg-gradient-to-r from-cyber-blue to-cyber-purple px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-white flex items-center">
                                            <i class="fas fa-database mr-3"></i>
                                            <?php echo htmlspecialchars($database); ?>
                                        </h3>
                                        <?php if (isset($data['InfoLeak'])): ?>
                                            <p class="text-blue-100 mt-2"><?php echo htmlspecialchars($data['InfoLeak']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                        <div class="bg-white/20 text-white px-4 py-2 rounded-full">
                                            <i class="fas fa-list mr-2"></i>
                                            <?php echo count($data['Data']); ?> records
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <?php foreach ($data['Data'] as $index => $record): ?>
                                            <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h4 class="text-lg font-semibold text-white flex items-center">
                                                        <i class="fas fa-file-alt text-cyber-green mr-2"></i>
                                                        Record #<?php echo $index + 1; ?>
                                                    </h4>
                                                    <span class="bg-cyber-green/20 text-cyber-green px-3 py-1 rounded-full text-sm">
                                                        <?php echo count($record); ?> fields
                                                    </span>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                    <?php foreach ($record as $field => $value): ?>
                                                        <div class="bg-gray-700/50 rounded-lg p-4">
                                                            <div class="text-xs text-gray-400 uppercase tracking-wide mb-2">
                                                                <i class="fas fa-tag mr-1"></i>
                                                                <?php echo htmlspecialchars($field); ?>
                                                            </div>
                                                            <div class="text-white font-medium break-all">
                                                                <?php echo htmlspecialchars($value); ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Add copy functionality to field values
            const fieldValues = document.querySelectorAll('.text-white.font-medium');
            fieldValues.forEach(element => {
                element.style.cursor = 'pointer';
                element.title = 'Click to copy';
                
                element.addEventListener('click', function() {
                    const text = this.textContent;
                    navigator.clipboard.writeText(text).then(() => {
                        // Show temporary feedback
                        const originalText = this.textContent;
                        this.textContent = 'Copied!';
                        this.style.color = '#00ff41';
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.style.color = '#ffffff';
                        }, 1000);
                    });
                });
            });
            
            // Add hover effects to records
            const records = document.querySelectorAll('.bg-gray-800\\/50');
            records.forEach(record => {
                record.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 10px 25px rgba(0, 255, 65, 0.1)';
                });
                
                record.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
</body>
</html>
