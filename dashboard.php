<?php
require_once 'config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

// Get dashboard statistics
try {
    $db = Database::getInstance()->getConnection();
    
    // Total searches
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM search_history WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $totalSearches = $stmt->fetch()['total'];
    
    // Searches this month
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM search_history WHERE user_id = ? AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())");
    $stmt->execute([$user['id']]);
    $monthlySearches = $stmt->fetch()['total'];
    
    // Total tokens used
    $stmt = $db->prepare("SELECT SUM(tokens_used) as total FROM search_history WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $totalTokensUsed = $stmt->fetch()['total'] ?? 0;
    
    // Recent searches
    $stmt = $db->prepare("SELECT query, results_count, created_at FROM search_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
    $stmt->execute([$user['id']]);
    $recentSearches = $stmt->fetchAll();
    
    // Search types distribution
    $stmt = $db->prepare("SELECT search_type, COUNT(*) as count FROM search_history WHERE user_id = ? GROUP BY search_type");
    $stmt->execute([$user['id']]);
    $searchTypes = $stmt->fetchAll();
    
    // Daily usage for last 7 days
    $stmt = $db->prepare("
        SELECT DATE(created_at) as date, COUNT(*) as searches, SUM(tokens_used) as tokens 
        FROM search_history 
        WHERE user_id = ? AND created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)
        GROUP BY DATE(created_at)
        ORDER BY date DESC
    ");
    $stmt->execute([$user['id']]);
    $dailyUsage = $stmt->fetchAll();
    
} catch (Exception $e) {
    error_log("Dashboard error: " . $e->getMessage());
    $totalSearches = $monthlySearches = $totalTokensUsed = 0;
    $recentSearches = $searchTypes = $dailyUsage = [];
}

// Log dashboard view
logActivity($user['id'], 'dashboard_view', 'Viewed dashboard');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                    <p class="text-gray-400">Welcome back, <?php echo htmlspecialchars($user['full_name']); ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Last Login</p>
                        <p class="text-sm text-white"><?php echo $user['last_login'] ? date('M j, Y g:i A', strtotime($user['last_login'])) : 'Never'; ?></p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-cyber-purple to-cyber-blue rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Tokens Remaining -->
                <div class="bg-gradient-to-br from-cyber-green/20 to-cyber-blue/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800 hover:border-cyber-green/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Tokens Remaining</p>
                            <p class="text-3xl font-bold text-cyber-green mt-2"><?php echo number_format($user['tokens_remaining']); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-cyber-green/20 rounded-lg flex items-center justify-center group-hover:bg-cyber-green/30 transition-all">
                            <i class="fas fa-coins text-cyber-green text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-cyber-green to-cyber-blue h-2 rounded-full transition-all duration-1000" 
                                 style="width: <?php echo min(100, ($user['tokens_remaining'] / 100) * 100); ?>%"></div>
                        </div>
                    </div>
                </div>

                <!-- Total Searches -->
                <div class="bg-gradient-to-br from-cyber-blue/20 to-cyber-purple/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800 hover:border-cyber-blue/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total Searches</p>
                            <p class="text-3xl font-bold text-cyber-blue mt-2"><?php echo number_format($totalSearches); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-cyber-blue/20 rounded-lg flex items-center justify-center group-hover:bg-cyber-blue/30 transition-all">
                            <i class="fas fa-search text-cyber-blue text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-arrow-up text-cyber-green mr-1"></i>
                            <?php echo $monthlySearches; ?> this month
                        </p>
                    </div>
                </div>

                <!-- Tokens Used -->
                <div class="bg-gradient-to-br from-cyber-purple/20 to-cyber-red/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800 hover:border-cyber-purple/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Tokens Used</p>
                            <p class="text-3xl font-bold text-cyber-purple mt-2"><?php echo number_format($totalTokensUsed); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-cyber-purple/20 rounded-lg flex items-center justify-center group-hover:bg-cyber-purple/30 transition-all">
                            <i class="fas fa-chart-line text-cyber-purple text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-calculator mr-1"></i>
                            Total consumption
                        </p>
                    </div>
                </div>

                <!-- API Status -->
                <div class="bg-gradient-to-br from-cyber-red/20 to-cyber-green/20 backdrop-blur-sm rounded-xl p-6 border border-gray-800 hover:border-cyber-green/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">API Status</p>
                            <p class="text-3xl font-bold text-cyber-green mt-2">Online</p>
                        </div>
                        <div class="w-12 h-12 bg-cyber-green/20 rounded-lg flex items-center justify-center group-hover:bg-cyber-green/30 transition-all">
                            <i class="fas fa-server text-cyber-green text-xl animate-pulse"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-circle text-cyber-green mr-1"></i>
                            All systems operational
                        </p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Search Types Pie Chart -->
                <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-pie text-cyber-blue mr-2"></i>
                        Search Types Distribution
                    </h3>
                    <div class="h-64 flex items-center justify-center">
                        <canvas id="searchTypesChart" width="200" height="200"></canvas>
                    </div>
                </div>

                <!-- Daily Usage Chart -->
                <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-cyber-green mr-2"></i>
                        Daily Usage (Last 7 Days)
                    </h3>
                    <div class="h-64">
                        <canvas id="dailyUsageChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Searches -->
            <div class="bg-cyber-gray/80 backdrop-blur-sm rounded-xl p-6 border border-gray-800">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-history text-cyber-purple mr-2"></i>
                        Recent Searches
                    </h3>
                    <a href="history.php" class="text-cyber-blue hover:text-cyber-blue/80 transition-colors text-sm font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <?php if (empty($recentSearches)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-search text-gray-600 text-4xl mb-4"></i>
                        <p class="text-gray-400">No searches yet</p>
                        <a href="search.php" class="inline-block mt-4 bg-cyber-blue text-white px-4 py-2 rounded-lg hover:bg-cyber-blue/80 transition-colors">
                            Start Your First Search
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach ($recentSearches as $search): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-all">
                                <div class="flex-1">
                                    <p class="text-white font-medium"><?php echo htmlspecialchars($search['query']); ?></p>
                                    <p class="text-gray-400 text-sm">
                                        <?php echo $search['results_count']; ?> results found
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-400 text-sm">
                                        <?php echo date('M j, g:i A', strtotime($search['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Search Types Pie Chart
        const searchTypesData = <?php echo json_encode($searchTypes); ?>;
        const searchTypesLabels = searchTypesData.map(item => item.search_type);
        const searchTypesCounts = searchTypesData.map(item => item.count);
        
        const searchTypesCtx = document.getElementById('searchTypesChart').getContext('2d');
        new Chart(searchTypesCtx, {
            type: 'doughnut',
            data: {
                labels: searchTypesLabels,
                datasets: [{
                    data: searchTypesCounts,
                    backgroundColor: [
                        '#00ff41',
                        '#0080ff',
                        '#8000ff',
                        '#ff0040',
                        '#ff8000'
                    ],
                    borderColor: '#1a1a1a',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff',
                            padding: 20
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 2000
                }
            }
        });

        // Daily Usage Chart
        const dailyUsageData = <?php echo json_encode($dailyUsage); ?>;
        const dailyLabels = dailyUsageData.map(item => new Date(item.date).toLocaleDateString()).reverse();
        const dailySearches = dailyUsageData.map(item => item.searches).reverse();
        const dailyTokens = dailyUsageData.map(item => item.tokens).reverse();
        
        const dailyUsageCtx = document.getElementById('dailyUsageChart').getContext('2d');
        new Chart(dailyUsageCtx, {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Searches',
                    data: dailySearches,
                    borderColor: '#00ff41',
                    backgroundColor: 'rgba(0, 255, 65, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Tokens Used',
                    data: dailyTokens,
                    borderColor: '#0080ff',
                    backgroundColor: 'rgba(0, 128, 255, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#ffffff'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#ffffff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#ffffff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Add some cyberpunk animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('.bg-gradient-to-br');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
