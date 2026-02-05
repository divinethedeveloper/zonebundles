<?php
// 1. Enable Error Reporting (Turn off in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Load Dependencies
require_once 'config.php';
require_once 'values.php'; // This provides the $pdo connection

// 3. Get the reference from the URL
$reference = $_GET['reference'] ?? '';

if (empty($reference)) {
    die("No reference found. Access denied.");
}

// 4. Verify Payment with Paystack API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer " . PAYSTACK_SECRET_KEY,
        "cache-control: no-cache"
    ],
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    die("cURL Error: " . $err);
}

$tranx = json_decode($response);

// 5. Process Successful Payment
if ($tranx && $tranx->status && $tranx->data->status === 'success') {
    
    // Extract transaction data
    $amount = $tranx->data->amount / 100; // Convert pesewas to GHS
    $ref = $tranx->data->reference;
    
    // Extract metadata we sent from index.php
    $recipient_number = $tranx->data->metadata->custom_fields[0]->value;
    $network = $tranx->data->metadata->custom_fields[1]->value;
    $bundle_size = $tranx->data->metadata->custom_fields[2]->value;

    // 6. Save Order to Database
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (reference, recipient_number, network, bundle_size, amount, status) 
                               VALUES (:ref, :num, :net, :size, :amt, 'paid') 
                               ON DUPLICATE KEY UPDATE status='paid'");
        
        $stmt->execute([
            ':ref'  => $ref,
            ':num'  => $recipient_number,
            ':net'  => $network,
            ':size' => $bundle_size,
            ':amt'  => $amount
        ]);
    } catch (Exception $e) {
        // We log the error but keep going so the user gets their confirmation
        error_log("DB Insert Failed: " . $e->getMessage());
    }

    // 7. Send Email Notification to You (Admin)
    $to = "your-personal-email@gmail.com"; // <--- CHANGE THIS
    $subject = "New Order: $bundle_size ($network) - $recipient_number";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: sales@zonebundles.com" . "\r\n";

    $message = "
    <html>
    <head><title>ZoneBundles New Order</title></head>
    <body style='font-family: sans-serif;'>
        <h2 style='color: #2563eb;'>New Payment Confirmed</h2>
        <p><strong>Customer Number:</strong> $recipient_number</p>
        <p><strong>Network:</strong> " . strtoupper($network) . "</p>
        <p><strong>Bundle:</strong> $bundle_size GB</p>
        <p><strong>Amount:</strong> GHS " . number_format($amount, 2) . "</p>
        <p><strong>Reference:</strong> $ref</p>
        <hr>
        <p>Please send this data manually or check your API dashboard.</p>
    </body>
    </html>";

    @mail($to, $subject, $message, $headers);

    // 8. [OPTIONAL] AUTOMATION SPOT
    // If you ever get an API from a provider (like SME Data), 
    // you would put the code to trigger that API here.

    // 9. Redirect User to Success Page
    header("Location: ../success.php?status=paid&ref=" . $ref);
    exit;

} else {
    // Payment was not successful or was tampered with
    header("Location: ../index.php?error=payment_failed");
    exit;
}