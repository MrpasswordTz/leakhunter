<?php
require_once 'config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$error = '';
$success = '';
$results = null;
$tokensUsed = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = sanitizeInput($_POST['query'] ?? '');
    $searchType = sanitizeInput($_POST['search_type'] ?? 'other');
    $limit = (int)($_POST['limit'] ?? 100);
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // Verify CSRF token
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } elseif (empty($query)) {
        $error = 'Please enter a search query.';
    } elseif ($user['tokens_remaining'] <= 0) {
        $error = 'You have no tokens remaining. Please contact administrator.';
    } elseif (!checkRateLimit($user['id'], 'search', 10, 3600)) {
        $error = 'Rate limit exceeded. Please wait before making another search.';
    } else {
        try {
            // Calculate tokens needed based on complexity
            $words = array_filter(explode(' ', $query), function($word) {
                return strlen($word) >= 4 && !is_numeric($word) || (is_numeric($word) && strlen($word) >= 6);
            });
            
            $complexity = match(count($words)) {
                1 => 1,
                2 => 5,
                3 => 16,
                default => 40
            };
            
            $tokensNeeded = ceil((5 + sqrt($limit * $complexity)) / 5000 * 1000); // Convert to integer tokens
            
            if ($tokensNeeded > $user['tokens_remaining']) {
                $error = 'Insufficient tokens for this search.';
            } else {
                // Make API request
                $apiData = [
                    'token' => LEAKOSINT_API_TOKEN,
                    'request' => $query,
                    'limit' => $limit,
                    'lang' => 'en',
                    'type' => 'json'
                ];
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, LEAKOSINT_API_URL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiData));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'User-Agent: LeakHunter/1.0'
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($response === false || $httpCode !== 200) {
                    $error = 'API request failed. Please try again later.';
                } else {
                    $apiResponse = json_decode($response, true);
                    
                    if (isset($apiResponse['Error code'])) {
                        $error = 'API Error: ' . $apiResponse['Error code'];
                    } else {
                        $results = $apiResponse;
                        $tokensUsed = $tokensNeeded;
                        
                        // Update user tokens
                        $db = Database::getInstance()->getConnection();
                        $stmt = $db->prepare("UPDATE users SET tokens_remaining = tokens_remaining - ? WHERE id = ?");
                        $stmt->execute([$tokensUsed, $user['id']]);
                        
                        // Save search history with results data
                        $resultsCount = 0;
                        if (isset($results['List'])) {
                            foreach ($results['List'] as $database => $data) {
                                if ($database !== 'No results found' && isset($data['Data'])) {
                                    $resultsCount += count($data['Data']);
                                }
                            }
                        }
                        
                        $stmt = $db->prepare("INSERT INTO search_history (user_id, query, results_count, tokens_used, search_type, results_data) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$user['id'], $query, $resultsCount, $tokensUsed, $searchType, json_encode($results)]);
                        
                        // Log activity
                        logActivity($user['id'], 'search', "Searched for: $query, Found: $resultsCount results, Tokens used: $tokensUsed");
                        
                        $success = "Search completed successfully. Found $resultsCount results using $tokensUsed tokens.";
                        
                        // Get the search ID for the results link
                        $searchId = $db->lastInsertId();
                        
                        // Refresh user data
                        $user = getUserInfo();
                    }
                }
            }
        } catch (Exception $e) {
            error_log("Search error: " . $e->getMessage());
            $error = 'An error occurred during search. Please try again.';
        }
    }
}

// Log page view
logActivity($user['id'], 'search_page_view', 'Viewed search page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Search - LeakHunter</title>
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
                    <h1 class="text-2xl font-bold text-white">Data Search</h1>
                    <p class="text-gray-400">Search for data breaches and leaked information</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Tokens Available</p>
                        <p class="text-lg font-bold text-cyber-green"><?php echo number_format($user['tokens_remaining']); ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Search Content -->
        <main class="p-6">
            <!-- Search Form -->
            <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800 mb-6">
                <form method="POST" class="space-y-6">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <?php if ($error): ?>
                        <div class="bg-cyber-red/20 border border-cyber-red/50 text-cyber-red px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="bg-cyber-green/20 border border-cyber-green/50 text-cyber-green px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <label for="query" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-search mr-2"></i>Search Query
                            </label>
                            <textarea id="query" name="query" rows="3" required
                                      class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent transition-all resize-none"
                                      placeholder="Enter email, username, name, phone number, or any search term..."><?php echo htmlspecialchars($query ?? ''); ?></textarea>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Use double quotes for exact phrase searches
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="search_type" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-tag mr-2"></i>Search Type
                                </label>
                                <select id="search_type" name="search_type" 
                                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent">
                                    <option value="email" <?php echo ($searchType ?? '') === 'email' ? 'selected' : ''; ?>>Email</option>
                                    <option value="username" <?php echo ($searchType ?? '') === 'username' ? 'selected' : ''; ?>>Username</option>
                                    <option value="name" <?php echo ($searchType ?? '') === 'name' ? 'selected' : ''; ?>>Name</option>
                                    <option value="phone" <?php echo ($searchType ?? '') === 'phone' ? 'selected' : ''; ?>>Phone</option>
                                    <option value="other" <?php echo ($searchType ?? '') === 'other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="limit" class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-sliders-h mr-2"></i>Search Limit
                                </label>
                                <select id="limit" name="limit" 
                                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:border-transparent">
                                    <option value="100" <?php echo ($limit ?? 100) === 100 ? 'selected' : ''; ?>>100 (0.003$)</option>
                                    <option value="500" <?php echo ($limit ?? 100) === 500 ? 'selected' : ''; ?>>500 (0.007$)</option>
                                    <option value="1000" <?php echo ($limit ?? 100) === 1000 ? 'selected' : ''; ?>>1000 (0.010$)</option>
                                    <option value="5000" <?php echo ($limit ?? 100) === 5000 ? 'selected' : ''; ?>>5000 (0.022$)</option>
                                    <option value="10000" <?php echo ($limit ?? 100) === 10000 ? 'selected' : ''; ?>>10000 (0.032$)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-400">
                            <i class="fas fa-calculator mr-1"></i>
                            Estimated tokens: <span id="estimated-tokens" class="text-cyber-green font-medium">Calculating...</span>
                        </div>
                        <button type="submit" 
                                class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white font-semibold py-3 px-8 rounded-lg hover:from-cyber-green/80 hover:to-cyber-blue/80 focus:outline-none focus:ring-2 focus:ring-cyber-blue focus:ring-offset-2 focus:ring-offset-cyber-dark transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                                <?php echo $user['tokens_remaining'] <= 0 ? 'disabled' : ''; ?>>
                            <i class="fas fa-search mr-2"></i>Search Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <?php if ($results): ?>
                <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-database text-cyber-blue mr-2"></i>
                            Search Results
                        </h3>
                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-coins text-cyber-green mr-1"></i>
                                Tokens used: <span class="text-cyber-green font-medium"><?php echo $tokensUsed; ?></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="results.php?id=<?php echo $searchId; ?>" 
                                   class="bg-gradient-to-r from-cyber-blue to-cyber-purple text-white px-4 py-2 rounded-lg hover:from-cyber-blue/80 hover:to-cyber-purple/80 transition-all text-sm">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                                <a href="export.php?id=<?php echo $searchId; ?>&format=html" 
                                   class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-4 py-2 rounded-lg hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all text-sm">
                                    <i class="fas fa-download mr-2"></i>Export HTML
                                </a>
                                <a href="export.php?id=<?php echo $searchId; ?>&format=csv" 
                                   class="bg-gradient-to-r from-cyber-purple to-cyber-red text-white px-4 py-2 rounded-lg hover:from-cyber-purple/80 hover:to-cyber-red/80 transition-all text-sm">
                                    <i class="fas fa-file-csv mr-2"></i>Export CSV
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($results['List'])): ?>
                        <div class="space-y-6">
                            <?php foreach ($results['List'] as $database => $data): ?>
                                <?php if ($database === 'No results found'): ?>
                                    <div class="text-center py-8">
                                        <i class="fas fa-search text-gray-600 text-4xl mb-4"></i>
                                        <p class="text-gray-400 text-lg">No results found</p>
                                        <p class="text-gray-500 text-sm">Try adjusting your search terms or search type</p>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-gray-800/50 rounded-lg p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="text-lg font-semibold text-white flex items-center">
                                                <i class="fas fa-database text-cyber-green mr-2"></i>
                                                <?php echo htmlspecialchars($database); ?>
                                            </h4>
                                            <span class="bg-cyber-blue/20 text-cyber-blue px-3 py-1 rounded-full text-sm">
                                                <?php echo isset($data['Data']) ? count($data['Data']) : 0; ?> records
                                            </span>
                                        </div>
                                        
                                        <?php if (isset($data['InfoLeak'])): ?>
                                            <p class="text-gray-300 mb-4"><?php echo htmlspecialchars($data['InfoLeak']); ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                            <div class="space-y-3">
                                                <?php foreach ($data['Data'] as $record): ?>
                                                    <div class="bg-gray-700/50 rounded-lg p-4">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                                            <?php foreach ($record as $field => $value): ?>
                                                                <div>
                                                                    <span class="text-xs text-gray-400 uppercase tracking-wide"><?php echo htmlspecialchars($field); ?></span>
                                                                    <p class="text-white font-medium"><?php echo htmlspecialchars($value); ?></p>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script>
        // Calculate estimated tokens
        function calculateTokens() {
            const query = document.getElementById('query').value;
            const limit = parseInt(document.getElementById('limit').value);
            
            if (!query.trim()) {
                document.getElementById('estimated-tokens').textContent = 'Enter a query';
                return;
            }
            
            // Count words (same logic as PHP)
            const words = query.split(' ').filter(word => 
                word.length >= 4 && (!/^\d+$/.test(word) || word.length >= 6)
            );
            
            const complexity = words.length === 1 ? 1 : 
                              words.length === 2 ? 5 : 
                              words.length === 3 ? 16 : 40;
            
            const tokens = Math.ceil((5 + Math.sqrt(limit * complexity)) / 5000 * 1000);
            document.getElementById('estimated-tokens').textContent = tokens;
        }
        
        // Add event listeners
        document.getElementById('query').addEventListener('input', calculateTokens);
        document.getElementById('limit').addEventListener('change', calculateTokens);
        
        // Initial calculation
        calculateTokens();
        
        // Form submission animation
        document.querySelector('form').addEventListener('submit', function() {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
            button.disabled = true;
        });
    </script>
</body>
</html>
