<?php 
$page_title = 'FAQ - LeakHunter'; 
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
            FREQUENTLY ASKED QUESTIONS
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto leading-relaxed">
            Find answers to common questions about our cybersecurity platform.
            <span class="text-cyber-green">Can't find what you're looking for? Contact our support team.</span>
        </p>
        <div class="w-24 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto rounded-full"></div>
    </div>
</section>

<!-- Quick Navigation -->
<section class="py-8 bg-cyber-gray/30 border-b border-cyber-green/20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3">
            <button onclick="filterFAQs('all')" class="tech-font text-cyber-green hover:text-cyber-blue transition-all duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50 hover:bg-cyber-blue/10 active-faq-category">All Questions</button>
            <button onclick="filterFAQs('general')" class="tech-font text-cyber-green hover:text-cyber-blue transition-all duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50 hover:bg-cyber-blue/10">General</button>
            <button onclick="filterFAQs('billing')" class="tech-font text-cyber-green hover:text-cyber-blue transition-all duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50 hover:bg-cyber-blue/10">Billing & Tokens</button>
            <button onclick="filterFAQs('technical')" class="tech-font text-cyber-green hover:text-cyber-blue transition-all duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50 hover:bg-cyber-blue/10">Technical</button>
            <button onclick="filterFAQs('security')" class="tech-font text-cyber-green hover:text-cyber-blue transition-all duration-300 px-4 py-2 border border-cyber-green/30 rounded-lg hover:border-cyber-blue/50 hover:bg-cyber-blue/10">Security</button>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Search Bar -->
        <div class="mb-12">
            <div class="relative group">
                <input type="text" id="faqSearch" placeholder="Search questions..." 
                       class="w-full px-6 py-4 bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-cyber-green focus:ring-2 focus:ring-cyber-green/20 tech-font transition-all duration-300">
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-cyber-green">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

        <div class="space-y-6" id="faqContainer">
            <!-- FAQ 1 - General -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10" data-category="general">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-question text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-green group-hover:text-cyber-blue transition-colors duration-300">What is LeakHunter?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-3">
                        <p>LeakHunter is an advanced cybersecurity intelligence platform designed to help organizations detect and monitor data breaches. Our system scans multiple data sources to identify if email addresses, phone numbers, or other identifiers have been compromised in security incidents.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="flex items-center">
                                <i class="fas fa-check text-cyber-green mr-3"></i>
                                <span class="text-sm">Real-time breach monitoring</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-cyber-green mr-3"></i>
                                <span class="text-sm">Dark web surveillance</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-cyber-green mr-3"></i>
                                <span class="text-sm">Comprehensive risk assessment</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-cyber-green mr-3"></i>
                                <span class="text-sm">Actionable security insights</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 2 - Billing -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10" data-category="billing">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-coins text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-blue group-hover:text-cyber-purple transition-colors duration-300">How does the token system work?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>Our platform uses a token-based pricing model where each search consumes one token. This ensures fair usage and transparent pricing.</p>
                        
                        <div class="bg-cyber-gray/30 rounded-lg p-4 border border-cyber-blue/20">
                            <h4 class="text-cyber-blue cyber-font mb-3">Token Packages:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex justify-between items-center p-2 bg-cyber-dark/50 rounded">
                                    <span class="tech-font text-gray-300 text-sm">9 Trial Tokens</span>
                                    <span class="cyber-font text-cyber-green text-sm">FREE</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-cyber-dark/50 rounded">
                                    <span class="tech-font text-gray-300 text-sm">50 Tokens</span>
                                    <span class="cyber-font text-cyber-blue text-sm">TSH 30,000</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-cyber-dark/50 rounded">
                                    <span class="tech-font text-gray-300 text-sm">100 Tokens</span>
                                    <span class="cyber-font text-cyber-purple text-sm">TSH 50,000</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-cyber-dark/50 rounded">
                                    <span class="tech-font text-gray-300 text-sm">200 Tokens</span>
                                    <span class="cyber-font text-cyber-orange text-sm">TSH 100,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 3 - Technical -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10" data-category="technical">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-database text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-purple group-hover:text-cyber-orange transition-colors duration-300">What data sources does LeakHunter use?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-purple transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>We aggregate data from multiple reputable sources while maintaining strict ethical standards and compliance with privacy regulations.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-cyber-green cyber-font text-sm mb-2">Primary Sources:</h4>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-green mr-2 text-xs"></i>
                                        Public breach databases
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-green mr-2 text-xs"></i>
                                        Dark web monitoring feeds
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-green mr-2 text-xs"></i>
                                        Security research communities
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-cyber-blue cyber-font text-sm mb-2">Additional Sources:</h4>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-blue mr-2 text-xs"></i>
                                        Proprietary intelligence networks
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-blue mr-2 text-xs"></i>
                                        Partner data exchanges
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-cyber-blue mr-2 text-xs"></i>
                                        Real-time threat intelligence
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 4 - Security -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-orange/10" data-category="security">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-orange group-hover:text-cyber-yellow transition-colors duration-300">Is my data secure on the platform?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-orange transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>Absolutely. We implement multiple layers of security to protect your data and maintain the highest standards of privacy and confidentiality.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-cyber-green/10 rounded-lg border border-cyber-green/20">
                                    <i class="fas fa-lock text-cyber-green mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-green cyber-font text-sm">AES-256 Encryption</h5>
                                        <p class="text-gray-400 text-xs">Military-grade data protection</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-cyber-blue/10 rounded-lg border border-cyber-blue/20">
                                    <i class="fas fa-user-shield text-cyber-blue mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-blue cyber-font text-sm">Strict Access Controls</h5>
                                        <p class="text-gray-400 text-xs">Role-based permissions</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-cyber-purple/10 rounded-lg border border-cyber-purple/20">
                                    <i class="fas fa-search text-cyber-purple mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-purple cyber-font text-sm">Regular Audits</h5>
                                        <p class="text-gray-400 text-xs">Continuous security monitoring</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-cyber-orange/10 rounded-lg border border-cyber-orange/20">
                                    <i class="fas fa-gavel text-cyber-orange mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-orange cyber-font text-sm">GDPR Compliant</h5>
                                        <p class="text-gray-400 text-xs">International privacy standards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 5 - Technical -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10" data-category="technical">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-line text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-green group-hover:text-cyber-blue transition-colors duration-300">How accurate are the search results?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>Our platform achieves <strong class="text-cyber-green">99.9% accuracy</strong> through advanced AI algorithms and multi-source verification processes.</p>
                        
                        <div class="bg-cyber-gray/30 rounded-lg p-4 border border-cyber-green/20">
                            <h4 class="text-cyber-green cyber-font mb-3">Accuracy Features:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h5 class="text-cyber-blue text-sm mb-2">Verification Process:</h5>
                                    <ul class="space-y-1 text-sm">
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-cyber-green mr-2 text-xs"></i>
                                            Multi-source cross-referencing
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-cyber-green mr-2 text-xs"></i>
                                            AI-powered pattern recognition
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-cyber-green mr-2 text-xs"></i>
                                            Manual quality assurance
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h5 class="text-cyber-purple text-sm mb-2">Quality Metrics:</h5>
                                    <ul class="space-y-1 text-sm">
                                        <li class="flex items-center">
                                            <i class="fas fa-star text-cyber-yellow mr-2 text-xs"></i>
                                            99.9% accuracy rate
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-bolt text-cyber-orange mr-2 text-xs"></i>
                                            <30 second average response
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-shield-check text-cyber-green mr-2 text-xs"></i>
                                            Zero false positive guarantee
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 6 - Billing -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10" data-category="billing">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-exchange-alt text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-blue group-hover:text-cyber-purple transition-colors duration-300">Can I cancel my subscription or token purchase?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>Token purchases are non-refundable as they represent immediate access to our premium services and infrastructure.</p>
                        
                        <div class="bg-cyber-gray/30 rounded-lg p-4 border border-cyber-blue/20">
                            <h4 class="text-cyber-blue cyber-font mb-3">Refund Policy:</h4>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-cyber-blue mr-3 mt-1"></i>
                                    <div>
                                        <p class="text-sm"><strong>Token Purchases:</strong> Non-refundable once consumed</p>
                                        <p class="text-gray-400 text-xs mt-1">Unused tokens remain in your account indefinitely</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-cyber-orange mr-3 mt-1"></i>
                                    <div>
                                        <p class="text-sm"><strong>Exceptions:</strong> Contact support for technical issues</p>
                                        <p class="text-gray-400 text-xs mt-1">We review exceptional cases individually</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-phone text-cyber-green mr-3 mt-1"></i>
                                    <div>
                                        <p class="text-sm"><strong>Support:</strong> +255 658 295 477</p>
                                        <p class="text-gray-400 text-xs mt-1">Available for billing inquiries</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 7 - Billing -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10" data-category="billing">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-credit-card text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-purple group-hover:text-cyber-orange transition-colors duration-300">What payment methods do you accept?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-purple transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>We offer multiple secure payment options tailored for our Tanzanian and international customers.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-cyber-green cyber-font text-sm mb-3">Local Payments:</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center p-2 bg-cyber-dark/50 rounded border border-cyber-green/20">
                                        <i class="fab fa-cc-mastercard text-cyber-green mr-3"></i>
                                        <span class="text-sm">M-Pesa</span>
                                    </div>
                                    <div class="flex items-center p-2 bg-cyber-dark/50 rounded border border-cyber-blue/20">
                                        <i class="fas fa-mobile-alt text-cyber-blue mr-3"></i>
                                        <span class="text-sm">Tigo Pesa</span>
                                    </div>
                                    <div class="flex items-center p-2 bg-cyber-dark/50 rounded border border-cyber-purple/20">
                                        <i class="fas fa-wallet text-cyber-purple mr-3"></i>
                                        <span class="text-sm">Airtel Money</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-cyber-blue cyber-font text-sm mb-3">International Cards:</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center p-2 bg-cyber-dark/50 rounded border border-cyber-blue/20">
                                        <i class="fab fa-cc-visa text-cyber-blue mr-3"></i>
                                        <span class="text-sm">Visa</span>
                                    </div>
                                    <div class="flex items-center p-2 bg-cyber-dark/50 rounded border border-cyber-orange/20">
                                        <i class="fab fa-cc-mastercard text-cyber-orange mr-3"></i>
                                        <span class="text-sm">Mastercard</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 8 - General -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-orange/10" data-category="general">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-headset text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-orange group-hover:text-cyber-yellow transition-colors duration-300">How do I contact support?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-orange transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>We offer multiple support channels to ensure you get help when you need it.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-cyber-green/10 rounded-lg border border-cyber-green/20">
                                    <i class="fas fa-envelope text-cyber-green mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-green cyber-font text-sm">Email Support</h5>
                                        <p class="text-gray-400 text-xs">zynixtechnologies@gmail.com</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-cyber-blue/10 rounded-lg border border-cyber-blue/20">
                                    <i class="fas fa-phone text-cyber-blue mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-blue cyber-font text-sm">Phone Support</h5>
                                        <p class="text-gray-400 text-xs">+255 658 295 477</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-cyber-purple/10 rounded-lg border border-cyber-purple/20">
                                    <i class="fas fa-comments text-cyber-purple mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-purple cyber-font text-sm">Live Chat</h5>
                                        <p class="text-gray-400 text-xs">Available during business hours</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-cyber-orange/10 rounded-lg border border-cyber-orange/20">
                                    <i class="fas fa-rocket text-cyber-orange mr-3"></i>
                                    <div>
                                        <h5 class="text-cyber-orange cyber-font text-sm">Priority Support</h5>
                                        <p class="text-gray-400 text-xs">For premium users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 9 - General -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10" data-category="general">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-green group-hover:text-cyber-blue transition-colors duration-300">Do you offer enterprise solutions?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>Yes, we provide comprehensive enterprise solutions tailored to large organizations with specific security needs.</p>
                        
                        <div class="bg-cyber-gray/30 rounded-lg p-4 border border-cyber-green/20">
                            <h4 class="text-cyber-green cyber-font mb-3">Enterprise Features:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h5 class="text-cyber-blue text-sm mb-2">Technical Features:</h5>
                                    <ul class="space-y-1 text-sm">
                                        <li class="flex items-center">
                                            <i class="fas fa-plug text-cyber-green mr-2 text-xs"></i>
                                            API Integration
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-server text-cyber-blue mr-2 text-xs"></i>
                                            Dedicated Servers
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-database text-cyber-purple mr-2 text-xs"></i>
                                            Custom Data Sources
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h5 class="text-cyber-purple text-sm mb-2">Business Features:</h5>
                                    <ul class="space-y-1 text-sm">
                                        <li class="flex items-center">
                                            <i class="fas fa-file-alt text-cyber-orange mr-2 text-xs"></i>
                                            White-label Reporting
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-user-tie text-cyber-yellow mr-2 text-xs"></i>
                                            Dedicated Account Manager
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-shield-check text-cyber-green mr-2 text-xs"></i>
                                            Custom SLAs
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 10 - Technical -->
            <div class="faq-item group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10" data-category="technical">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-sync-alt text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg cyber-font text-cyber-blue group-hover:text-cyber-purple transition-colors duration-300">How often is the platform updated?</h3>
                    </div>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300 transform group-hover:scale-125"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden faq-content">
                    <div class="pl-14 space-y-4">
                        <p>We maintain a continuous improvement cycle to ensure our platform remains cutting-edge and secure.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-3 bg-cyber-green/10 rounded-lg border border-cyber-green/20">
                                <i class="fas fa-calendar-day text-cyber-green text-xl mb-2"></i>
                                <h5 class="text-cyber-green cyber-font text-sm">Daily Updates</h5>
                                <p class="text-gray-400 text-xs">Data source refreshes</p>
                            </div>
                            <div class="text-center p-3 bg-cyber-blue/10 rounded-lg border border-cyber-blue/20">
                                <i class="fas fa-calendar-week text-cyber-blue text-xl mb-2"></i>
                                <h5 class="text-cyber-blue cyber-font text-sm">Weekly Updates</h5>
                                <p class="text-gray-400 text-xs">Security features</p>
                            </div>
                            <div class="text-center p-3 bg-cyber-purple/10 rounded-lg border border-cyber-purple/20">
                                <i class="fas fa-calendar-alt text-cyber-purple text-xl mb-2"></i>
                                <h5 class="text-cyber-purple cyber-font text-sm">Monthly Updates</h5>
                                <p class="text-gray-400 text-xs">Platform enhancements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-12">
            <div class="w-20 h-20 bg-cyber-gray/50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-cyber-green text-2xl"></i>
            </div>
            <h3 class="text-xl cyber-font text-cyber-green mb-2">No matching questions found</h3>
            <p class="text-gray-400 tech-font">Try searching with different keywords or browse all categories</p>
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
            STILL HAVE QUESTIONS?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8 max-w-2xl mx-auto">
            Our cybersecurity experts are ready to provide personalized assistance and help you get the most out of LeakHunter.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="contact.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-headset mr-2"></i>
                    CONTACT SUPPORT
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            <a href="documentation.php" class="group border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-book mr-2"></i>
                VIEW DOCUMENTATION
            </a>
        </div>
        
        <!-- Quick Support Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-left max-w-2xl mx-auto">
            <div class="text-center p-4 bg-cyber-dark/30 rounded-lg border border-cyber-green/20">
                <i class="fas fa-clock text-cyber-green text-xl mb-2"></i>
                <h4 class="text-cyber-green cyber-font text-sm mb-1">24/7 Emergency</h4>
                <p class="text-gray-400 tech-font text-xs">Critical security incidents</p>
            </div>
            <div class="text-center p-4 bg-cyber-dark/30 rounded-lg border border-cyber-blue/20">
                <i class="fas fa-comment-dots text-cyber-blue text-xl mb-2"></i>
                <h4 class="text-cyber-blue cyber-font text-sm mb-1">Live Chat</h4>
                <p class="text-gray-400 tech-font text-xs">Mon-Fri, 9AM-6PM EAT</p>
            </div>
            <div class="text-center p-4 bg-cyber-dark/30 rounded-lg border border-cyber-purple/20">
                <i class="fas fa-envelope-open-text text-cyber-purple text-xl mb-2"></i>
                <h4 class="text-cyber-purple cyber-font text-sm mb-1">Email Response</h4>
                <p class="text-gray-400 tech-font text-xs">Within 24 hours</p>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .active-faq-category {
        background: linear-gradient(135deg, rgba(0, 255, 127, 0.1), rgba(0, 150, 255, 0.1));
        border-color: #00ff7f;
        color: #00ff7f;
    }
    
    .faq-content {
        transition: all 0.3s ease-in-out;
    }
</style>

<!-- JavaScript -->
<script>
    // Toggle FAQ function
    function toggleFAQ(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('i.fa-chevron-down');
        
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
        
        // Close other FAQs when opening one
        if (!content.classList.contains('hidden')) {
            const allContents = document.querySelectorAll('.faq-content');
            const allIcons = document.querySelectorAll('.faq-item i.fa-chevron-down');
            
            allContents.forEach((item, index) => {
                if (item !== content && !item.classList.contains('hidden')) {
                    item.classList.add('hidden');
                    allIcons[index].classList.remove('rotate-180');
                }
            });
        }
    }

    // Filter FAQs by category
    function filterFAQs(category) {
        const faqItems = document.querySelectorAll('.faq-item');
        const categoryButtons = document.querySelectorAll('button[onclick^="filterFAQs"]');
        
        // Update active category button
        categoryButtons.forEach(btn => {
            if (btn.getAttribute('onclick').includes(category)) {
                btn.classList.add('active-faq-category');
            } else {
                btn.classList.remove('active-faq-category');
            }
        });
        
        // Show/hide FAQs based on category
        let visibleCount = 0;
        faqItems.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
        
        // Clear search when filtering
        document.getElementById('faqSearch').value = '';
    }

    // Search functionality
    document.getElementById('faqSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('.faq-item');
        let visibleCount = 0;
        
        faqItems.forEach(item => {
            const question = item.querySelector('h3').textContent.toLowerCase();
            const answer = item.querySelector('.faq-content').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (visibleCount === 0 && searchTerm.length > 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
        
        // Reset category buttons when searching
        if (searchTerm.length > 0) {
            const categoryButtons = document.querySelectorAll('button[onclick^="filterFAQs"]');
            categoryButtons.forEach(btn => {
                if (btn.getAttribute('onclick').includes('all')) {
                    btn.classList.add('active-faq-category');
                } else {
                    btn.classList.remove('active-faq-category');
                }
            });
        }
    });

    // Initialize with all FAQs visible
    document.addEventListener('DOMContentLoaded', function() {
        filterFAQs('all');
    });
</script>

<?php include 'footer.php'; ?>