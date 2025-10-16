<?php 
$page_title = 'Contact Us - LeakHunter'; 
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
            CONTACT US
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto leading-relaxed">
            Get in touch with our cybersecurity experts.
            <span class="text-cyber-green">We're here to help protect your digital assets.</span>
        </p>
        <div class="w-24 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto rounded-full"></div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Contact Form -->
            <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <h2 class="text-2xl cyber-font text-cyber-green mb-6 flex items-center">
                    <i class="fas fa-paper-plane mr-3"></i>
                    SEND US A MESSAGE
                </h2>

                <form class="space-y-6" id="contactForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="first_name" class="block text-cyber-green text-sm tech-font tracking-wider mb-2 flex items-center">
                                <i class="fas fa-user mr-2"></i>FIRST NAME
                            </label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-green focus:ring-2 focus:ring-cyber-green/20 tech-font transition-all duration-300">
                        </div>
                        <div class="group">
                            <label for="last_name" class="block text-cyber-green text-sm tech-font tracking-wider mb-2 flex items-center">
                                <i class="fas fa-user mr-2"></i>LAST NAME
                            </label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-green focus:ring-2 focus:ring-cyber-green/20 tech-font transition-all duration-300">
                        </div>
                    </div>

                    <div class="group">
                        <label for="email" class="block text-cyber-blue text-sm tech-font tracking-wider mb-2 flex items-center">
                            <i class="fas fa-envelope mr-2"></i>EMAIL ADDRESS
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-blue/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-blue focus:ring-2 focus:ring-cyber-blue/20 tech-font transition-all duration-300">
                    </div>

                    <div class="group">
                        <label for="mobile" class="block text-cyber-purple text-sm tech-font tracking-wider mb-2 flex items-center">
                            <i class="fas fa-mobile-alt mr-2"></i>MOBILE NUMBER
                        </label>
                        <input type="tel" id="mobile" name="mobile" required
                               class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-purple/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-purple focus:ring-2 focus:ring-cyber-purple/20 tech-font transition-all duration-300">
                    </div>

                    <div class="group">
                        <label for="subject" class="block text-cyber-orange text-sm tech-font tracking-wider mb-2 flex items-center">
                            <i class="fas fa-tag mr-2"></i>SUBJECT
                        </label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-orange/30 rounded-lg text-white focus:outline-none focus:border-cyber-orange focus:ring-2 focus:ring-cyber-orange/20 tech-font transition-all duration-300 appearance-none cursor-pointer">
                            <option value="" class="bg-cyber-dark">Select a subject</option>
                            <option value="general" class="bg-cyber-dark">General Inquiry</option>
                            <option value="support" class="bg-cyber-dark">Technical Support</option>
                            <option value="sales" class="bg-cyber-dark">Sales Inquiry</option>
                            <option value="partnership" class="bg-cyber-dark">Partnership</option>
                            <option value="billing" class="bg-cyber-dark">Billing</option>
                            <option value="emergency" class="bg-cyber-dark">Security Emergency</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-cyber-orange">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <div class="group">
                        <label for="message" class="block text-cyber-green text-sm tech-font tracking-wider mb-2 flex items-center">
                            <i class="fas fa-comment mr-2"></i>MESSAGE
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 bg-cyber-gray/50 border border-cyber-green/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyber-green focus:ring-2 focus:ring-cyber-green/20 tech-font resize-none transition-all duration-300"
                                  placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <button type="submit" class="group relative overflow-hidden w-full bg-gradient-to-r from-cyber-green to-cyber-blue text-white py-4 px-6 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                        <span class="relative z-10 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                            SEND SECURE MESSAGE
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <!-- Contact Details Card -->
                <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-8 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                    <h2 class="text-2xl cyber-font text-cyber-blue mb-6 flex items-center">
                        <i class="fas fa-address-card mr-3"></i>
                        GET IN TOUCH
                    </h2>

                    <div class="space-y-6">
                        <div class="flex items-start group/item">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mr-4 mt-1 group-hover/item:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-green cyber-font mb-1">EMAIL</h3>
                                <p class="text-gray-300 tech-font">zynixtechnologies@gmail.com</p>
                                <p class="text-gray-400 tech-font text-sm">Primary contact</p>
                            </div>
                        </div>

                        <div class="flex items-start group/item">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mr-4 mt-1 group-hover/item:rotate-12 group-hover/item:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                                <i class="fas fa-mobile-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-blue cyber-font mb-1">MOBILE</h3>
                                <p class="text-gray-300 tech-font">+255 658 295 477</p>
                                <p class="text-gray-400 tech-font text-sm">Available 24/7 for emergencies</p>
                            </div>
                        </div>

                        <div class="flex items-start group/item">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-lg flex items-center justify-center mr-4 mt-1 group-hover/item:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-cyber-purple cyber-font mb-1">LOCATION</h3>
                                <p class="text-gray-300 tech-font">Dar es Salaam, Tanzania</p>
                                <p class="text-gray-300 tech-font">Digital Security Hub</p>
                            </div>
                        </div>

                        <div class="flex items-start group/item">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-lg flex items-center justify-center mr-4 mt-1 group-hover/item:rotate-12 group-hover/item:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-orange/20">
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
                <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                    <h3 class="text-xl cyber-font text-cyber-green mb-4 flex items-center">
                        <i class="fas fa-bolt mr-2"></i>
                        QUICK CONTACT
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="tel:+255658295477" class="group/btn bg-cyber-green/20 border border-cyber-green text-cyber-green px-4 py-3 rounded-lg text-center hover:bg-cyber-green/30 transition-all duration-300 tech-font flex items-center justify-center hover:scale-105">
                            <i class="fas fa-phone mr-2 group-hover/btn:animate-pulse"></i>
                            CALL NOW
                        </a>
                        <a href="mailto:zynixtechnologies@gmail.com" class="group/btn bg-cyber-blue/20 border border-cyber-blue text-cyber-blue px-4 py-3 rounded-lg text-center hover:bg-cyber-blue/30 transition-all duration-300 tech-font flex items-center justify-center hover:scale-105">
                            <i class="fas fa-envelope mr-2 group-hover/btn:animate-bounce"></i>
                            EMAIL US
                        </a>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="group bg-cyber-dark/70 backdrop-blur-sm border border-cyber-red/30 rounded-xl p-6 hover:border-cyber-red/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-red/10 hover:-translate-y-2">
                    <h3 class="text-xl cyber-font text-cyber-red mb-4 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        SECURITY EMERGENCY
                    </h3>
                    <p class="text-gray-300 tech-font text-sm mb-4">
                        For urgent security breaches or critical incidents requiring immediate attention.
                    </p>
                    <a href="tel:+255658295477" class="w-full bg-gradient-to-r from-cyber-red to-cyber-orange text-white py-3 px-4 rounded-lg text-center font-bold hover:shadow-lg hover:shadow-cyber-red/30 transition-all duration-300 cyber-font flex items-center justify-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        EMERGENCY HOTLINE
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyber-orange/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                FREQUENTLY ASKED QUESTIONS
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                Quick answers to common questions about our services
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <h3 class="text-lg cyber-font text-cyber-green mb-3 flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    How quickly do you respond to inquiries?
                </h3>
                <p class="text-gray-300 tech-font text-sm leading-relaxed">
                    We typically respond to all inquiries within 24 hours during business days.
                    Urgent security matters are prioritized and addressed immediately.
                </p>
            </div>

            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <h3 class="text-lg cyber-font text-cyber-blue mb-3 flex items-center">
                    <i class="fas fa-cogs mr-2"></i>
                    Do you offer custom solutions?
                </h3>
                <p class="text-gray-300 tech-font text-sm leading-relaxed">
                    Yes, we provide customized cybersecurity solutions tailored to your organization's
                    specific needs and security requirements.
                </p>
            </div>

            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <h3 class="text-lg cyber-font text-cyber-purple mb-3 flex items-center">
                    <i class="fas fa-lock mr-2"></i>
                    Is my data secure when contacting you?
                </h3>
                <p class="text-gray-300 tech-font text-sm leading-relaxed">
                    Absolutely. All communications are encrypted and handled with the highest level of
                    security and confidentiality using military-grade encryption.
                </p>
            </div>

            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-orange/10 hover:-translate-y-2">
                <h3 class="text-lg cyber-font text-cyber-orange mb-3 flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    Can I schedule a consultation?
                </h3>
                <p class="text-gray-300 tech-font text-sm leading-relaxed">
                    Yes, we offer free initial consultations to discuss your cybersecurity needs
                    and recommend the best solutions for your organization's protection.
                </p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="faq.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1 inline-flex items-center">
                <span class="relative z-10 flex items-center">
                    <i class="fas fa-question-circle mr-2"></i>
                    VIEW ALL FAQ
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
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
    
    /* Custom select arrow */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2300ff7f' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
</style>

<!-- Form Submission Script -->
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Simulate form submission
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>SENDING...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Show success message (in real implementation, handle server response)
            alert('Thank you! Your message has been sent securely. We will respond within 24 hours.');
            
            // Reset form
            this.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });
</script>

<?php include 'footer.php'; ?>