<?php

require_once '../includes/auth.php'; // THIS MUST BE THE FIRST LINE
require_once '../includes/config.php';
require_once '../includes/values.php';
// require_once '../includes/tracker.php';
// logVisit($pdo);

// Fetch visits - limited to last 100 for performance
try {
    $stmt = $pdo->query("SELECT * FROM visitor_logs ORDER BY visit_time DESC LIMIT 100");
    $visits = $stmt->fetchAll();
    
    // Stats for the top bar
    $total_visits = $pdo->query("SELECT COUNT(*) FROM visitor_logs")->fetchColumn();
    $mobile_count = $pdo->query("SELECT COUNT(*) FROM visitor_logs WHERE device_type = 'Mobile'")->fetchColumn();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traffic Analytics | ZoneBundles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="antialiased">

    <nav class="sticky top-0 z-50 glass border-b border-gray-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-extrabold tracking-tighter italic">Traffic<span class="text-blue-600">Insights</span></h1>
            <a href="../orders" class="text-[10px] font-black uppercase tracking-widest bg-gray-900 text-white px-4 py-2 rounded-full">Orders Dashboard →</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-4 md:p-10">
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Hits</p>
                <p class="text-2xl font-bold"><?php echo number_format($total_visits); ?></p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Mobile Users</p>
                <p class="text-2xl font-bold text-blue-600"><?php echo $mobile_count; ?></p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="hidden md:block">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400">Time</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400">IP Address</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400">Device</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400">Page</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400">Referrer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        <?php foreach ($visits as $v): ?>
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-8 py-4 font-medium"><?php echo date('H:i:s', strtotime($v['visit_time'])); ?></td>
                            <td class="px-8 py-4 font-mono text-xs text-blue-600"><?php echo $v['ip_address']; ?></td>
                            <td class="px-8 py-4">
                                <span class="px-2 py-1 rounded bg-gray-100 text-[10px] font-bold uppercase">
                                    <?php echo $v['device_type']; ?>
                                </span>
                            </td>
                            <td class="px-8 py-4 truncate max-w-[200px]"><?php echo $v['page_url']; ?></td>
                            <td class="px-8 py-4 text-gray-400 italic"><?php echo $v['referrer_url']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="md:hidden divide-y divide-gray-50">
                <?php foreach ($visits as $v): ?>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-tighter"><?php echo $v['ip_address']; ?></span>
                        <span class="text-[10px] font-bold text-gray-400"><?php echo date('h:i A', strtotime($v['visit_time'])); ?></span>
                    </div>
                    <p class="text-xs font-bold text-gray-800 mb-1">Visited: <?php echo $v['page_url']; ?></p>
                    <div class="flex gap-2">
                        <span class="text-[9px] px-2 py-0.5 bg-gray-100 rounded-full font-bold uppercase"><?php echo $v['device_type']; ?></span>
                        <span class="text-[9px] text-gray-400 italic truncate italic">via <?php echo $v['referrer_url']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

</body>
</html>