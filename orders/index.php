<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../includes/auth.php'; // THIS MUST BE THE FIRST LINE
require_once '../includes/config.php';
require_once '../includes/values.php';

try {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll();
    
    $total_stmt = $pdo->query("SELECT SUM(amount) as total FROM orders WHERE status IN ('paid', 'completed')");
    $total_revenue = $total_stmt->fetch()['total'] ?? 0;
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin | ZoneBundles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .completed-card { opacity: 0.6; grayscale: 100%; transition: all 0.3s ease; }
    </style>
</head>
<body class="antialiased text-gray-900">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-extrabold tracking-tighter">Admin<span class="text-blue-600">Portal</span></h1>
            
            <a href="../sitevisits" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-full transition-all">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-600">Site Visits</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-4 md:p-10 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-600 rounded-[2rem] p-6 text-white shadow-xl shadow-blue-100">
                <p class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">Gross Revenue</p>
                <p class="text-3xl font-bold italic">GHS <?php echo number_format($total_revenue, 2); ?></p>
            </div>
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Sales</p>
                    <p class="text-2xl font-bold"><?php echo count($orders); ?></p>
                </div>
                <div class="h-12 w-12 bg-gray-50 rounded-2xl flex items-center justify-center text-xl">📈</div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-sm font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Recent Transactions</h2>
            
            <?php if (count($orders) > 0): ?>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($orders as $order): 
                        $status = $order['status'];
                        $isCompleted = ($status === 'completed');
                        $net = strtolower($order['network']);
                        $netColor = ($net == 'mtn') ? 'bg-yellow-400 text-black' : (($net == 'telecel') ? 'bg-red-600 text-white' : 'bg-blue-900 text-white');
                    ?>
                    
                    <div id="order-card-<?php echo $order['id']; ?>" class="bg-white rounded-[2rem] p-5 border border-gray-100 shadow-sm transition-all <?php echo $isCompleted ? 'opacity-50 grayscale' : ''; ?>">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 <?php echo $netColor; ?> rounded-xl flex items-center justify-center text-[10px] font-black">
                                    <?php echo strtoupper(substr($order['network'], 0, 2)); ?>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 leading-none mb-1"><?php echo $order['recipient_number']; ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter"><?php echo $order['bundle_size']; ?> • <?php echo $order['network']; ?></p>
                                </div>
                            </div>

                            <?php if (!$isCompleted): ?>
                            <button onclick="completeOrder(<?php echo $order['id']; ?>)" class="h-10 w-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                            <?php else: ?>
                            <div class="h-10 w-10 bg-green-500 text-white rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <span class="text-[9px] font-mono text-blue-500 font-bold"><?php echo $order['reference']; ?></span>
                            <span id="status-badge-<?php echo $order['id']; ?>" class="flex items-center gap-1">
                                <span class="h-1.5 w-1.5 <?php echo $isCompleted ? 'bg-green-500' : 'bg-blue-500 animate-pulse'; ?> rounded-full"></span>
                                <span class="text-[9px] font-black uppercase <?php echo $isCompleted ? 'text-green-600' : 'text-blue-600'; ?> tracking-widest">
                                    <?php echo $isCompleted ? 'Completed' : 'Paid'; ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
    function completeOrder(orderId) {
        if(!confirm('Mark this bundle as sent?')) return;

        const formData = new FormData();
        formData.append('id', orderId);

        fetch('../includes/update_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // UI Updates
                const card = document.getElementById(`order-card-${orderId}`);
                const badge = document.getElementById(`status-badge-${orderId}`);
                
                card.classList.add('opacity-50', 'grayscale');
                badge.innerHTML = `
                    <span class="h-1.5 w-1.5 bg-green-500 rounded-full"></span>
                    <span class="text-[9px] font-black uppercase text-green-600 tracking-widest">Completed</span>
                `;
                // Hide the button
                event.target.closest('button').remove();
            }
        });
    }
    </script>
</body>
</html>

