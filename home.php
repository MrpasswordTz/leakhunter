<?php $page_title = 'Home - LeakHunter'; include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl cyber-font text-cyber-green neon-glow mb-6">
                CYBERSECURITY<br>
                <span class="text-cyber-blue">INTELLIGENCE</span><br>
                PLATFORM
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto">
                Advanced data breach monitoring and leak detection system.
                Protect your digital assets with cutting-edge cybersecurity technology.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="register.php" class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg shadow-lg hover:shadow-cyber-green/25">
                    GET STARTED FREE
                </a>
                <a href="services.php" class="border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg">
                    VIEW SERVICES
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute top-1/4 left-1/4 w-20 h-20 bg-cyber-green/10 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-32 h-32 bg-cyber-blue/10 rounded-full blur-xl animate-pulse delay-1000"></div>
    <div class="absolute top-1/2 left-1/2 w-16 h-16 bg-cyber-purple/10 rounded-full blur-xl animate-pulse delay-500"></div>
</section>

<!-- Features Section -->
<section class="py-20 bg-cyber-gray/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                ADVANCED FEATURES
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Comprehensive cybersecurity tools designed for modern digital protection
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3">INTELLIGENT SEARCH</h3>
                <p class="text-gray-400 tech-font">
                    Advanced search algorithms to detect data breaches across multiple sources with high accuracy and speed.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-blue mb-3">REAL-TIME MONITORING</h3>
                <p class="text-gray-400 tech-font">
                    Continuous monitoring of dark web and public databases for potential data exposures and threats.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-cyber-dark/50 border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-purple mb-3">DETAILED REPORTS</h3>
                <p class="text-gray-400 tech-font">
                    Comprehensive reports with actionable insights and recommendations for security improvements.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-cyber-dark/50 border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-lock text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-orange mb-3">ENCRYPTED STORAGE</h3>
                <p class="text-gray-400 tech-font">
                    All data is encrypted using military-grade AES-256 encryption for maximum security and privacy.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-cyber-dark/50 border border-cyber-yellow/30 rounded-xl p-6 hover:border-cyber-yellow/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-yellow to-cyber-green rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-yellow mb-3">TEAM COLLABORATION</h3>
                <p class="text-gray-400 tech-font">
                    Multi-user support with role-based access control for efficient team security management.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-bell text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3">ALERT SYSTEM</h3>
                <p class="text-gray-400 tech-font">
                    Instant notifications for new threats and vulnerabilities affecting your organization.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-2">10M+</div>
                <div class="text-gray-400 tech-font">RECORDS SCANNED</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-blue neon-glow mb-2">99.9%</div>
                <div class="text-gray-400 tech-font">ACCURACY RATE</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-purple neon-glow mb-2">24/7</div>
                <div class="text-gray-400 tech-font">MONITORING</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-orange neon-glow mb-2">500+</div>
                <div class="text-gray-400 tech-font">ENTERPRISES</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyber-dark via-cyber-gray to-cyber-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
            READY TO SECURE YOUR DATA?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8">
            Join thousands of organizations protecting their digital assets with LeakHunter.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="register.php" class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg shadow-lg hover:shadow-cyber-green/25">
                START FREE TRIAL
            </a>
            <a href="contact.php" class="border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg">
                CONTACT SALES
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
