<?php
function logVisit($pdo) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $currentPage = $_SERVER['REQUEST_URI'] ?? 'Unknown';
    $referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
    
    // Simple Mobile Detection
    $isMobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wmlb)/i", $userAgent);
    $deviceType = $isMobile ? "Mobile" : "Desktop";

    try {
        $stmt = $pdo->prepare("INSERT INTO visitor_logs (ip_address, user_agent, page_url, referrer_url, device_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ip, $userAgent, $currentPage, $referrer, $deviceType]);
    } catch (Exception $e) {
        error_log("Tracker Error: " . $e->getMessage());
    }
}