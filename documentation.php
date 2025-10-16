<?php 
$page_title = 'Documentation - LeakHunter'; 
include 'header.php'; 
?>

<!-- Hero Section -->
<section class="relative min-h-[40vh] flex items-center justify-center overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-24 h-24 bg-cyber-green/20 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-cyber-blue/20 rounded-full blur-xl animate-pulse-slow delay-1000"></div>
        <div class="absolute top-1/2 left-1/3 w-20 h-20 bg-cyber-purple/15 rounded-full blur-xl animate-pulse-slow delay-500"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(0,255,127,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(0,255,127,0.03)_1px,transparent_1px)] bg-[size:64px_64px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,black,transparent)]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-6xl lg:text-7xl cyber-font text-cyber-green neon-glow mb-6">
            DOCUMENTATION
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto leading-relaxed">
            Complete guide to using LeakHunter's cybersecurity intelligence platform.
            <span class="text-cyber-green">Learn how to protect your organization effectively.</span>
        </p>
        <div class="w-24 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto rounded-full"></div>
    </div>
</section>

<!-- Quick Navigation -->
<section class="py-8 bg-cyber-gray/30 border-b border-cyber-green/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#getting-started" class="tech-font text-cyber-green hover:text-cyber-blue transition-colors duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50">Getting Started</a>
            <a href="#how-it-works" class="tech-font text-cyber-green hover:text-cyber-blue transition-colors duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50">How It Works</a>
            <a href="#user-guide" class="tech-font text-cyber-green hover:text-cyber-blue transition-colors duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50">User Guide</a>
            <a href="#api" class="tech-font text-cyber-green hover:text-cyber-blue transition-colors duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50">API Docs</a>
            <a href="#support" class="tech-font text-cyber-green hover:text-cyber-blue transition-colors duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50">Support</a>
        </div>
    </div>
</section>

<!-- Getting Started -->
<section id="getting-started" class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                GETTING STARTED
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Your journey to enhanced cybersecurity begins here
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 text-center hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                    <span class="text-white text-2xl font-bold cyber-font">1</span>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-3 group-hover:text-cyber-blue transition-colors duration-300">CREATE ACCOUNT</h3>
                <p class="text-gray-300 tech-font mb-4 leading-relaxed">
                    Sign up for a free account and receive 9 trial tokens to explore our platform's capabilities.
                </p>
                <a href="register.php" class="inline-flex items-center text-cyber-blue hover:text-cyber-blue/80 tech-font underline transition-colors duration-300">
                    Register Now <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>

            <!-- Step 2 -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 text-center hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                    <span class="text-white text-2xl font-bold cyber-font">2</span>
                </div>
                <h3 class="text-xl cyber-font text-cyber-blue mb-3 group-hover:text-cyber-purple transition-colors duration-300">PURCHASE TOKENS</h3>
                <p class="text-gray-300 tech-font mb-4 leading-relaxed">
                    Buy tokens to perform unlimited searches. Choose from various packages that suit your needs.
                </p>
                <a href="services.php" class="inline-flex items-center text-cyber-purple hover:text-cyber-purple/80 tech-font underline transition-colors duration-300">
                    View Pricing <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>

            <!-- Step 3 -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 text-center hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                    <span class="text-white text-2xl font-bold cyber-font">3</span>
                </div>
                <h3 class="text-xl cyber-font text-cyber-purple mb-3 group-hover:text-cyber-orange transition-colors duration-300">START SEARCHING</h3>
                <p class="text-gray-300 tech-font mb-4 leading-relaxed">
                    Use our advanced search tools to detect data breaches and security threats in real-time.
                </p>
                <a href="login.php" class="inline-flex items-center text-cyber-orange hover:text-cyber-orange/80 tech-font underline transition-colors duration-300">
                    Login & Search <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                HOW LEAKHUNTER WORKS
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Understanding our comprehensive cybersecurity intelligence system
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="space-y-8">
                <h3 class="text-2xl cyber-font text-cyber-blue mb-6">THE SEARCH PROCESS</h3>
                <div class="space-y-6">
                    <div class="group flex items-start hover:bg-cyber-dark/30 p-4 rounded-lg transition-all duration-300">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mr-4 mt-1 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                            <i class="fas fa-search text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-cyber-green cyber-font mb-2">Input Query</h4>
                            <p class="text-gray-300 tech-font leading-relaxed">
                                Enter email addresses, phone numbers, or other identifiers you want to check for data breaches.
                            </p>
                        </div>
                    </div>

                    <div class="group flex items-start hover:bg-cyber-dark/30 p-4 rounded-lg transition-all duration-300">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mr-4 mt-1 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                            <i class="fas fa-database text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-cyber-blue cyber-font mb-2">Database Scanning</h4>
                            <p class="text-gray-300 tech-font leading-relaxed">
                                Our system scans across multiple data sources including dark web databases, public breach records, and proprietary intelligence feeds.
                            </p>
                        </div>
                    </div>

                    <div class="group flex items-start hover:bg-cyber-dark/30 p-4 rounded-lg transition-all duration-300">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mr-4 mt-1 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                            <i class="fas fa-brain text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-cyber-purple cyber-font mb-2">AI Analysis</h4>
                            <p class="text-gray-300 tech-font leading-relaxed">
                                Advanced algorithms analyze the data to identify patterns, assess risk levels, and provide actionable insights.
                            </p>
                        </div>
                    </div>

                    <div class="group flex items-start hover:bg-cyber-dark/30 p-4 rounded-lg transition-all duration-300">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-full flex items-center justify-center mr-4 mt-1 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-orange/20">
                            <i class="fas fa-chart-bar text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-cyber-orange cyber-font mb-2">Generate Report</h4>
                            <p class="text-gray-300 tech-font leading-relaxed">
                                Receive comprehensive reports with breach details, risk assessments, and security recommendations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <h3 class="text-xl cyber-font text-cyber-green mb-6 flex items-center">
                    <i class="fas fa-list-alt mr-3"></i>
                    SEARCH TYPES
                </h3>
                <div class="space-y-4">
                    <div class="group/item border-l-4 border-cyber-green pl-4 py-2 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                        <h4 class="text-cyber-green cyber-font mb-1 group-hover/item:text-cyber-blue transition-colors duration-300">Email Search</h4>
                        <p class="text-gray-400 tech-font text-sm">Check if an email address has been compromised in data breaches.</p>
                    </div>
                    <div class="group/item border-l-4 border-cyber-blue pl-4 py-2 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                        <h4 class="text-cyber-blue cyber-font mb-1 group-hover/item:text-cyber-purple transition-colors duration-300">Phone Number Search</h4>
                        <p class="text-gray-400 tech-font text-sm">Verify phone numbers against breach databases and fraud indicators.</p>
                    </div>
                    <div class="group/item border-l-4 border-cyber-purple pl-4 py-2 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                        <h4 class="text-cyber-purple cyber-font mb-1 group-hover/item:text-cyber-orange transition-colors duration-300">Domain Search</h4>
                        <p class="text-gray-400 tech-font text-sm">Analyze domain exposure and associated security risks.</p>
                    </div>
                    <div class="group/item border-l-4 border-cyber-orange pl-4 py-2 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                        <h4 class="text-cyber-orange cyber-font mb-1 group-hover/item:text-cyber-yellow transition-colors duration-300">Advanced Filters</h4>
                        <p class="text-gray-400 tech-font text-sm">Use date ranges, breach types, and severity filters for targeted searches.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- User Guide -->
<section id="user-guide" class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyber-orange/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                USER GUIDE
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Step-by-step instructions for using all platform features
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="space-y-8">
            <!-- Dashboard -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                        <i class="fas fa-tachometer-alt text-white"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-green group-hover:text-cyber-blue transition-colors duration-300">Dashboard Overview</h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-cyber-blue cyber-font mb-4 flex items-center">
                            <i class="fas fa-star mr-2"></i>
                            Key Features
                        </h4>
                        <ul class="space-y-3 tech-font text-gray-300">
                            <li class="flex items-start">
                                <i class="fas fa-check text-cyber-green mr-3 mt-1"></i>
                                <span>Token balance and usage statistics</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-cyber-green mr-3 mt-1"></i>
                                <span>Recent search history with quick access</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-cyber-green mr-3 mt-1"></i>
                                <span>Quick search interface for fast queries</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-cyber-green mr-3 mt-1"></i>
                                <span>Account settings and profile management</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-cyber-green mr-3 mt-1"></i>
                                <span>Export options for reports in multiple formats</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-cyber-purple cyber-font mb-4 flex items-center">
                            <i class="fas fa-lightbulb mr-2"></i>
                            Navigation Tips
                        </h4>
                        <ul class="space-y-3 tech-font text-gray-300">
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-cyber-blue mr-3 mt-1"></i>
                                <span>Use sidebar for quick access to all features</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-cyber-blue mr-3 mt-1"></i>
                                <span>Monitor token usage to avoid unexpected depletion</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-cyber-blue mr-3 mt-1"></i>
                                <span>Review search history for patterns and trends</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-cyber-blue mr-3 mt-1"></i>
                                <span>Export important findings regularly for backup</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-cyber-blue mr-3 mt-1"></i>
                                <span>Set up alerts for critical security findings</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search Interface -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-8 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mr-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                        <i class="fas fa-search text-white"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-blue group-hover:text-cyber-purple transition-colors duration-300">Performing Searches</h3>
                </div>
                <div class="space-y-8">
                    <div>
                        <h4 class="text-cyber-green cyber-font mb-4 flex items-center">
                            <i class="fas fa-play mr-2"></i>
                            Basic Search Process
                        </h4>
                        <ol class="list-decimal list-inside space-y-3 tech-font text-gray-300 ml-4">
                            <li class="pb-2">Navigate to the Search page from your dashboard sidebar</li>
                            <li class="pb-2">Enter the email address or phone number you want to investigate</li>
                            <li class="pb-2">Select the appropriate search type (Email, Phone, Domain)</li>
                            <li class="pb-2">Click "Initiate Search" button to begin the scanning process</li>
                            <li class="pb-2">Wait for results (typically completes within 30-60 seconds)</li>
                            <li class="pb-2">Review the comprehensive report and security recommendations</li>
                        </ol>
                    </div>
                    <div>
                        <h4 class="text-cyber-purple cyber-font mb-4 flex items-center">
                            <i class="fas fa-cogs mr-2"></i>
                            Advanced Search Options
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ml-4">
                            <div class="flex items-start">
                                <i class="fas fa-calendar text-cyber-green mr-3 mt-1"></i>
                                <div>
                                    <strong class="text-cyber-green">Date Range:</strong>
                                    <p class="text-gray-300 tech-font text-sm">Filter results by specific breach dates</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-filter text-cyber-blue mr-3 mt-1"></i>
                                <div>
                                    <strong class="text-cyber-blue">Breach Type:</strong>
                                    <p class="text-gray-300 tech-font text-sm">Focus on specific types of breaches</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-cyber-orange mr-3 mt-1"></i>
                                <div>
                                    <strong class="text-cyber-orange">Severity Level:</strong>
                                    <p class="text-gray-300 tech-font text-sm">Show only high-risk findings</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-database text-cyber-purple mr-3 mt-1"></i>
                                <div>
                                    <strong class="text-cyber-purple">Source Filter:</strong>
                                    <p class="text-gray-300 tech-font text-sm">Search specific data sources only</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Interpretation -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-8 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-purple group-hover:text-cyber-orange transition-colors duration-300">Understanding Results</h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-cyber-orange cyber-font mb-4 flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Risk Level Indicators
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-cyber-red/10 border border-cyber-red/30 rounded-lg">
                                <div class="w-4 h-4 bg-cyber-red rounded-full mr-4 animate-pulse"></div>
                                <div>
                                    <span class="tech-font text-cyber-red font-bold">CRITICAL</span>
                                    <p class="text-gray-300 tech-font text-sm">Immediate action required</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-cyber-orange/10 border border-cyber-orange/30 rounded-lg">
                                <div class="w-4 h-4 bg-cyber-orange rounded-full mr-4"></div>
                                <div>
                                    <span class="tech-font text-cyber-orange font-bold">HIGH</span>
                                    <p class="text-gray-300 tech-font text-sm">Address within 24 hours</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-cyber-yellow/10 border border-cyber-yellow/30 rounded-lg">
                                <div class="w-4 h-4 bg-cyber-yellow rounded-full mr-4"></div>
                                <div>
                                    <span class="tech-font text-cyber-yellow font-bold">MEDIUM</span>
                                    <p class="text-gray-300 tech-font text-sm">Monitor and plan mitigation</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-cyber-green/10 border border-cyber-green/30 rounded-lg">
                                <div class="w-4 h-4 bg-cyber-green rounded-full mr-4"></div>
                                <div>
                                    <span class="tech-font text-cyber-green font-bold">LOW</span>
                                    <p class="text-gray-300 tech-font text-sm">No immediate action needed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-cyber-blue cyber-font mb-4 flex items-center">
                            <i class="fas fa-file-alt mr-2"></i>
                            Report Sections
                        </h4>
                        <ul class="space-y-3 tech-font text-gray-300">
                            <li class="flex items-start">
                                <i class="fas fa-list text-cyber-green mr-3 mt-1"></i>
                                <span>Executive Breach Summary</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-database text-cyber-blue mr-3 mt-1"></i>
                                <span>Detailed Exposed Data Types</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-history text-cyber-purple mr-3 mt-1"></i>
                                <span>Timeline of Breach Events</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-lightbulb text-cyber-orange mr-3 mt-1"></i>
                                <span>Actionable Security Recommendations</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-chart-bar text-cyber-yellow mr-3 mt-1"></i>
                                <span>Similar Incident Analysis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-download text-cyber-green mr-3 mt-1"></i>
                                <span>Export Options (PDF, CSV, JSON)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- API Documentation -->
<section id="api" class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                API INTEGRATION
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Integrate LeakHunter into your existing security infrastructure
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
            <h3 class="text-xl cyber-font text-cyber-green mb-6 flex items-center">
                <i class="fas fa-code mr-3"></i>
                AVAILABLE ENDPOINTS
            </h3>
            <div class="space-y-8">
                <div class="group/endpoint border-l-4 border-cyber-green pl-6 py-4 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                    <h4 class="text-cyber-green cyber-font mb-2 flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        POST /api/search
                    </h4>
                    <p class="text-gray-300 tech-font mb-3">Perform a new search query</p>
                    <div class="bg-cyber-gray/30 rounded-lg p-4 tech-font text-sm border border-cyber-green/20">
                        <div class="text-cyber-blue mb-2 flex items-center">
                            <i class="fas fa-code mr-2"></i>
                            Request Body:
                        </div>
                        <pre class="text-gray-300 overflow-x-auto">{
  "query": "email@example.com",
  "type": "email",
  "filters": {
    "date_from": "2023-01-01",
    "severity": "high"
  }
}</pre>
                    </div>
                </div>

                <div class="group/endpoint border-l-4 border-cyber-blue pl-6 py-4 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                    <h4 class="text-cyber-blue cyber-font mb-2 flex items-center">
                        <i class="fas fa-download mr-2"></i>
                        GET /api/results/{search_id}
                    </h4>
                    <p class="text-gray-300 tech-font mb-3">Retrieve search results</p>
                    <div class="bg-cyber-gray/30 rounded-lg p-4 tech-font text-sm border border-cyber-blue/20">
                        <div class="text-cyber-blue mb-2 flex items-center">
                            <i class="fas fa-code mr-2"></i>
                            Response:
                        </div>
                        <pre class="text-gray-300 overflow-x-auto">{
  "status": "completed",
  "results": [...],
  "risk_score": 85,
  "recommendations": [...]
}</pre>
                    </div>
                </div>

                <div class="group/endpoint border-l-4 border-cyber-purple pl-6 py-4 hover:bg-cyber-dark/30 rounded-r-lg transition-all duration-300">
                    <h4 class="text-cyber-purple cyber-font mb-2 flex items-center">
                        <i class="fas fa-coins mr-2"></i>
                        GET /api/tokens
                    </h4>
                    <p class="text-gray-300 tech-font mb-3">Check token balance and usage</p>
                    <div class="bg-cyber-gray/30 rounded-lg p-4 tech-font text-sm border border-cyber-purple/20">
                        <div class="text-cyber-blue mb-2 flex items-center">
                            <i class="fas fa-code mr-2"></i>
                            Response:
                        </div>
                        <pre class="text-gray-300 overflow-x-auto">{
  "balance": 150,
  "used_today": 5,
  "plan": "premium"
}</pre>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-6 bg-cyber-gray/30 rounded-lg border border-cyber-orange/20">
                <h4 class="text-cyber-orange cyber-font mb-3 flex items-center">
                    <i class="fas fa-key mr-2"></i>
                    AUTHENTICATION
                </h4>
                <p class="text-gray-300 tech-font mb-3">
                    Include your API key in the Authorization header for all requests:
                </p>
                <div class="bg-cyber-dark rounded p-4 tech-font text-sm border border-cyber-green/30">
                    <pre class="text-cyber-green">Authorization: Bearer YOUR_API_KEY</pre>
                </div>
                <p class="text-gray-400 tech-font text-sm mt-3">
                    API keys are available in your account settings. Contact support for premium API access and increased rate limits.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Support -->
<section id="support" class="py-20 relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-cyber-green to-transparent animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-full h-1 bg-gradient-to-r from-transparent via-cyber-blue to-transparent animate-pulse delay-1000"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
            NEED HELP?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8 max-w-2xl mx-auto">
            Our cybersecurity experts are here to assist you with any questions, technical issues, or implementation guidance.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="contact.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-headset mr-2"></i>
                    CONTACT SUPPORT
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            <a href="faq.php" class="group border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-question-circle mr-2"></i>
                VIEW FAQ
            </a>
        </div>
        
        <!-- Additional Support Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <div class="text-center">
                <i class="fas fa-clock text-cyber-green text-2xl mb-2"></i>
                <h4 class="text-cyber-green cyber-font mb-1">24/7 Support</h4>
                <p class="text-gray-400 tech-font text-sm">Emergency security issues</p>
            </div>
            <div class="text-center">
                <i class="fas fa-comments text-cyber-blue text-2xl mb-2"></i>
                <h4 class="text-cyber-blue cyber-font mb-1">Live Chat</h4>
                <p class="text-gray-400 tech-font text-sm">Instant help during business hours</p>
            </div>
            <div class="text-center">
                <i class="fas fa-envelope text-cyber-purple text-2xl mb-2"></i>
                <h4 class="text-cyber-purple cyber-font mb-1">Email Support</h4>
                <p class="text-gray-400 tech-font text-sm">Response within 24 hours</p>
            </div>
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
    
    /* Smooth scrolling for anchor links */
    html {
        scroll-behavior: smooth;
    }
    
    /* Code block styling */
    pre {
        font-family: 'Courier New', monospace;
        line-height: 1.4;
    }
</style>

<?php include 'footer.php'; ?>