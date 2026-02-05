<?php
session_start();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_token = $_POST['token'] ?? '';
    
    // Hardcoded Token Check
    if ($input_token === "111666") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ../orders");
        exit;
    } else {
        $error = "Invalid Admin Token";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ZoneBundles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fcfcfd; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-sm w-full bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100 text-center">
        <div class="h-16 w-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl">🔐</div>
        <h1 class="text-2xl font-black mb-2">Admin Portal</h1>
        <p class="text-gray-400 text-sm font-medium mb-8">Enter your 6-digit access token</p>

        <form method="POST" class="space-y-4">
            <input type="password" name="token" placeholder="••••••" autofocus
                   class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white outline-none rounded-2xl p-4 text-center text-2xl font-black tracking-[0.5em] transition-all">
            
            <?php if($error): ?>
                <p class="text-red-500 text-xs font-bold uppercase tracking-tight"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-2xl hover:bg-black transition-all">
                Unlock Dashboard
            </button>
        </form>
    </div>
</body>
</html>