<?php $page_title = 'FAQ - LeakHunter'; include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl cyber-font text-cyber-green neon-glow mb-6">
                FREQUENTLY ASKED QUESTIONS
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto">
                Find answers to common questions about our cybersecurity platform.
                If you don't see your question, contact our support team.
            </p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            <!-- FAQ 1 -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-green">What is LeakHunter?</h3>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>LeakHunter is an advanced cybersecurity intelligence platform designed to help organizations detect and monitor data breaches. Our system scans multiple data sources to identify if email addresses, phone numbers, or other identifiers have been compromised in security incidents.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-blue">How does the token system work?</h3>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Our platform uses a token-based pricing model. Each search consumes one token. New users receive 9 free trial tokens upon registration. Additional tokens can be purchased in packages: 50 tokens for TSH 30,000, 100 tokens for TSH 50,000, and larger packages for premium users.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-cyber-dark/50 border border-cyber-purple/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-purple">What data sources does LeakHunter use?</h3>
                    <i class="fas fa-chevron-down text-cyber-purple transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>We aggregate data from multiple reputable sources including public breach databases, dark web monitoring feeds, and proprietary intelligence networks. All data is ethically sourced and complies with privacy regulations.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-cyber-dark/50 border border-cyber-orange/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-orange">Is my data secure on the platform?</h3>
                    <i class="fas fa-chevron-down text-cyber-orange transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Absolutely. All user data is encrypted using AES-256 military-grade encryption. We implement strict access controls, regular security audits, and comply with international data protection standards including GDPR and local privacy laws.</p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-green">How accurate are the search results?</h3>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Our platform achieves 99.9% accuracy through advanced AI algorithms and multi-source verification. Results are cross-referenced across multiple databases to minimize false positives while maintaining comprehensive coverage.</p>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-blue">Can I cancel my subscription or token purchase?</h3>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Token purchases are non-refundable as they represent immediate access to our premium services. However, we offer flexible packages and can assist with account management. Contact support for specific situations.</p>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="bg-cyber-dark/50 border border-cyber-purple/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-purple">What payment methods do you accept?</h3>
                    <i class="fas fa-chevron-down text-cyber-purple transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>We accept payments via M-Pesa, Tigo Pesa, Airtel Money, and major credit/debit cards (Visa, Mastercard). All transactions are processed securely through our encrypted payment gateway.</p>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="bg-cyber-dark/50 border border-cyber-orange/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-orange">How do I contact support?</h3>
                    <i class="fas fa-chevron-down text-cyber-orange transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>You can reach our support team via email at zynixtechnologies@gmail.com, phone at +255 658 295 477, or through the contact form on our website. Premium users receive priority support with dedicated account managers.</p>
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-green">Do you offer enterprise solutions?</h3>
                    <i class="fas fa-chevron-down text-cyber-green transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Yes, we provide customized enterprise solutions including API integration, white-label reporting, dedicated servers, and custom data sources. Contact our sales team for enterprise pricing and features.</p>
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-6">
                <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                    <h3 class="text-lg cyber-font text-cyber-blue">How often is the platform updated?</h3>
                    <i class="fas fa-chevron-down text-cyber-blue transition-transform duration-300"></i>
                </div>
                <div class="mt-4 text-gray-300 tech-font hidden">
                    <p>Our platform receives continuous updates. Data sources are refreshed daily, security features are updated weekly, and major platform enhancements are released monthly to ensure optimal performance and security.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyber-dark via-cyber-gray to-cyber-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
            STILL HAVE QUESTIONS?
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8">
            Our support team is ready to help you get started with LeakHunter.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="contact.php" class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg shadow-lg hover:shadow-cyber-green/25">
                CONTACT SUPPORT
            </a>
            <a href="documentation.php" class="border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg">
                VIEW DOCUMENTATION
            </a>
        </div>
    </div>
</section>

<script>
    function toggleFAQ(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('i');
        
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>

<?php include 'footer.php'; ?>
