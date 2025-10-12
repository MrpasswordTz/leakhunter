<?php
require_once '../includes/config.php';
requireLogin();
requireAdmin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

// Dashboard statistics
try {
    $db = Database::getInstance()->getConnection();

    // Total users
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM users");
    $stmt->execute();
    $totalUsers = $stmt->fetch()['total'];

    // Active users
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM users WHERE is_banned = 0");
    $stmt->execute();
    $activeUsers = $stmt->fetch()['total'];

    // Total searches
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM search_history");
    $stmt->execute();
    $totalSearches = $stmt->fetch()['total'];

    // Monthly searches
    $stmt = $db->prepare("SELECT COUNT(*) as total FROM search_history WHERE MONTH(created_at)=MONTH(CURRENT_DATE()) AND YEAR(created_at)=YEAR(CURRENT_DATE())");
    $stmt->execute();
    $monthlySearches = $stmt->fetch()['total'];

    // Total tokens used
    $stmt = $db->prepare("SELECT SUM(tokens_used) as total FROM search_history");
    $stmt->execute();
    $totalTokensUsed = $stmt->fetch()['total'] ?? 0;

    // Recent searches
    $stmt = $db->prepare("
        SELECT sh.query, sh.results_count, sh.created_at, u.full_name
        FROM search_history sh
        JOIN users u ON sh.user_id = u.id
        ORDER BY sh.created_at DESC LIMIT 5
    ");
    $stmt->execute();
    $recentSearches = $stmt->fetchAll();

    // Search types
    $stmt = $db->prepare("SELECT search_type, COUNT(*) as count FROM search_history GROUP BY search_type");
    $stmt->execute();
    $searchTypes = $stmt->fetchAll();

    // Daily usage
    $stmt = $db->prepare("
        SELECT DATE(created_at) as date, COUNT(*) as searches, SUM(tokens_used) as tokens
        FROM search_history
        WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)
        GROUP BY DATE(created_at)
        ORDER BY date DESC
    ");
    $stmt->execute();
    $dailyUsage = $stmt->fetchAll();

    // Recent users
    $stmt = $db->prepare("SELECT full_name, email, registration_date FROM users ORDER BY registration_date DESC LIMIT 5");
    $stmt->execute();
    $recentUsers = $stmt->fetchAll();

} catch (Exception $e) {
    error_log("Dashboard error: " . $e->getMessage());
    $totalUsers = $activeUsers = $totalSearches = $monthlySearches = $totalTokensUsed = 0;
    $recentSearches = $searchTypes = $dailyUsage = $recentUsers = [];
}

// Log activity
logActivity($user['id'], 'dashboard_view', 'Viewed dashboard');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LeakHunter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 px-6 py-4 flex justify-between items-center relative">
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-gray-400">Welcome back, <?php echo htmlspecialchars($user['full_name']); ?></p>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profileDropdownBtn" class="flex items-center space-x-3 bg-gray-700 hover:bg-gray-600 px-3 py-2 rounded-lg transition-all">
                    <div class="w-9 h-9 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span class="hidden sm:block font-medium"><?php echo htmlspecialchars($user['full_name']); ?></span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg hidden">
                    <a href="profile.php" class="block px-4 py-2 hover:bg-gray-700 transition-all text-sm">
                        <i class="fas fa-user-cog mr-2 text-blue-400"></i> Edit Profile
                    </a>
                    <a href="logout.php" class="block px-4 py-2 hover:bg-gray-700 transition-all text-sm text-red-400">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6 flex-grow">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card: Users -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-blue-500 transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">Total Users</p>
                            <h2 class="text-3xl font-bold text-blue-400 mt-2"><?php echo number_format($totalUsers); ?></h2>
                            <p class="text-sm text-gray-400 mt-1"><i class="fas fa-user-check text-green-400"></i> <?php echo $activeUsers; ?> active</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card: Searches -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-green-500 transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">Total Searches</p>
                            <h2 class="text-3xl font-bold text-green-400 mt-2"><?php echo number_format($totalSearches); ?></h2>
                            <p class="text-sm text-gray-400 mt-1"><i class="fas fa-arrow-up text-green-400"></i> <?php echo $monthlySearches; ?> this month</p>
                        </div>
                        <div class="w-12 h-12 bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card: Tokens -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">Tokens Used</p>
                            <h2 class="text-3xl font-bold text-purple-400 mt-2"><?php echo number_format($totalTokensUsed); ?></h2>
                            <p class="text-sm text-gray-400 mt-1"><i class="fas fa-chart-line"></i> System-wide</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card: Status -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-green-500 transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">System Status</p>
                            <h2 class="text-3xl font-bold text-green-400 mt-2">Online</h2>
                            <p class="text-sm text-gray-400 mt-1"><i class="fas fa-circle text-green-400"></i> Operational</p>
                        </div>
                        <div class="w-12 h-12 bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-server text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <h3 class="font-semibold mb-4 flex items-center"><i class="fas fa-chart-pie text-blue-400 mr-2"></i>Search Types</h3>
                    <canvas id="searchTypesChart" height="200"></canvas>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <h3 class="font-semibold mb-4 flex items-center"><i class="fas fa-chart-bar text-green-400 mr-2"></i>Daily Usage</h3>
                    <canvas id="dailyUsageChart" height="200"></canvas>
                </div>
            </div>

            <!-- Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Searches -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <h3 class="font-semibold mb-4 flex items-center"><i class="fas fa-history text-purple-400 mr-2"></i>Recent Searches</h3>
                    <?php if (empty($recentSearches)): ?>
                        <p class="text-gray-400 text-center py-6">No recent searches</p>
                    <?php else: ?>
                        <ul class="space-y-3">
                            <?php foreach ($recentSearches as $s): ?>
                                <li class="bg-gray-700 p-3 rounded-lg flex justify-between items-center">
                                    <div>
                                        <p class="text-white font-medium"><?php echo htmlspecialchars($s['query']); ?></p>
                                        <p class="text-sm text-gray-400"><?php echo $s['results_count']; ?> results • by <?php echo htmlspecialchars($s['full_name']); ?></p>
                                    </div>
                                    <span class="text-xs text-gray-400"><?php echo date('M j, g:i A', strtotime($s['created_at'])); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Recent Users -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <h3 class="font-semibold mb-4 flex items-center"><i class="fas fa-user-plus text-green-400 mr-2"></i>Recent Users</h3>
                    <?php if (empty($recentUsers)): ?>
                        <p class="text-gray-400 text-center py-6">No new users</p>
                    <?php else: ?>
                        <ul class="space-y-3">
                            <?php foreach ($recentUsers as $u): ?>
                                <li class="bg-gray-700 p-3 rounded-lg flex justify-between items-center">
                                    <div>
                                        <p class="text-white font-medium"><?php echo htmlspecialchars($u['full_name']); ?></p>
                                        <p class="text-sm text-gray-400"><?php echo htmlspecialchars($u['email']); ?></p>
                                    </div>
                                    <span class="text-xs text-gray-400"><?php echo date('M j, Y', strtotime($u['registration_date'])); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Dropdown toggle
        document.getElementById('profileDropdownBtn').addEventListener('click', () => {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!e.target.closest('#profileDropdownBtn')) {
                document.getElementById('profileDropdown').classList.add('hidden');
            }
        });

        // Charts
        const searchData = <?php echo json_encode($searchTypes); ?>;
        new Chart(document.getElementById('searchTypesChart'), {
            type: 'doughnut',
            data: {
                labels: searchData.map(i => i.search_type),
                datasets: [{
                    data: searchData.map(i => i.count),
                    backgroundColor: ['#10B981', '#3B82F6', '#8B5CF6', '#F59E0B', '#EF4444'],
                    borderWidth: 2
                }]
            },
            options: { plugins: { legend: { labels: { color: 'white' }}}}
        });

        const dailyData = <?php echo json_encode($dailyUsage); ?>;
        new Chart(document.getElementById('dailyUsageChart'), {
            type: 'line',
            data: {
                labels: dailyData.map(i => i.date).reverse(),
                datasets: [
                    { label: 'Searches', data: dailyData.map(i => i.searches).reverse(), borderColor: '#10B981', tension: 0.3, fill: true },
                    { label: 'Tokens', data: dailyData.map(i => i.tokens).reverse(), borderColor: '#3B82F6', tension: 0.3, fill: true }
                ]
            },
            options: {
                scales: { x: { ticks: { color: 'white' }}, y: { ticks: { color: 'white' }}},
                plugins: { legend: { labels: { color: 'white' }}}
            }
        });
    </script>
</body>
</html>
