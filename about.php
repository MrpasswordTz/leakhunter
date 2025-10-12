<?php 
$page_title = 'About Us - LeakHunter'; 
include 'header.php'; 
?>

<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
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
            ABOUT LEAKHUNTER
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 tech-font mb-8 max-w-3xl mx-auto leading-relaxed">
            Pioneering cybersecurity solutions for the digital age.
            <span class="text-cyber-green">Protecting organizations worldwide</span> from data breaches and cyber threats.
        </p>
        <div class="w-24 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto rounded-full"></div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyber-blue/5 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-6">
                    OUR JOURNEY
                </h2>
                <div class="space-y-6 tech-font text-gray-300 text-lg leading-relaxed">
                    <p class="flex items-start">
                        <span class="text-cyber-green mr-3 text-2xl">›</span>
                        Founded in 2025, LeakHunter emerged from a critical need in the cybersecurity landscape. 
                        Our founders witnessed firsthand the devastating impact of data breaches on organizations worldwide.
                    </p>
                    <p class="flex items-start">
                        <span class="text-cyber-blue mr-3 text-2xl">›</span>
                        What started as a small research project quickly evolved into a comprehensive platform 
                        designed to democratize access to advanced cybersecurity intelligence.
                    </p>
                    <p class="flex items-start">
                        <span class="text-cyber-purple mr-3 text-2xl">›</span>
                        Today, LeakHunter serves hundreds of enterprises across Tanzania and beyond, providing 
                        cutting-edge data breach monitoring and cybersecurity intelligence services.
                    </p>
                </div>
                
                <!-- Mission Statement -->
                <div class="bg-cyber-dark/50 border-l-4 border-cyber-green rounded-r-lg p-6 mt-8">
                    <p class="text-cyber-green cyber-font text-lg italic">
                        "Our mission remains unchanged: to make the digital world safer, one search at a time."
                    </p>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="relative">
                <div class="bg-cyber-dark/70 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10">
                    <h3 class="text-2xl cyber-font text-cyber-green text-center mb-8">OUR IMPACT</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center group">
                            <div class="text-3xl cyber-font text-cyber-green neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">2025</div>
                            <div class="text-gray-400 tech-font text-sm">Founded</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-3xl cyber-font text-cyber-blue neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">300+</div>
                            <div class="text-gray-400 tech-font text-sm">Clients</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-3xl cyber-font text-cyber-purple neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">10M+</div>
                            <div class="text-gray-400 tech-font text-sm">Records</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-3xl cyber-font text-cyber-orange neon-glow mb-2 group-hover:scale-110 transition-transform duration-300">24/7</div>
                            <div class="text-gray-400 tech-font text-sm">Monitoring</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Mission -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-8 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                        <i class="fas fa-target text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-green group-hover:text-cyber-blue transition-colors duration-300">OUR MISSION</h3>
                </div>
                <p class="text-gray-300 tech-font text-lg leading-relaxed">
                    To empower organizations with advanced cybersecurity intelligence tools that enable proactive
                    threat detection and data protection. We strive to make cybersecurity accessible, affordable,
                    and effective for businesses of all sizes.
                </p>
                <div class="mt-6 pt-6 border-t border-cyber-green/20">
                    <ul class="space-y-2 tech-font text-cyber-green text-sm">
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Democratize cybersecurity</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Enable proactive protection</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Make security accessible</li>
                    </ul>
                </div>
            </div>

            <!-- Vision -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-8 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center mr-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl cyber-font text-cyber-blue group-hover:text-cyber-purple transition-colors duration-300">OUR VISION</h3>
                </div>
                <p class="text-gray-300 tech-font text-lg leading-relaxed">
                    A world where data breaches are prevented before they occur. We envision a future where
                    every organization has the intelligence and tools necessary to maintain robust cybersecurity
                    posture in an increasingly digital landscape.
                </p>
                <div class="mt-6 pt-6 border-t border-cyber-blue/20">
                    <ul class="space-y-2 tech-font text-cyber-blue text-sm">
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Prevent breaches proactively</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Universal cybersecurity access</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Future-proof protection</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyber-purple/5 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyber-orange/5 rounded-full filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                MEET OUR TEAM
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                The brilliant minds behind LeakHunter's innovative cybersecurity solutions
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Team Member 1 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 text-center hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="w-20 h-20 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                    <i class="fas fa-user-secret text-white text-2xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-green mb-2 group-hover:text-cyber-blue transition-colors duration-300">MrpasswordTz</h3>
                <p class="text-cyber-blue tech-font mb-3">Chief Executive Officer</p>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Former cybersecurity consultant with 5+ years of experience in threat intelligence and data protection.
                </p>
                <div class="mt-4 pt-4 border-t border-cyber-green/20">
                    <div class="flex justify-center space-x-3">
                        <span class="text-xs bg-cyber-green/20 text-cyber-green px-2 py-1 rounded">Strategy</span>
                        <span class="text-xs bg-cyber-blue/20 text-cyber-blue px-2 py-1 rounded">Leadership</span>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 text-center hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="w-20 h-20 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                    <i class="fas fa-code text-white text-2xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-blue mb-2 group-hover:text-cyber-purple transition-colors duration-300">Sir The Programmer</h3>
                <p class="text-cyber-purple tech-font mb-3">Chief Technology Officer</p>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Lead developer specializing in secure systems architecture and advanced search algorithms.
                </p>
                <div class="mt-4 pt-4 border-t border-cyber-blue/20">
                    <div class="flex justify-center space-x-3">
                        <span class="text-xs bg-cyber-blue/20 text-cyber-blue px-2 py-1 rounded">Development</span>
                        <span class="text-xs bg-cyber-purple/20 text-cyber-purple px-2 py-1 rounded">Architecture</span>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 text-center hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <div class="w-20 h-20 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-purple mb-2 group-hover:text-cyber-orange transition-colors duration-300">Fazo</h3>
                <p class="text-cyber-orange tech-font mb-3">Head of Security Research</p>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Cybersecurity researcher focused on emerging threats and breach analysis methodologies.
                </p>
                <div class="mt-4 pt-4 border-t border-cyber-purple/20">
                    <div class="flex justify-center space-x-3">
                        <span class="text-xs bg-cyber-purple/20 text-cyber-purple px-2 py-1 rounded">Research</span>
                        <span class="text-xs bg-cyber-orange/20 text-cyber-orange px-2 py-1 rounded">Analysis</span>
                    </div>
                </div>
            </div>

            <!-- Team Member 4 -->
            <div class="group bg-cyber-dark/50 backdrop-blur-sm border border-cyber-yellow/30 rounded-xl p-6 text-center hover:border-cyber-yellow/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-yellow/10 hover:-translate-y-2">
                <div class="w-20 h-20 bg-gradient-to-r from-cyber-yellow to-cyber-orange rounded-full flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-yellow/20">
                    <i class="fas fa-network-wired text-white text-2xl"></i>
                </div>
                <h3 class="text-xl cyber-font text-cyber-yellow mb-2 group-hover:text-cyber-orange transition-colors duration-300">Mrcyber</h3>
                <p class="text-cyber-orange tech-font mb-3">Network Engineer</p>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Network pentesting expert and infrastructure specialist with deep knowledge of network security.
                </p>
                <div class="mt-4 pt-4 border-t border-cyber-yellow/20">
                    <div class="flex justify-center space-x-3">
                        <span class="text-xs bg-cyber-yellow/20 text-cyber-yellow px-2 py-1 rounded">Networking</span>
                        <span class="text-xs bg-cyber-orange/20 text-cyber-orange px-2 py-1 rounded">Pentesting</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-cyber-gray/30 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl cyber-font text-cyber-green neon-glow mb-4">
                OUR CORE VALUES
            </h2>
            <p class="text-gray-400 tech-font text-lg max-w-2xl mx-auto">
                The principles that guide everything we do at LeakHunter
            </p>
            <div class="w-16 h-1 bg-gradient-to-r from-cyber-green to-cyber-blue mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Value 1 -->
            <div class="group text-center bg-cyber-dark/50 backdrop-blur-sm border border-cyber-green/30 rounded-xl p-6 hover:border-cyber-green/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-green/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-green/20">
                    <i class="fas fa-lock text-white text-xl"></i>
                </div>
                <h3 class="text-lg cyber-font text-cyber-green mb-2 group-hover:text-cyber-blue transition-colors duration-300">SECURITY FIRST</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Every decision we make prioritizes the security and privacy of our users' data above all else.
                </p>
            </div>

            <!-- Value 2 -->
            <div class="group text-center bg-cyber-dark/50 backdrop-blur-sm border border-cyber-blue/30 rounded-xl p-6 hover:border-cyber-blue/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-blue/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-blue/20">
                    <i class="fas fa-lightbulb text-white text-xl"></i>
                </div>
                <h3 class="text-lg cyber-font text-cyber-blue mb-2 group-hover:text-cyber-purple transition-colors duration-300">INNOVATION</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    We continuously evolve our technology to stay ahead of emerging cyber threats and challenges.
                </p>
            </div>

            <!-- Value 3 -->
            <div class="group text-center bg-cyber-dark/50 backdrop-blur-sm border border-cyber-purple/30 rounded-xl p-6 hover:border-cyber-purple/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-purple/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-purple to-cyber-orange rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-purple/20">
                    <i class="fas fa-handshake text-white text-xl"></i>
                </div>
                <h3 class="text-lg cyber-font text-cyber-purple mb-2 group-hover:text-cyber-orange transition-colors duration-300">TRUST</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Building and maintaining trust through complete transparency and consistently reliable service.
                </p>
            </div>

            <!-- Value 4 -->
            <div class="group text-center bg-cyber-dark/50 backdrop-blur-sm border border-cyber-orange/30 rounded-xl p-6 hover:border-cyber-orange/60 transition-all duration-500 hover:shadow-2xl hover:shadow-cyber-orange/10 hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-r from-cyber-orange to-cyber-yellow rounded-full flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-cyber-orange/20">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="text-lg cyber-font text-cyber-orange mb-2 group-hover:text-cyber-yellow transition-colors duration-300">COLLABORATION</h3>
                <p class="text-gray-400 tech-font text-sm leading-relaxed">
                    Working together with our clients and partners to achieve shared security objectives and success.
                </p>
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
            JOIN OUR CYBERSECURITY MISSION
        </h2>
        <p class="text-xl text-gray-300 tech-font mb-8 max-w-2xl mx-auto">
            Be part of the cybersecurity revolution and protect your organization with LeakHunter's advanced threat intelligence platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="register.php" class="group relative overflow-hidden bg-gradient-to-r from-cyber-green to-cyber-blue text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl hover:shadow-cyber-green/30 transition-all duration-500 cyber-font text-lg transform hover:-translate-y-1">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    GET STARTED TODAY
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue to-cyber-green opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            <a href="contact.php" class="group border-2 border-cyber-green text-cyber-green px-8 py-4 rounded-lg font-bold hover:bg-cyber-green/10 transition-all duration-300 cyber-font text-lg transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-comment-dots mr-2"></i>
                CONTACT OUR TEAM
            </a>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-8 text-gray-400 tech-font text-sm">
            <p>✓ Free 9 trial tokens • ✓ No credit card required • ✓ Enterprise-grade security</p>
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
</style>

<?php include 'footer.php'; ?>