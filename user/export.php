<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$search_id = (int)($_GET['id'] ?? 0);
$format = sanitizeInput($_GET['format'] ?? 'html');

if ($search_id <= 0) {
    header('Location: history.php');
    exit();
}

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM search_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$search_id, $user['id']]);
    $search = $stmt->fetch();
    
    if (!$search) {
        header('Location: history.php');
        exit();
    }
    
    $results = json_decode($search['results_data'], true);
    
    if (!$results || !isset($results['List'])) {
        header('Location: history.php');
        exit();
    }
    
    // Log export activity
    logActivity($user['id'], 'export_data', "Exported search results for query: {$search['query']} in {$format} format");
    
    if ($format === 'csv') {
        // CSV Export
        $filename = 'leakhunter_results_' . date('Y-m-d_H-i-s') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add BOM for UTF-8
        fputs($output, "\xEF\xBB\xBF");
        
        // CSV Header
        fputcsv($output, ['Database', 'Field', 'Value', 'Search Query', 'Search Date', 'Export Date']);
        
        foreach ($results['List'] as $database => $data) {
            if ($database === 'No results found') continue;
            
            if (isset($data['Data']) && !empty($data['Data'])) {
                foreach ($data['Data'] as $record) {
                    foreach ($record as $field => $value) {
                        fputcsv($output, [
                            $database,
                            $field,
                            $value,
                            $search['query'],
                            $search['created_at'],
                            date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
        }
        
        fclose($output);
        exit();
        
    } else {
        // HTML Export
        $filename = 'leakhunter_results_' . date('Y-m-d_H-i-s') . '.html';
        header('Content-Type: text/html');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>🔐 LeakHunter Intelligence Report - <?php echo htmlspecialchars($search['query']); ?></title>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;500;700&display=swap');
                
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Share Tech Mono', monospace;
                    background: #0a0a0a;
                    color: #00ff41;
                    margin: 0;
                    padding: 15px;
                    line-height: 1.6;
                    background-image: 
                        linear-gradient(rgba(0, 255, 65, 0.03) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(0, 255, 65, 0.03) 1px, transparent 1px);
                    background-size: 50px 50px;
                    overflow-x: hidden;
                    min-height: 100vh;
                }
                
                .container {
                    max-width: 1400px;
                    margin: 0 auto;
                    position: relative;
                }
                
                /* Cyber Security Header */
                .cyber-header {
                    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
                    padding: 25px 20px;
                    margin-bottom: 25px;
                    border: 1px solid #00ff41;
                    border-radius: 0;
                    position: relative;
                    overflow: hidden;
                    box-shadow: 0 0 30px rgba(0, 255, 65, 0.2);
                }
                
                @media (min-width: 768px) {
                    .cyber-header {
                        padding: 40px 30px;
                        margin-bottom: 30px;
                    }
                }
                
                .cyber-header::before {
                    content: '';
                    position: absolute;
                    top: -2px;
                    left: -2px;
                    right: -2px;
                    bottom: -2px;
                    background: linear-gradient(45deg, #00ff41, #0080ff, #8000ff, #00ff41);
                    z-index: -1;
                    border-radius: 0;
                    animation: borderGlow 3s linear infinite;
                }
                
                @keyframes borderGlow {
                    0% { opacity: 0.5; }
                    50% { opacity: 1; }
                    100% { opacity: 0.5; }
                }
                
                .header-content {
                    text-align: center;
                    position: relative;
                    z-index: 2;
                }
                
                .header-title {
                    font-family: 'Orbitron', sans-serif;
                    font-size: 2em;
                    font-weight: 900;
                    color: #00ff41;
                    text-shadow: 0 0 20px #00ff41;
                    margin-bottom: 8px;
                    letter-spacing: 2px;
                    line-height: 1.2;
                }
                
                @media (min-width: 768px) {
                    .header-title {
                        font-size: 3.5em;
                        margin-bottom: 10px;
                        letter-spacing: 3px;
                    }
                }
                
                .header-subtitle {
                    font-size: 0.9em;
                    color: #0080ff;
                    text-shadow: 0 0 10px #0080ff;
                    margin-bottom: 15px;
                    letter-spacing: 1px;
                    line-height: 1.4;
                }
                
                @media (min-width: 768px) {
                    .header-subtitle {
                        font-size: 1.3em;
                        margin-bottom: 20px;
                        letter-spacing: 2px;
                    }
                }
                
                .header-divider {
                    width: 150px;
                    height: 2px;
                    background: linear-gradient(90deg, transparent, #00ff41, #0080ff, transparent);
                    margin: 15px auto;
                    border: none;
                }
                
                @media (min-width: 768px) {
                    .header-divider {
                        width: 200px;
                        height: 3px;
                        margin: 20px auto;
                    }
                }
                
                .header-badges {
                    display: flex;
                    justify-content: center;
                    gap: 15px;
                    margin-top: 15px;
                    flex-wrap: wrap;
                    font-size: 0.8em;
                }
                
                @media (min-width: 768px) {
                    .header-badges {
                        gap: 30px;
                        margin-top: 20px;
                        font-size: 1em;
                    }
                }
                
                /* Search Info Section */
                .intel-section {
                    background: rgba(26, 26, 26, 0.95);
                    border: 1px solid #333;
                    padding: 20px;
                    margin-bottom: 25px;
                    position: relative;
                    backdrop-filter: blur(10px);
                }
                
                @media (min-width: 768px) {
                    .intel-section {
                        padding: 30px;
                        margin-bottom: 30px;
                    }
                }
                
                .section-title {
                    font-family: 'Orbitron', sans-serif;
                    font-size: 1.3em;
                    color: #00ff41;
                    margin-bottom: 20px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    border-bottom: 2px solid #00ff41;
                    padding-bottom: 8px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                
                @media (min-width: 768px) {
                    .section-title {
                        font-size: 1.8em;
                        margin-bottom: 25px;
                        letter-spacing: 2px;
                        gap: 15px;
                    }
                }
                
                .intel-grid {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 15px;
                }
                
                @media (min-width: 640px) {
                    .intel-grid {
                        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                        gap: 20px;
                    }
                }
                
                .intel-card {
                    background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
                    border: 1px solid #333;
                    padding: 20px;
                    border-radius: 0;
                    position: relative;
                    overflow: hidden;
                    transition: all 0.3s ease;
                }
                
                @media (min-width: 768px) {
                    .intel-card {
                        padding: 25px;
                    }
                    
                    .intel-card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 10px 30px rgba(0, 255, 65, 0.2);
                    }
                }
                
                .intel-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 3px;
                    background: linear-gradient(90deg, #00ff41, #0080ff);
                }
                
                .intel-label {
                    color: #0080ff;
                    font-size: 0.8em;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin-bottom: 6px;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                }
                
                @media (min-width: 768px) {
                    .intel-label {
                        font-size: 0.9em;
                        margin-bottom: 8px;
                        gap: 8px;
                    }
                }
                
                .intel-value {
                    color: #ffffff;
                    font-size: 1.1em;
                    font-weight: bold;
                    word-break: break-all;
                    text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
                    line-height: 1.3;
                }
                
                @media (min-width: 768px) {
                    .intel-value {
                        font-size: 1.3em;
                    line-height: 1.4;
                    }
                }
                
                /* Database Sections */
                .database-section {
                    margin-bottom: 30px;
                }
                
                @media (min-width: 768px) {
                    .database-section {
                        margin-bottom: 40px;
                    }
                }
                
                .database-card {
                    background: rgba(26, 26, 26, 0.95);
                    border: 1px solid #333;
                    margin-bottom: 20px;
                    overflow: hidden;
                    position: relative;
                }
                
                @media (min-width: 768px) {
                    .database-card {
                        margin-bottom: 25px;
                    }
                }
                
                .database-header {
                    background: linear-gradient(135deg, #0080ff, #8000ff);
                    padding: 20px;
                    color: white;
                    position: relative;
                    overflow: hidden;
                }
                
                @media (min-width: 768px) {
                    .database-header {
                        padding: 25px;
                    }
                }
                
                .database-header::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                    animation: scanLine 2s linear infinite;
                }
                
                @keyframes scanLine {
                    0% { left: -100%; }
                    100% { left: 100%; }
                }
                
                .database-title {
                    font-family: 'Orbitron', sans-serif;
                    font-size: 1.2em;
                    margin: 0 0 12px 0;
                    text-shadow: 0 0 10px rgba(0, 128, 255, 0.5);
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    line-height: 1.3;
                }
                
                @media (min-width: 768px) {
                    .database-title {
                        font-size: 1.6em;
                        margin: 0 0 15px 0;
                        gap: 12px;
                    }
                }
                
                .database-info {
                    color: rgba(255, 255, 255, 0.9);
                    margin: 0 0 12px 0;
                    font-size: 0.9em;
                    line-height: 1.4;
                }
                
                @media (min-width: 768px) {
                    .database-info {
                        font-size: 1.1em;
                        margin: 0 0 15px 0;
                    }
                }
                
                .records-badge {
                    background: rgba(0, 255, 65, 0.2);
                    border: 1px solid #00ff41;
                    padding: 6px 12px;
                    border-radius: 0;
                    font-size: 0.8em;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    text-shadow: 0 0 5px #00ff41;
                }
                
                @media (min-width: 768px) {
                    .records-badge {
                        padding: 8px 16px;
                        font-size: 0.9em;
                        gap: 8px;
                    }
                }
                
                /* Records Container */
                .records-container {
                    padding: 20px;
                    background: rgba(10, 10, 10, 0.8);
                }
                
                @media (min-width: 768px) {
                    .records-container {
                        padding: 30px;
                    }
                }
                
                .record {
                    background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
                    border: 1px solid #333;
                    padding: 20px;
                    margin-bottom: 15px;
                    position: relative;
                    transition: all 0.3s ease;
                }
                
                @media (min-width: 768px) {
                    .record {
                        padding: 25px;
                        margin-bottom: 20px;
                    }
                    
                    .record:hover {
                        border-color: #00ff41;
                        box-shadow: 0 5px 20px rgba(0, 255, 65, 0.1);
                    }
                }
                
                .record-header {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    margin-bottom: 15px;
                    padding-bottom: 12px;
                    border-bottom: 1px solid #333;
                }
                
                @media (min-width: 640px) {
                    .record-header {
                        flex-direction: row;
                        justify-content: space-between;
                        align-items: center;
                        gap: 15px;
                    }
                }
                
                .record-title {
                    font-family: 'Orbitron', sans-serif;
                    font-size: 1.1em;
                    color: #0080ff;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }
                
                @media (min-width: 768px) {
                    .record-title {
                        font-size: 1.3em;
                        gap: 10px;
                    }
                }
                
                .record-fields {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 12px;
                }
                
                @media (min-width: 640px) {
                    .record-fields {
                        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                        gap: 15px;
                    }
                }
                
                .field {
                    background: rgba(40, 40, 40, 0.8);
                    border: 1px solid #444;
                    padding: 15px;
                    border-radius: 0;
                    position: relative;
                    overflow: hidden;
                    transition: all 0.3s ease;
                }
                
                @media (min-width: 768px) {
                    .field {
                        padding: 20px;
                    }
                    
                    .field:hover {
                        border-color: #00ff41;
                        transform: translateY(-2px);
                    }
                }
                
                .field::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 4px;
                    height: 100%;
                    background: #00ff41;
                }
                
                .field-label {
                    color: #00ff41;
                    font-size: 0.75em;
                    font-weight: bold;
                    margin-bottom: 6px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                }
                
                @media (min-width: 768px) {
                    .field-label {
                        font-size: 0.85em;
                        margin-bottom: 8px;
                        gap: 8px;
                    }
                }
                
                .field-value {
                    color: #ffffff;
                    font-size: 0.95em;
                    word-break: break-all;
                    line-height: 1.4;
                }
                
                @media (min-width: 768px) {
                    .field-value {
                        font-size: 1.1em;
                    }
                }
                
                /* No Results */
                .no-results {
                    text-align: center;
                    padding: 40px 20px;
                    color: #666;
                    border: 2px dashed #333;
                }
                
                @media (min-width: 768px) {
                    .no-results {
                        padding: 60px 40px;
                    }
                }
                
                .no-results-icon {
                    font-size: 3em;
                    margin-bottom: 15px;
                    opacity: 0.5;
                }
                
                @media (min-width: 768px) {
                    .no-results-icon {
                        font-size: 4em;
                        margin-bottom: 20px;
                    }
                }
                
                /* Footer */
                .cyber-footer {
                    margin-top: 40px;
                    padding: 25px 20px;
                    text-align: center;
                    color: #666;
                    border-top: 1px solid #333;
                    position: relative;
                }
                
                @media (min-width: 768px) {
                    .cyber-footer {
                        margin-top: 60px;
                        padding: 30px;
                    }
                }
                
                .footer-content {
                    max-width: 800px;
                    margin: 0 auto;
                }
                
                .developer-credit {
                    background: linear-gradient(135deg, #00ff41, #0080ff);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    font-family: 'Orbitron', sans-serif;
                    font-size: 1.1em;
                    font-weight: bold;
                    margin: 15px 0;
                    text-shadow: 0 0 10px rgba(0, 255, 65, 0.3);
                    line-height: 1.3;
                }
                
                @media (min-width: 768px) {
                    .developer-credit {
                        font-size: 1.4em;
                        margin: 20px 0;
                    }
                }
                
                .github-link {
                    background: linear-gradient(135deg, #8000ff, #ff0080);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    font-family: 'Orbitron', sans-serif;
                    font-size: 0.9em;
                    font-weight: bold;
                    margin: 12px 0;
                    text-decoration: none;
                    display: inline-block;
                    padding: 8px 16px;
                    border: 1px solid #8000ff;
                    transition: all 0.3s ease;
                    line-height: 1.3;
                }
                
                @media (min-width: 768px) {
                    .github-link {
                        font-size: 1.1em;
                        margin: 15px 0;
                        padding: 10px 20px;
                    }
                    
                    .github-link:hover {
                        box-shadow: 0 0 20px rgba(128, 0, 255, 0.5);
                        transform: translateY(-2px);
                    }
                }
                
                .security-badges {
                    display: flex;
                    justify-content: center;
                    gap: 12px;
                    margin: 15px 0;
                    flex-wrap: wrap;
                    font-size: 0.8em;
                }
                
                @media (min-width: 768px) {
                    .security-badges {
                        gap: 20px;
                        margin: 20px 0;
                        font-size: 1em;
                    }
                }
                
                .security-notice {
                    color: #ff4444;
                    font-size: 0.8em;
                    margin-top: 12px;
                    border: 1px solid #ff4444;
                    padding: 12px;
                    background: rgba(255, 68, 68, 0.1);
                    line-height: 1.4;
                }
                
                @media (min-width: 768px) {
                    .security-notice {
                        font-size: 0.9em;
                        margin-top: 15px;
                        padding: 15px;
                    }
                }
                
                .footer-meta {
                    color: #444;
                    margin-top: 15px;
                    font-size: 0.75em;
                    line-height: 1.4;
                }
                
                @media (min-width: 768px) {
                    .footer-meta {
                        margin-top: 20px;
                        font-size: 0.8em;
                    }
                }
                
                /* Print Styles */
                @media print {
                    body { 
                        background: white !important; 
                        color: black !important;
                        font-family: 'Courier New', monospace;
                        padding: 10px;
                    }
                    .cyber-header { 
                        background: #f5f5f5 !important; 
                        border: 2px solid #333 !important;
                        color: #333 !important;
                    }
                    .header-title, .section-title, .record-title { 
                        color: #333 !important;
                        text-shadow: none !important;
                    }
                    .intel-card, .record, .field { 
                        background: #f9f9f9 !important; 
                        border: 1px solid #ddd !important;
                    }
                    .developer-credit, .github-link {
                        background: none !important;
                        -webkit-text-fill-color: #333 !important;
                        color: #333 !important;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <!-- Cyber Security Header -->
                <div class="cyber-header">
                    <div class="header-content">
                        <h1 class="header-title">🛡️ LEAKHUNTER INTELLIGENCE</h1>
                        <p class="header-subtitle">CYBERSECURITY DATA BREACH MONITORING SYSTEM</p>
                        <hr class="header-divider">
                        <div class="header-badges">
                            <span style="color: #00ff41;">🔒 ENCRYPTED REPORT</span>
                            <span style="color: #0080ff;">📊 DATA INTELLIGENCE</span>
                            <span style="color: #8000ff;">⚡ REAL-TIME ANALYSIS</span>
                        </div>
                    </div>
                </div>
                
                <!-- Search Intelligence Section -->
                <div class="intel-section">
                    <h2 class="section-title">
                        <span style="color: #00ff41;">📡</span>
                        MISSION INTELLIGENCE
                    </h2>
                    <div class="intel-grid">
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #00ff41;">🔎</span>
                                TARGET QUERY
                            </div>
                            <div class="intel-value">"<?php echo htmlspecialchars($search['query']); ?>"</div>
                        </div>
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #0080ff;">🎯</span>
                                SEARCH TYPE
                            </div>
                            <div class="intel-value"><?php echo strtoupper($search['search_type']); ?></div>
                        </div>
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #00ff41;">📈</span>
                                RESULTS COUNT
                            </div>
                            <div class="intel-value"><?php echo number_format($search['results_count']); ?> RECORDS</div>
                        </div>
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #8000ff;">⚡</span>
                                TOKENS USED
                            </div>
                            <div class="intel-value"><?php echo number_format($search['tokens_used']); ?> UNITS</div>
                        </div>
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #0080ff;">📅</span>
                                MISSION DATE
                            </div>
                            <div class="intel-value"><?php echo date('Y-m-d H:i:s T', strtotime($search['created_at'])); ?></div>
                        </div>
                        <div class="intel-card">
                            <div class="intel-label">
                                <span style="color: #00ff41;">🕒</span>
                                REPORT GENERATED
                            </div>
                            <div class="intel-value"><?php echo date('Y-m-d H:i:s T'); ?></div>
                        </div>
                    </div>
                </div>
                
                <!-- Results Intelligence -->
                <div class="intel-section">
                    <h2 class="section-title">
                        <span style="color: #0080ff;">💾</span>
                        DATA INTELLIGENCE REPORT
                    </h2>
                    
                    <?php if (empty($results['List']) || (count($results['List']) === 1 && isset($results['List']['No results found']))): ?>
                        <div class="no-results">
                            <div class="no-results-icon">🔍</div>
                            <h3 style="color: #666; margin-bottom: 15px;">NO INTELLIGENCE FOUND</h3>
                            <p style="color: #888;">Target query yielded no data breach intelligence.</p>
                        </div>
                    <?php else: ?>
                        <div class="database-section">
                            <?php foreach ($results['List'] as $database => $data): ?>
                                <?php if ($database === 'No results found') continue; ?>
                                
                                <div class="database-card">
                                    <div class="database-header">
                                        <h3 class="database-title">
                                            <span>🗄️</span>
                                            <?php echo htmlspecialchars($database); ?>
                                        </h3>
                                        <?php if (isset($data['InfoLeak'])): ?>
                                            <p class="database-info"><?php echo htmlspecialchars($data['InfoLeak']); ?></p>
                                        <?php endif; ?>
                                        <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                            <div class="records-badge">
                                                <span>📊</span>
                                                <?php echo count($data['Data']); ?> INTELLIGENCE RECORDS IDENTIFIED
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                        <div class="records-container">
                                            <?php foreach ($data['Data'] as $index => $record): ?>
                                                <div class="record">
                                                    <div class="record-header">
                                                        <h4 class="record-title">
                                                            <span>📄</span>
                                                            INTELLIGENCE RECORD #<?php echo $index + 1; ?>
                                                        </h4>
                                                        <div class="records-badge" style="background: rgba(0, 128, 255, 0.2); border-color: #0080ff;">
                                                            <?php echo count($record); ?> DATA POINTS
                                                        </div>
                                                    </div>
                                                    <div class="record-fields">
                                                        <?php foreach ($record as $field => $value): ?>
                                                            <div class="field">
                                                                <div class="field-label">
                                                                    <span>🏷️</span>
                                                                    <?php echo htmlspecialchars($field); ?>
                                                                </div>
                                                                <div class="field-value"><?php echo htmlspecialchars($value); ?></div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Cyber Security Footer -->
                <div class="cyber-footer">
                    <div class="footer-content">
                        <div class="developer-credit">
                            🔐 DEVELOPED BY MRPASSWORDTZ
                        </div>
                        
                        <!-- GitHub Link Section -->
                        <div class="github-link">
                            💻 GITHUB: github.com/MrpasswordTz
                        </div>
                        
                        <p style="color: #666; margin-bottom: 12px; font-size: 0.85em;">
                            <strong>LeakHunter Intelligence Platform</strong><br>
                            Advanced Data Breach Monitoring & Cybersecurity Analysis
                        </p>
                        
                        <div class="security-badges">
                            <span style="color: #00ff41;">🛡️ END-TO-END ENCRYPTED</span>
                            <span style="color: #0080ff;">🔍 REAL-TIME MONITORING</span>
                            <span style="color: #8000ff;">⚡ HIGH-PERFORMANCE</span>
                        </div>
                        
                        <div class="security-notice">
                            ⚠️ CLASSIFIED INTELLIGENCE - This report contains sensitive cybersecurity data.<br>
                            Handle with extreme caution and maintain proper security protocols.
                        </div>
                        
                        <div class="footer-meta">
                            Report generated on <?php echo date('F j, Y \a\t g:i:s A T'); ?><br>
                            LeakHunter v2.0 | Cybersecurity Intelligence Suite
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit();
    }
    
} catch (Exception $e) {
    error_log("Export error: " . $e->getMessage());
    header('Location: history.php?error=export_failed');
    exit();
}
?>
