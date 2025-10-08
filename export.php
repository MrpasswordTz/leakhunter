<?php
require_once 'config.php';
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
        
        // CSV Header
        fputcsv($output, ['Database', 'Field', 'Value', 'Search Query', 'Date']);
        
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
                            $search['created_at']
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
            <title>LeakHunter Search Results - <?php echo htmlspecialchars($search['query']); ?></title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: #0a0a0a;
                    color: #ffffff;
                    margin: 0;
                    padding: 20px;
                    line-height: 1.6;
                }
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                }
                .header {
                    background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
                    padding: 30px;
                    border-radius: 10px;
                    margin-bottom: 30px;
                    border: 1px solid #333;
                }
                .header h1 {
                    color: #00ff41;
                    margin: 0 0 10px 0;
                    font-size: 2.5em;
                }
                .header .subtitle {
                    color: #0080ff;
                    font-size: 1.2em;
                    margin: 0;
                }
                .search-info {
                    background: #1a1a1a;
                    padding: 20px;
                    border-radius: 8px;
                    margin-bottom: 30px;
                    border-left: 4px solid #00ff41;
                }
                .search-info h3 {
                    color: #00ff41;
                    margin: 0 0 15px 0;
                }
                .info-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                    gap: 15px;
                }
                .info-item {
                    background: #2a2a2a;
                    padding: 15px;
                    border-radius: 5px;
                }
                .info-label {
                    color: #888;
                    font-size: 0.9em;
                    margin-bottom: 5px;
                }
                .info-value {
                    color: #fff;
                    font-weight: bold;
                }
                .results-section {
                    margin-bottom: 40px;
                }
                .database-card {
                    background: #1a1a1a;
                    border: 1px solid #333;
                    border-radius: 10px;
                    margin-bottom: 20px;
                    overflow: hidden;
                }
                .database-header {
                    background: linear-gradient(135deg, #0080ff, #8000ff);
                    padding: 20px;
                    color: white;
                }
                .database-header h3 {
                    margin: 0 0 10px 0;
                    font-size: 1.5em;
                }
                .database-info {
                    color: rgba(255, 255, 255, 0.8);
                    margin: 0;
                }
                .records-count {
                    background: rgba(255, 255, 255, 0.2);
                    padding: 5px 10px;
                    border-radius: 15px;
                    font-size: 0.9em;
                    display: inline-block;
                    margin-top: 10px;
                }
                .records-container {
                    padding: 20px;
                }
                .record {
                    background: #2a2a2a;
                    border: 1px solid #444;
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom: 15px;
                }
                .record-fields {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 15px;
                }
                .field {
                    background: #333;
                    padding: 15px;
                    border-radius: 5px;
                }
                .field-label {
                    color: #00ff41;
                    font-size: 0.9em;
                    font-weight: bold;
                    margin-bottom: 5px;
                    text-transform: uppercase;
                }
                .field-value {
                    color: #fff;
                    word-break: break-all;
                }
                .no-results {
                    text-align: center;
                    padding: 40px;
                    color: #888;
                }
                .footer {
                    margin-top: 50px;
                    padding: 20px;
                    text-align: center;
                    color: #666;
                    border-top: 1px solid #333;
                }
                @media print {
                    body { background: white; color: black; }
                    .header { background: #f5f5f5; border: 1px solid #ddd; }
                    .database-header { background: #333; }
                    .record, .field { background: #f9f9f9; border: 1px solid #ddd; }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>🛡️ LeakHunter</h1>
                    <p class="subtitle">Cybersecurity Data Breach Monitoring System</p>
                </div>
                
                <div class="search-info">
                    <h3>📊 Search Information</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Search Query</div>
                            <div class="info-value"><?php echo htmlspecialchars($search['query']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Search Type</div>
                            <div class="info-value"><?php echo ucfirst($search['search_type']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Total Results</div>
                            <div class="info-value"><?php echo number_format($search['results_count']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tokens Used</div>
                            <div class="info-value"><?php echo number_format($search['tokens_used']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Search Date</div>
                            <div class="info-value"><?php echo date('M j, Y g:i A', strtotime($search['created_at'])); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Export Date</div>
                            <div class="info-value"><?php echo date('M j, Y g:i A'); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="results-section">
                    <h2 style="color: #00ff41; margin-bottom: 20px;">🔍 Search Results</h2>
                    
                    <?php if (empty($results['List']) || (count($results['List']) === 1 && isset($results['List']['No results found']))): ?>
                        <div class="no-results">
                            <h3>No results found</h3>
                            <p>No data breaches or leaked information found for this query.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($results['List'] as $database => $data): ?>
                            <?php if ($database === 'No results found') continue; ?>
                            
                            <div class="database-card">
                                <div class="database-header">
                                    <h3>🗄️ <?php echo htmlspecialchars($database); ?></h3>
                                    <?php if (isset($data['InfoLeak'])): ?>
                                        <p class="database-info"><?php echo htmlspecialchars($data['InfoLeak']); ?></p>
                                    <?php endif; ?>
                                    <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                        <span class="records-count"><?php echo count($data['Data']); ?> records found</span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if (isset($data['Data']) && !empty($data['Data'])): ?>
                                    <div class="records-container">
                                        <?php foreach ($data['Data'] as $index => $record): ?>
                                            <div class="record">
                                                <h4 style="color: #0080ff; margin: 0 0 15px 0;">Record #<?php echo $index + 1; ?></h4>
                                                <div class="record-fields">
                                                    <?php foreach ($record as $field => $value): ?>
                                                        <div class="field">
                                                            <div class="field-label"><?php echo htmlspecialchars($field); ?></div>
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
                    <?php endif; ?>
                </div>
                
                <div class="footer">
                    <p>Generated by LeakHunter on <?php echo date('F j, Y \a\t g:i A'); ?></p>
                    <p>This report contains sensitive information and should be handled securely.</p>
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
