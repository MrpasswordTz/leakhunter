<?php
// Deny access to uploads directory
http_response_code(403);
header('Content-Type: text/plain');
echo "403 Forbidden - Access Denied";
exit();
?>
