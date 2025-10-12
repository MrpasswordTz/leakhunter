<?php
require_once '../includes/config.php';
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
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">User Dashboard</h1>
                    <p class="text-gray-400">Welcome back, <?php echo htmlspecialchars($user['full_name']); ?></p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Last Login</p>
                        <p class="text-sm text-white"><?php echo $user['last_login'] ? date('M j, Y g:i A', strtotime($user['last_login'])) : 'Never'; ?></p>
                    </div>
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
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
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Tokens Remaining</p>
                            <p class="text-3xl font-bold text-green-400 mt-2"><?php echo number_format($user['tokens_remaining']); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-900 rounded-lg flex items-center justify-center group-hover:bg-green-800 transition-all">
                            <i class="fas fa-coins text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full transition-all duration-1000"
                                 style="width: <?php echo min(100, ($user['tokens_remaining'] / 9) * 100); ?>%"></div>
                        </div>
                    </div>
                </div>

                <!-- Total Searches -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total Searches</p>
                            <p class="text-3xl font-bold text-blue-400 mt-2"><?php echo number_format($totalSearches); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-900 rounded-lg flex items-center justify-center group-hover:bg-blue-800 transition-all">
                            <i class="fas fa-search text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-arrow-up text-green-400 mr-1"></i>
                            <?php echo $monthlySearches; ?> this month
                        </p>
                    </div>
                </div>

                <!-- Tokens Used -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Tokens Used</p>
                            <p class="text-3xl font-bold text-purple-400 mt-2"><?php echo number_format($totalTokensUsed); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-purple-900 rounded-lg flex items-center justify-center group-hover:bg-purple-800 transition-all">
                            <i class="fas fa-chart-line text-purple-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-calculator mr-1"></i>
                            Total consumption
                        </p>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-blue-500 transition-all group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Account Status</p>
                            <p class="text-3xl font-bold text-green-400 mt-2">Active</p>
                        </div>
                        <div class="w-12 h-12 bg-green-900 rounded-lg flex items-center justify-center group-hover:bg-green-800 transition-all">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-400">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Trial account
                        </p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Search Types Pie Chart -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-pie text-blue-400 mr-2"></i>
                        Search Types Distribution
                    </h3>
                    <div class="h-64 flex items-center justify-center">
                        <canvas id="searchTypesChart" width="200" height="200"></canvas>
                    </div>
                </div>

                <!-- Daily Usage Chart -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-green-400 mr-2"></i>
                        Daily Usage (Last 7 Days)
                    </h3>
                    <div class="h-64">
                        <canvas id="dailyUsageChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Searches -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-history text-purple-400 mr-2"></i>
                        Recent Searches
                    </h3>
                    <a href="history.php" class="text-blue-400 hover:text-blue-300 transition-colors text-sm font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <?php if (empty($recentSearches)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-search text-gray-600 text-4xl mb-4"></i>
                        <p class="text-gray-400">No searches yet</p>
                        <a href="search.php" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Start Your First Search
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach ($recentSearches as $search): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all">
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
                        '#10B981', // green-400
                        '#60A5FA', // blue-400
                        '#A78BFA', // purple-400
                        '#F87171', // red-400
                        '#FBBF24'  // yellow-400
                    ],
                    borderColor: '#1F2937',
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
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Tokens Used',
                    data: dailyTokens,
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.1)',
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

        // Add animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('.bg-gray-800');
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
