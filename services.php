<?php $page_title = 'Services - LeakHunter'; include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl cyber-font text-cyber-green neon-glow mb-6">
                OUR SERVICES
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto">
                Flexible pricing plans designed to meet your cybersecurity needs.
                Choose the perfect package for comprehensive data protection.
            </p>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Basic Plan -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-300 relative">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-green mb-2">BASIC SCAN</h3>
                    <div class="text-4xl cyber-font text-cyber-blue neon-glow mb-2">FREE</div>
                    <div class="text-gray-400 tech-font">9 Trial Tokens</div>
                </div>

                <ul class="space-y-3 mb-8 tech-font text-sm">
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Basic email search
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Limited results (9 searches)
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Basic reporting
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-times text-cyber-red mr-3"></i>
                        Advanced filters
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-times text-cyber-red mr-3"></i>
                        Export options
                    </li>
                </ul>

                <a href="register.php" class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white py-3 px-6 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-center block">
                    GET STARTED
                </a>
            </div>

            <!-- Standard Plan -->
            <div class="bg-cyber-dark/50 border-2 border-cyber-blue rounded-xl p-8 hover:border-cyber-blue/80 transition-all duration-300 relative transform scale-105">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-cyber-blue text-white px-4 py-1 rounded-full text-sm cyber-font">MOST POPULAR</span>
                </div>

                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-blue mb-2">STANDARD</h3>
                    <div class="text-4xl cyber-font text-cyber-green neon-glow mb-2">TSH 30,000</div>
                    <div class="text-gray-400 tech-font">50 Tokens</div>
                </div>

                <ul class="space-y-3 mb-8 tech-font text-sm">
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Advanced email & phone search
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Unlimited searches (50 tokens)
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Detailed reporting
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Advanced filters
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Export to PDF/CSV
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Email alerts
                    </li>
                </ul>

                <button class="w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white py-3 px-6 rounded-lg font-bold hover:from-cyber-blue/80 hover:to-cyber-purple/80 transition-all duration-300 cyber-font">
                    PURCHASE NOW
                </button>
            </div>

            <!-- Premium Plan -->
            <div class="bg-cyber-dark/50 border border-cyber-purple/30 rounded-xl p-8 hover:border-cyber-purple/60 transition-all duration-300 relative">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-crown text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-purple mb-2">PREMIUM</h3>
                    <div class="text-4xl cyber-font text-cyber-orange neon-glow mb-2">TSH 100,000</div>
                    <div class="text-gray-400 tech-font">200 Tokens</div>
                </div>

                <ul class="space-y-3 mb-8 tech-font text-sm">
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Everything in Standard
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Priority support
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        API access
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Custom integrations
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        White-label reports
                    </li>
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-check text-cyber-green mr-3"></i>
                        Dedicated account manager
                    </li>
                </ul>

                <button class="w-full bg-gradient-to-r from-cyber-purple to-cyber-orange text-white py-3 px-6 rounded-lg font-bold hover:from-cyber-purple/80 hover:to-cyber-orange/80 transition-all duration-300 cyber-font">
                    CONTACT SALES
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Token System Explanation -->
<section class="py-20 bg-cyber-gray/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                HOW TOKENS WORK
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Our token-based system ensures fair usage and transparent pricing
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl cyber-font text-cyber-blue mb-6">TOKEN-BASED PRICING</h3>
                <div class="space-y-4 tech-font text-gray-300">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-green rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-white font-bold">1</span>
                        </div>
                        <div>
                            <h4 class="text-cyber-green cyber-font mb-1">Purchase Tokens</h4>
                            <p>Buy tokens in packages that suit your needs. Each search consumes one token.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-blue rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-white font-bold">2</span>
                        </div>
                        <div>
                            <h4 class="text-cyber-blue cyber-font mb-1">Perform Searches</h4>
                            <p>Use tokens to search for email addresses, phone numbers, and other data across multiple sources.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-purple rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-white font-bold">3</span>
                        </div>
                        <div>
                            <h4 class="text-cyber-purple cyber-font mb-1">Get Results</h4>
                            <p>Receive detailed reports with breach information, risk assessments, and security recommendations.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-8">
                <h4 class="text-xl cyber-font text-cyber-green mb-6 text-center">TOKEN PACKAGES</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg">
                        <span class="tech-font text-gray-300">50 Tokens</span>
                        <span class="cyber-font text-cyber-green">TSH 30,000</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg">
                        <span class="tech-font text-gray-300">100 Tokens</span>
                        <span class="cyber-font text-cyber-blue">TSH 50,000</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg">
                        <span class="tech-font text-gray-300">200 Tokens</span>
                        <span class="cyber-font text-cyber-purple">TSH 100,000</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg">
                        <span class="tech-font text-gray-300">500 Tokens</span>
                        <span class="cyber-font text-cyber-orange">TSH 200,000</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 tech-font mt-4 text-center">
                    * Prices are in Tanzanian Shillings (TSH)
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyber-dark via-cyber-gray to-cyber-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
            READY TO GET STARTED?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8">
            Choose your plan and start protecting your data today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="register.php" class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg shadow-lg hover:shadow-cyber-green/25">
                START FREE TRIAL
            </a>
            <a href="contact.php" class="border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg">
                CONTACT US
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
