<?php
require_once '../includes/config.php';
requireLogin();

$user = getUserInfo();
if (!$user) {
    header('Location: logout.php');
    exit();
}

$error = '';
$success = '';
$results = null;
$tokensUsed = 0;
$searchId = 0;
$query = '';
$searchType = 'other';
$limit = DEFAULT_SEARCH_LIMIT;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = sanitizeInput($_POST['query'] ?? '');
    $searchType = sanitizeInput($_POST['search_type'] ?? 'other');
    $limit = (int)($_POST['limit'] ?? DEFAULT_SEARCH_LIMIT);
    $csrf_token = $_POST['csrf_token'] ?? '';

    // CSRF verification
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Invalid security token. Please try again.';
    } elseif (empty($query)) {
        $error = 'Please enter a search query.';
} elseif ($user['role'] !== 'admin' && $user['tokens_remaining'] <= 0) {
    $error = 'You have no tokens remaining. Please contact administrator.';
    } elseif (!checkRateLimit($user['id'], 'search', 10, 3600)) {
        $error = 'Rate limit exceeded. Please wait before making another search.';
    } else {
        try {
            // Calculate query complexity
            $words = array_filter(explode(' ', $query), function($word) {
                return (strlen($word) >= 4 && !is_numeric($word)) || (is_numeric($word) && strlen($word) >= 6);
            });

            $countWords = count($words);
            if ($countWords === 1) {
                $complexity = 1;
            } elseif ($countWords === 2) {
                $complexity = 5;
            } elseif ($countWords === 3) {
                $complexity = 16;
            } else {
                $complexity = 40;
            }

            $tokensNeeded = ceil((5 + sqrt($limit * $complexity)) / 5000 * 1000);

            if ($user['role'] !== 'admin' && $tokensNeeded > $user['tokens_remaining']) {
                $error = 'Insufficient tokens for this search.';
            } else {
                // Make API request
                $apiData = [
                    'token' => LEAKOSINT_API_TOKEN,
                    'request' => $query,
                    'limit' => $limit,
                    'lang' => DEFAULT_LANGUAGE,
                    'type' => 'json'
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, LEAKOSINT_API_URL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiData));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'User-Agent: LeakHunter/1.0'
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($response === false || $httpCode !== 200) {
                    $error = 'API request failed. Please try again later.';
                } else {
                    $apiResponse = json_decode($response, true);

                    if (!is_array($apiResponse) || isset($apiResponse['Error code'])) {
                        $error = 'API Error: ' . ($apiResponse['Error code'] ?? 'Unknown error');
                    } else {
                        $results = $apiResponse;
                        $tokensUsed = $tokensNeeded;

                        if ($user['role'] === 'admin') $tokensUsed = 0;

                        $db = Database::getInstance()->getConnection();

                        if ($user['role'] !== 'admin') {
                            // Update tokens
                            $stmt = $db->prepare("UPDATE users SET tokens_remaining = tokens_remaining - ? WHERE id = ?");
                            $stmt->execute([$tokensUsed, $user['id']]);
                        }

                        // Save search history
                        $resultsCount = 0;
                        if (isset($results['List']) && is_array($results['List'])) {
                            foreach ($results['List'] as $database => $data) {
                                if ($database !== 'No results found' && isset($data['Data']) && is_array($data['Data'])) {
                                    $resultsCount += count($data['Data']);
                                }
                            }
                        }

                        $stmt = $db->prepare("INSERT INTO search_history (user_id, query, results_count, tokens_used, search_type, results_data) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$user['id'], $query, $resultsCount, $tokensUsed, $searchType, json_encode($results)]);
                        $searchId = $db->lastInsertId();

                        // Log activity
                        logActivity($user['id'], 'search', "Searched for: $query, Found: $resultsCount results, Tokens used: $tokensUsed");

                        $success = "Search completed successfully. Found $resultsCount results using $tokensUsed tokens.";

                        $user = getUserInfo();
                    }
                }
            }
        } catch (Exception $e) {
            error_log("Search error: " . $e->getMessage());
            $error = 'An error occurred during search. Please try again.';
        }
    }
}

// Log page view
logActivity($user['id'], 'search_page_view', 'Viewed search page');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Search - LeakHunter</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white">
<?php include 'sidebar.php'; ?>

<div class="lg:ml-64 min-h-screen p-6">
    <h1 class="text-2xl font-bold mb-4">Data Search</h1>

    <?php if ($error): ?>
        <div class="bg-red-800 text-red-200 p-4 rounded mb-4"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="bg-green-800 text-green-200 p-4 rounded mb-4"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-gray-800 p-6 rounded mb-6">
        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
        <div class="mb-4">
            <label class="block mb-2">Search Query</label>
            <textarea name="query" rows="3" class="w-full p-2 rounded bg-gray-700 text-white"><?php echo htmlspecialchars($query); ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Search Type</label>
            <select name="search_type" class="w-full p-2 rounded bg-gray-700 text-white">
                <option value="email" <?php echo ($searchType==='email')?'selected':''; ?>>Email</option>
                <option value="username" <?php echo ($searchType==='username')?'selected':''; ?>>Username</option>
                <option value="name" <?php echo ($searchType==='name')?'selected':''; ?>>Name</option>
                <option value="phone" <?php echo ($searchType==='phone')?'selected':''; ?>>Phone</option>
                <option value="other" <?php echo ($searchType==='other')?'selected':''; ?>>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Search Limit</label>
            <select name="limit" class="w-full p-2 rounded bg-gray-700 text-white">
                <option value="100" <?php echo ($limit===100)?'selected':''; ?>>100</option>
                <option value="500" <?php echo ($limit===500)?'selected':''; ?>>500</option>
                <option value="1000" <?php echo ($limit===1000)?'selected':''; ?>>1000</option>
                <option value="5000" <?php echo ($limit===5000)?'selected':''; ?>>5000</option>
                <option value="10000" <?php echo ($limit===10000)?'selected':''; ?>>10000</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Search</button>
    </form>

    <?php if ($results): ?>
        <h2 class="text-xl font-bold mb-4">Search Results</h2>
        <?php if (isset($results['List']) && is_array($results['List'])): ?>
            <?php foreach ($results['List'] as $dbName => $data): ?>
                <div class="bg-gray-800 p-4 rounded mb-4">
                    <h3 class="font-semibold"><?php echo htmlspecialchars($dbName); ?></h3>
                    <?php if (isset($data['Data']) && is_array($data['Data'])): ?>
                        <?php foreach ($data['Data'] as $record): ?>
                            <div class="bg-gray-700 p-2 rounded mt-2">
                                <?php foreach ($record as $field => $value): ?>
                                    <p><strong><?php echo htmlspecialchars($field); ?>:</strong> <?php echo htmlspecialchars($value); ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-400">No records found</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
