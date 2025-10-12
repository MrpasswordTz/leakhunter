<?php $page_title = 'Contact Us - LeakHunter'; include 'header.php'; ?>

<!-- Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl cyber-font text-cyber-green neon-glow mb-6">
                CONTACT US
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto">
                Get in touch with our cybersecurity experts.
                We're here to help protect your digital assets.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Contact Form -->
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-8">
                <h2 class="text-2xl cyber-font text-cyber-green mb-6">SEND US A MESSAGE</h2>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-cyber-green text-sm tech-font tracking-wider mb-2">
                                <i class="fas fa-user mr-2"></i>FIRST NAME
                            </label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded text-cyber-green placeholder-cyber-green/50 focus:outline-none focus:border-cyber-blue tech-font">
                        </div>
                        <div>
                            <label for="last_name" class="block text-cyber-green text-sm tech-font tracking-wider mb-2">
                                <i class="fas fa-user mr-2"></i>LAST NAME
                            </label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded text-cyber-green placeholder-cyber-green/50 focus:outline-none focus:border-cyber-blue tech-font">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-cyber-blue text-sm tech-font tracking-wider mb-2">
                            <i class="fas fa-envelope mr-2"></i>EMAIL ADDRESS
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-blue/30 rounded text-cyber-blue placeholder-cyber-blue/50 focus:outline-none focus:border-cyber-blue tech-font">
                    </div>

                    <div>
                        <label for="mobile" class="block text-cyber-purple text-sm tech-font tracking-wider mb-2">
                            <i class="fas fa-mobile-alt mr-2"></i>MOBILE NUMBER
                        </label>
                        <input type="tel" id="mobile" name="mobile" required
                               class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-purple/30 rounded text-cyber-purple placeholder-cyber-purple/50 focus:outline-none focus:border-cyber-blue tech-font">
                    </div>

                    <div>
                        <label for="subject" class="block text-cyber-orange text-sm tech-font tracking-wider mb-2">
                            <i class="fas fa-tag mr-2"></i>SUBJECT
                        </label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-orange/30 rounded text-cyber-orange focus:outline-none focus:border-cyber-blue tech-font">
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="support">Technical Support</option>
                            <option value="sales">Sales Inquiry</option>
                            <option value="partnership">Partnership</option>
                            <option value="billing">Billing</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-cyber-green text-sm tech-font tracking-wider mb-2">
                            <i class="fas fa-comment mr-2"></i>MESSAGE
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded text-cyber-green placeholder-cyber-green/50 focus:outline-none focus:border-cyber-blue tech-font resize-none"
                                  placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white py-4 px-6 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg">
                        <i class="fas fa-paper-plane mr-3"></i>SEND MESSAGE
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-8">
                    <h2 class="text-2xl cyber-font text-cyber-blue mb-6">GET IN TOUCH</h2>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-green cyber-font mb-1">EMAIL</h3>
                                <p class="text-gray-300 tech-font">zynixtechnologies@gmail.com</p>
                                
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-mobile-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-blue cyber-font mb-1">MOBILE</h3>
                                <p class="text-gray-300 tech-font">+255 658 295 477</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-purple cyber-font mb-1">LOCATION</h3>
                                <p class="text-gray-300 tech-font">Dar es Salaam, Tanzania</p>
                                <p class="text-gray-300 tech-font">Digital Security Hub</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-orange cyber-font mb-1">BUSINESS HOURS</h3>
                                <p class="text-gray-300 tech-font">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-gray-300 tech-font">Saturday: 10:00 AM - 4:00 PM</p>
                                <p class="text-gray-300 tech-font">Sunday: Emergency Support Only</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact Options -->
                <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-8">
                    <h3 class="text-xl cyber-font text-cyber-green mb-4">QUICK CONTACT</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="tel:+255658295477" class="bg-cyber-green/20 border border-cyber-green text-cyber-green px-4 py-3 rounded-lg text-center hover:bg-cyber-green/30 transition-colors tech-font">
                            <i class="fas fa-phone mr-2"></i>CALL NOW
                        </a>
                        <a href="mailto:zynixtechnologies@gmail.com" class="bg-cyber-blue/20 border border-cyber-blue text-cyber-blue px-4 py-3 rounded-lg text-center hover:bg-cyber-blue/30 transition-colors tech-font">
                            <i class="fas fa-envelope mr-2"></i>EMAIL US
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-cyber-gray/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                FREQUENTLY ASKED QUESTIONS
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Quick answers to common questions about our services
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-cyber-dark/50 border border-cyber-green/30 rounded-xl p-6">
                <h3 class="text-lg cyber-font text-cyber-green mb-3">How quickly do you respond to inquiries?</h3>
                <p class="text-gray-300 tech-font">
                    We typically respond to all inquiries within 24 hours during business days.
                    Urgent security matters are prioritized and addressed immediately.
                </p>
            </div>

            <div class="bg-cyber-dark/50 border border-cyber-blue/30 rounded-xl p-6">
                <h3 class="text-lg cyber-font text-cyber-blue mb-3">Do you offer custom solutions?</h3>
                <p class="text-gray-300 tech-font">
                    Yes, we provide customized cybersecurity solutions tailored to your organization's
                    specific needs and requirements.
                </p>
            </div>

            <div class="bg-cyber-dark/50 border border-cyber-purple/30 rounded-xl p-6">
                <h3 class="text-lg cyber-font text-cyber-purple mb-3">Is my data secure when contacting you?</h3>
                <p class="text-gray-300 tech-font">
                    Absolutely. All communications are encrypted and handled with the highest level of
                    security and confidentiality.
                </p>
            </div>

            <div class="bg-cyber-dark/50 border border-cyber-orange/30 rounded-xl p-6">
                <h3 class="text-lg cyber-font text-cyber-orange mb-3">Can I schedule a consultation?</h3>
                <p class="text-gray-300 tech-font">
                    Yes, we offer free initial consultations to discuss your cybersecurity needs
                    and recommend the best solutions for your organization.
                </p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="faq.php" class="bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:from-cyber-green/80 hover:to-cyber-blue/80 transition-all duration-300 cyber-font text-lg">
                VIEW ALL FAQ
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
