<?php

function generateDeviceFingerprint() {
    // Get various browser and system information
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    $timezone = date_default_timezone_get();
    $screenResolution = $_POST['screen_resolution'] ?? ''; // Will be sent via JS
    $colorDepth = $_POST['color_depth'] ?? ''; // Will be sent via JS
    $timezoneOffset = $_POST['timezone_offset'] ?? ''; // Will be sent via JS
    $platform = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] ?? '';
    $hardwareConcurrency = $_POST['hardware_concurrency'] ?? ''; // Will be sent via JS
    $deviceMemory = $_POST['device_memory'] ?? ''; // Will be sent via JS
    
    // Create a string with all the collected data
    $fingerprintString = implode('|', [
        $userAgent,
        $acceptLanguage,
        $timezone,
        $screenResolution,
        $colorDepth,
        $timezoneOffset,
        $platform,
        $hardwareConcurrency,
        $deviceMemory
    ]);
    
    // Hash the string to create a unique fingerprint
    return hash('sha256', $fingerprintString);
}

function isDeviceUsed($fingerprint) {
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM device_fingerprints WHERE fingerprint = ?");
        $stmt->execute([$fingerprint]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    } catch (Exception $e) {
        error_log("Device check error: " . $e->getMessage());
        return true; // Fail safe - assume device is used if there's an error
    }
}

function saveDeviceFingerprint($userId, $fingerprint) {
    try {
        $db = Database::getInstance()->getConnection();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        
        $stmt = $db->prepare("INSERT INTO device_fingerprints (user_id, fingerprint, user_agent, ip_address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $fingerprint, $userAgent, $ipAddress]);
        
        // Update user's device ID
        $stmt = $db->prepare("UPDATE users SET device_id = ? WHERE id = ?");
        $stmt->execute([$fingerprint, $userId]);
        
        return true;
    } catch (Exception $e) {
        error_log("Save device fingerprint error: " . $e->getMessage());
        return false;
    }
}

// Function to get the JavaScript needed for client-side fingerprinting
function getFingerprintJS() {
    return <<<EOT
    <script>
    // Collect device information
    function collectDeviceInfo() {
        const screenRes = window.screen.width + 'x' + window.screen.height;
        const colorDepth = window.screen.colorDepth;
        const timezoneOffset = new Date().getTimezoneOffset();
        const hardwareConcurrency = navigator.hardwareConcurrency || '';
        const deviceMemory = navigator.deviceMemory || '';
        
        // Add hidden fields to the form
        const form = document.querySelector('form');
        if (form) {
            addHiddenField(form, 'screen_resolution', screenRes);
            addHiddenField(form, 'color_depth', colorDepth);
            addHiddenField(form, 'timezone_offset', timezoneOffset);
            addHiddenField(form, 'hardware_concurrency', hardwareConcurrency);
            addHiddenField(form, 'device_memory', deviceMemory);
        }
    }
    
    function addHiddenField(form, name, value) {
        let input = form.querySelector(`input[name="${name}"]`);
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            form.appendChild(input);
        }
        input.value = value;
    }
    
    // Run when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        collectDeviceInfo();
    });
    
    // Also run before form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            collectDeviceInfo();
            return true;
        });
    });
    </script>
EOT;
}
?>
