<?php
$current_page = basename($_SERVER['PHP_SELF']);
$user = getUserInfo();
?>

<!-- Mobile menu button -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobile-menu-button" class="bg-cyber-gray/80 backdrop-blur-sm text-white p-3 rounded-lg border border-gray-700 hover:bg-gray-700 transition-all">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Sidebar -->
<div id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-cyber-gray/95 backdrop-blur-sm border-r border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 px-4 border-b border-gray-800">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">LeakHunter</h1>
                <p class="text-xs text-gray-400">User Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-8 px-4">
        <ul class="space-y-2">
            <li>
                <a href="dashboard.php"
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all group <?php echo $current_page === 'dashboard.php' ? 'bg-cyber-blue/20 text-cyber-blue border-r-2 border-cyber-blue' : ''; ?>">
                    <i class="fas fa-tachometer-alt mr-3 text-lg group-hover:text-cyber-blue transition-colors"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="search.php"
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all group <?php echo $current_page === 'search.php' ? 'bg-cyber-blue/20 text-cyber-blue border-r-2 border-cyber-blue' : ''; ?>">
                    <i class="fas fa-search mr-3 text-lg group-hover:text-cyber-green transition-colors"></i>
                    <span class="font-medium">Data Search</span>
                </a>
            </li>

            <li>
                <a href="history.php"
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all group <?php echo $current_page === 'history.php' ? 'bg-cyber-blue/20 text-cyber-blue border-r-2 border-cyber-blue' : ''; ?>">
                    <i class="fas fa-history mr-3 text-lg group-hover:text-cyber-purple transition-colors"></i>
                    <span class="font-medium">Search History</span>
                </a>
            </li>

            <li>
                <a href="profile.php"
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-all group <?php echo $current_page === 'profile.php' ? 'bg-cyber-blue/20 text-cyber-blue border-r-2 border-cyber-blue' : ''; ?>">
                    <i class="fas fa-user-cog mr-3 text-lg group-hover:text-cyber-blue transition-colors"></i>
                    <span class="font-medium">Profile</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Info Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-800">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-gradient-to-r from-cyber-purple to-cyber-blue rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate"><?php echo htmlspecialchars($user['full_name']); ?></p>
                <p class="text-xs text-gray-400 truncate"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
        </div>

        <!-- Token Display -->
        <div class="bg-gray-800/50 rounded-lg p-3 mb-4">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-300">Tokens Remaining</span>
                <span class="text-sm font-bold text-cyber-green"><?php echo number_format($user['tokens_remaining']); ?></span>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                <div class="bg-gradient-to-r from-cyber-green to-cyber-blue h-2 rounded-full transition-all duration-500"
                     style="width: <?php echo min(100, ($user['tokens_remaining'] / 9) * 100); ?>%"></div>
            </div>
        </div>

        <!-- Logout Button -->
        <a href="logout.php"
           class="flex items-center justify-center w-full px-4 py-2 bg-cyber-red/20 text-cyber-red rounded-lg hover:bg-cyber-red/30 transition-all group">
            <i class="fas fa-sign-out-alt mr-2 group-hover:animate-pulse"></i>
            <span class="font-medium">Logout</span>
        </a>
    </div>
</div>

<!-- Mobile overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');

    function toggleMobileMenu() {
        sidebar.classList.toggle('-translate-x-full');
        mobileOverlay.classList.toggle('hidden');
    }

    mobileMenuButton.addEventListener('click', toggleMobileMenu);
    mobileOverlay.addEventListener('click', toggleMobileMenu);

    // Close mobile menu on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }
    });

    // Add active state animations
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });

        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>
