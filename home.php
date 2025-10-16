<?php 
$page_title = 'Home - LeakHunter'; 
include 'header.php'; 
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-20 h-20 bg-cyber-green/20 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-32 h-32 bg-cyber-blue/20 rounded-full blur-xl animate-pulse-slow delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-16 h-16 bg-cyber-purple/20 rounded-full blur-xl animate-pulse-slow delay-500"></div>
        <div class="absolute top-3/4 left-1/3 w-24 h-24 bg-cyber-orange/15 rounded-full blur-xl animate-pulse-slow delay-1500"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(0,255,127,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(0,255,127,0.03)_1px,transparent_1px)] bg-[size:64px_64px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,black,transparent)]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <!-- Main Heading with Typing Effect -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-6xl lg:text-7xl cyber-font text-cyber-green neon-glow mb-4 leading-tight">
                    <span class="block">CYBERSECURITY</span>
                    <span class="block text-cyber-blue typing-animation">INTELLIGENCE</span>
                    <span class="block">PLATFORM</span>
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mb-6 rounded-full"></div>
            </div>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto leading-relaxed">
                Advanced data breach monitoring and leak detection system.
                <span class="text-cyber-green">Protect your digital assets</span> with cutting-edge cybersecurity technology.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                <a href="register.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                    <span class="relative z-10 flex items-center justify-center">
                        <i class="fas fa-rocket mr-2"></i>
                        GET STARTED FREE
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="services.php" class="group border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg transform hover:-translate-y-1 flex items-center justify-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    VIEW SERVICES
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-gray-400 tech-font text-sm">
                <div class="flex items-center">
                    <i class="fas fa-shield-check text-cyber-green mr-2"></i>
                    <span>Military-Grade Encryption</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-bolt text-cyber-blue mr-2"></i>
                    <span>Real-Time Monitoring</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-globe text-cyber-purple mr-2"></i>
                    <span>Global Threat Intelligence</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#features" class="text-cyber-green hover:text-cyber-blue transition-colors">
            <i class="fas fa-chevron-down text-2xl"></i>
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                ADVANCED FEATURES
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Comprehensive cybersecurity tools designed for modern digital protection
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3 group-hover:text-cyber-blue transition-colors duration-300">INTELLIGENT SEARCH</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Advanced search algorithms to detect data breaches across multiple sources with high accuracy and speed.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-blue mb-3 group-hover:text-cyber-purple transition-colors duration-300">REAL-TIME MONITORING</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Continuous monitoring of dark web and public databases for potential data exposures and threats.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-purple mb-3 group-hover:text-cyber-orange transition-colors duration-300">DETAILED REPORTS</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Comprehensive reports with actionable insights and recommendations for security improvements.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-orange/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-orange/20">
                    <i class="fas fa-lock text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-orange mb-3 group-hover:text-cyber-yellow transition-colors duration-300">ENCRYPTED STORAGE</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    All data is encrypted using military-grade AES-256 encryption for maximum security and privacy.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-yellow/30 rounded-xl p-6 hover:border-cyber-yellow/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-yellow/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-yellow to-cyber-green rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-yellow/20">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-yellow mb-3 group-hover:text-cyber-green transition-colors duration-300">TEAM COLLABORATION</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Multi-user support with role-based access control for efficient team security management.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                    <i class="fas fa-bell text-white text-xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3 group-hover:text-cyber-blue transition-colors duration-300">ALERT SYSTEM</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Instant notifications for new threats and vulnerabilities affecting your organization.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-cyber-dark/80 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,rgba(0,255,127,0.02)_50%,transparent_75%,transparent_100%)] bg-[length:10px_10px]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">10M+</div>
                <div class="text-gray-400 tech-font text-sm">RECORDS SCANNED</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-blue neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">99.9%</div>
                <div class="text-gray-400 tech-font text-sm">ACCURACY RATE</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-purple neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">24/7</div>
                <div class="text-gray-400 tech-font text-sm">MONITORING</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl cyber-font text-cyber-orange neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">500+</div>
                <div class="text-gray-400 tech-font text-sm">ENTERPRISES</div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-cyber-gray/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                HOW IT WORKS
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Simple three-step process to secure your digital assets
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-cyber-green rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3">REGISTER ACCOUNT</h3>
                <p class="text-gray-400 tech-font text-sm">Create your free account and get 9 trial tokens to start scanning</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-cyber-blue rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                </div>
                <h3 class="text-xl cyber-font text-cyber-blue mb-3">SCAN FOR BREACHES</h3>
                <p class="text-gray-400 tech-font text-sm">Use tokens to search for email addresses, phone numbers, and domains</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                        <i class="fas fa-shield-check text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-cyber-purple rounded-full flex items-center justify-center text-white text-sm font-bold">3</div>
                </div>
                <h3 class="text-xl cyber-font text-cyber-purple mb-3">GET PROTECTED</h3>
                <p class="text-gray-400 tech-font text-sm">Receive detailed reports and take action to secure your data</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-cyber-dark via-cyber-gray to-cyber-dark relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-cyber-green to-transparent animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-full h-1 bg-gradient-to-r from-transparent via-cyber-blue to-transparent animate-pulse delay-1000"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
            READY TO SECURE YOUR DATA?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8 max-w-2xl mx-auto">
            Join thousands of organizations protecting their digital assets with LeakHunter's advanced cybersecurity platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="register.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-play-circle mr-2"></i>
                    START FREE TRIAL
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            <a href="contact.php" class="group border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-comments mr-2"></i>
                CONTACT SALES
            </a>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-8 text-gray-400 tech-font text-sm">
            <p>✓ No credit card required • ✓ 9 free trial tokens • ✓ Setup in 2 minutes</p>
        </div>
    </div>
</section>

<!-- Custom CSS for Animations -->
<style>
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .typing-animation {
        overflow: hidden;
        border-right: 2px solid #00ff7f;
        white-space: nowrap;
        margin: 0 auto;
        animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
    }
    
    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }
    
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: #00ff7f }
    }
</style>

<?php include 'footer.php'; ?>