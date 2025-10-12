</div>

    <!-- Footer -->
    <footer class="bg-cyber-gray border-t border-cyber-green/30 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                        <span class="cyber-font text-cyber-green text-xl font-bold neon-glow">LEAKHUNTER</span>
                    </div>
                    <p class="text-gray-400 tech-font text-sm mb-4">
                        Advanced cybersecurity intelligence platform for data breach monitoring and protection.
                        Stay ahead of threats with our comprehensive leak detection system.
                    </p>
                    <div class="flex space-x-4">
                        <a href="github.com/MrpasswordTz" class="text-cyber-green hover:text-cyber-blue transition-colors">
                            <i class="fab fa-github text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-cyber-green cyber-font text-lg font-bold mb-4">QUICK LINKS</h3>
                    <ul class="space-y-2 tech-font text-sm">
                        <li><a href="home.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Home</a></li>
                        <li><a href="services.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Services</a></li>
                        <li><a href="about.php" class="text-gray-400 hover:text-cyber-blue transition-colors">About Us</a></li>
                        <li><a href="contact.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Contact</a></li>
                        <li><a href="documentation.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Documentation</a></li>
                        <li><a href="faq.php" class="text-gray-400 hover:text-cyber-blue transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-cyber-green cyber-font text-lg font-bold mb-4">SUPPORT</h3>
                    <ul class="space-y-2 tech-font text-sm">
                        <li><a href="login.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Login</a></li>
                        <li><a href="register.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Register</a></li>
                        <li><a href="privacy.html" class="text-gray-400 hover:text-cyber-blue transition-colors">Privacy Policy</a></li>
                        <li><a href="term_of_use_and_condition.html" class="text-gray-400 hover:text-cyber-blue transition-colors">Terms of Service</a></li>
                        <li><a href="contact.php" class="text-gray-400 hover:text-cyber-blue transition-colors">Support Center</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-cyber-green/30 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 tech-font text-sm mb-4 md:mb-0">
                    &copy; 2025 LEAKHUNTER CYBERSECURITY. All rights reserved.
                </div>
                <div class="flex items-center space-x-6 text-xs text-gray-500 tech-font">
                    <span><i class="fas fa-shield-alt mr-1 text-cyber-green"></i>ENCRYPTED</span>
                    <span><i class="fas fa-lock mr-1 text-cyber-blue"></i>SECURE</span>
                    <span><i class="fas fa-clock mr-1 text-cyber-purple"></i>24/7 MONITORING</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('open');
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                        mobileMenu.classList.remove('open');
                    }
                });
            }
        });
    </script>
</body>
</html>
