<?php 
$page_title = 'Services - LeakHunter'; 
include 'header.php'; 
?>

<!-- Hero Section -->
<section class="relative py-20 overflow-hidden text-center px-4">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl sm:text-5xl md:text-6xl cyber-font text-cyber-green neon-glow mb-6">
            OUR SERVICES
        </h1>
        <p class="text-lg sm:text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto">
            Flexible pricing plans designed to meet your cybersecurity needs.
            Choose the perfect package for comprehensive data protection.
        </p>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background Blurs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- BASIC PLAN -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/20 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-cyber-green/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyber-green to-cyber-blue rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500 shadow-lg shadow-cyber-green/20">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-green mb-3 group-hover:text-cyber-blue transition-colors duration-300">BASIC SCAN</h3>
                    <div class="text-4xl cyber-font text-cyber-blue neon-glow mb-2">FREE</div>
                    <div class="text-gray-400 tech-font mb-8">9 Trial Tokens</div>

                    <ul class="space-y-3 mb-8 tech-font text-sm">
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Basic email search</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Limited results (9 searches)</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Basic reporting</li>
                        <li class="flex items-center text-gray-500"><i class="fas fa-times-circle text-cyber-red/70 mr-3 text-lg"></i><span class="line-through">Advanced filters</span></li>
                        <li class="flex items-center text-gray-500"><i class="fas fa-times-circle text-cyber-red/70 mr-3 text-lg"></i><span class="line-through">Export options</span></li>
                    </ul>

                    <a href="register.php" class="group relative overflow-hidden w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white py-3 px-6 rounded-lg font-bold hover:shadow-lg hover:shadow-cyber-green/30 transition-all duration-300 cyber-font text-center block">
                        <span class="relative z-10">GET STARTED</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                </div>
            </div>

            <!-- STANDARD PLAN -->
            <div class="group relative bg-cyber-dark/70 backdrop-blur-sm border-2 border-cyber-blue/40 rounded-xl p-8 hover:border-cyber-blue/80 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/15 hover:-translate-y-2 transform scale-105 min-h-[720px] overflow-visible">

                <!-- MOST POPULAR Badge - Fixed -->
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-50 w-full max-w-[200px]">
                    <span class="relative bg-gradient-to-r from-cyber-blue via-cyber-purple to-cyber-blue text-white px-6 py-2 rounded-full text-sm cyber-font font-bold tracking-wider shadow-lg shadow-cyber-blue/60 ring-2 ring-cyber-blue/40 backdrop-blur-md z-50 block text-center whitespace-nowrap">
                        🌟 MOST POPULAR
                    </span>
                </div>

                <div class="absolute inset-0 bg-gradient-to-br from-cyber-blue/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl"></div>

                <div class="relative z-10 pt-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyber-blue to-cyber-purple rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:rotate-y-180 group-hover:scale-110 transition-all duration-700 shadow-lg shadow-cyber-blue/20">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-blue mb-3 group-hover:text-cyber-purple transition-colors duration-300">STANDARD</h3>
                    <div class="text-4xl cyber-font text-cyber-green neon-glow mb-2">TSH 30,000</div>
                    <div class="text-gray-400 tech-font mb-8">50 Tokens</div>

                    <ul class="space-y-3 mb-8 tech-font text-sm">
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Advanced email & phone search</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Unlimited searches (50 tokens)</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Detailed reporting</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Advanced filters</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Export to PDF/CSV</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Email alerts</li>
                    </ul>

                    <button class="group relative overflow-hidden w-full bg-gradient-to-r from-cyber-blue to-cyber-purple text-white py-3 px-6 rounded-lg font-bold hover:shadow-lg hover:shadow-cyber-blue/30 transition-all duration-300 cyber-font">
                        <span class="relative z-10">PURCHASE NOW</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-cyber-purple to-cyber-blue opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>
                </div>
            </div>

            <!-- PREMIUM PLAN -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-purple/20 rounded-xl p-8 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-cyber-purple/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyber-purple to-cyber-orange rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-500 shadow-lg shadow-cyber-purple/20">
                        <i class="fas fa-crown text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-purple mb-3 group-hover:text-cyber-orange transition-colors duration-300">PREMIUM</h3>
                    <div class="text-4xl cyber-font text-cyber-orange neon-glow mb-2">TSH 100,000</div>
                    <div class="text-gray-400 tech-font mb-8">200 Tokens</div>

                    <ul class="space-y-3 mb-8 tech-font text-sm">
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Everything in Standard</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Priority support</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>API access</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Custom integrations</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>White-label reports</li>
                        <li class="flex items-center text-gray-300"><i class="fas fa-check-circle text-cyber-green mr-3 text-lg"></i>Dedicated account manager</li>
                    </ul>

                    <button class="group relative overflow-hidden w-full bg-gradient-to-r from-cyber-purple to-cyber-orange text-white py-3 px-6 rounded-lg font-bold hover:shadow-lg hover:shadow-cyber-purple/30 transition-all duration-300 cyber-font">
                        <span class="relative z-10">CONTACT SALES</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-cyber-orange to-cyber-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Token System Explanation -->
<section class="py-20 bg-cyber-gray/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">HOW TOKENS WORK</h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">Our token-based system ensures fair usage and transparent pricing.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl cyber-font text-cyber-blue mb-6">TOKEN-BASED PRICING</h3>
                <div class="space-y-4 tech-font text-gray-300">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-green rounded-full flex items-center justify-center mr-4 mt-1"><span class="text-white font-bold">1</span></div>
                        <div><h4 class="text-cyber-green cyber-font mb-1">Purchase Tokens</h4><p>Buy tokens in packages that suit your needs. Each search consumes one token.</p></div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-blue rounded-full flex items-center justify-center mr-4 mt-1"><span class="text-white font-bold">2</span></div>
                        <div><h4 class="text-cyber-blue cyber-font mb-1">Perform Searches</h4><p>Use tokens to search for email addresses, phone numbers, and more.</p></div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-cyber-purple rounded-full flex items-center justify-center mr-4 mt-1"><span class="text-white font-bold">3</span></div>
                        <div><h4 class="text-cyber-purple cyber-font mb-1">Get Results</h4><p>Receive detailed reports with breach info, risk assessments, and recommendations.</p></div>
                    </div>
                </div>
            </div>

            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-8">
                <h4 class="text-xl cyber-font text-cyber-green mb-6 text-center">TOKEN PACKAGES</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg"><span class="tech-font text-gray-300">50 Tokens</span><span class="cyber-font text-cyber-green">TSH 30,000</span></div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg"><span class="tech-font text-gray-300">100 Tokens</span><span class="cyber-font text-cyber-blue">TSH 50,000</span></div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg"><span class="tech-font text-gray-300">200 Tokens</span><span class="cyber-font text-cyber-purple">TSH 100,000</span></div>
                    <div class="flex justify-between items-center p-4 bg-cyber-gray/30 rounded-lg"><span class="tech-font text-gray-300">500 Tokens</span><span class="cyber-font text-cyber-orange">TSH 200,000</span></div>
                </div>
                <p class="text-xs text-gray-500 tech-font mt-4 text-center">* Prices are in Tanzanian Shillings (TSH)</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyber-dark via-cyber-gray to-cyber-dark text-center px-4">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">READY TO GET STARTED?</h2>
        <p class="text-lg md:text-xl text-gray-300 tech-font mb-8">Choose your plan and start protecting your data today.</p>
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