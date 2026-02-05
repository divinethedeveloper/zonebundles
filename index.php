<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Load your configurations
require_once 'includes/config.php';

// 2. Load the database connection (This creates the $pdo variable)
require_once 'includes/values.php'; 

// 3. Load the tracker function
require_once 'includes/tracker.php';

// 4. NOW call the function (because $pdo finally exists)
logVisit($pdo);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZoneBundles | Premium Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        <script src="https://js.paystack.co/v1/inline.js"></script>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        
        * { box-sizing: border-box; }
        html, body { 
            width: 100%; max-width: 100vw; overflow-x: hidden; margin: 0; padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff;
            scroll-behavior: smooth;
        }

        .blob-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -1; }
        .blob { position: absolute; width: 300px; height: 300px; background: linear-gradient(180deg, rgba(59, 130, 246, 0.05) 0%, rgba(147, 197, 253, 0.05) 100%); filter: blur(80px); border-radius: 50%; }
        .blob-1 { top: -50px; left: -50px; }
        .blob-2 { bottom: 10%; right: -50px; }

        .tap-scale:active { transform: scale(0.97); transition: 0.1s; }
        .network-card { border-width: 2px; transition: all 0.2s ease; cursor: pointer; }
        .network-card.selected { border-color: #2563eb; background-color: #eff6ff; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1); }
    </style>
</head>
<body class="text-gray-900">

    <div class="blob-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold tracking-tighter">
                zone<span class="text-blue-600">bundles</span>
            </h1>
            <div class="flex items-center gap-3">
                <span class="hidden md:flex items-center gap-2 text-[10px] font-black text-green-600 bg-green-50 px-3 py-1.5 rounded-full uppercase tracking-widest">
                    <span class="h-1.5 w-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    Live
                </span>
                <div class="h-10 w-10 bg-gray-50 rounded-xl flex items-center justify-center border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 pt-6 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <div class="lg:col-span-7 space-y-6 w-full min-w-0">
                <section class="bg-gray-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10">
                        <div class="bg-blue-600 inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter mb-4">Flash Sale</div>
                        <h2 class="text-4xl font-extrabold tracking-tighter mb-2">20GB MTN Bundle</h2>
                        <p class="text-gray-400 font-medium mb-6">Limited to the first 50 customers today.</p>
                        <button onclick="triggerFlashSale()" class="bg-white text-black px-8 py-3 rounded-xl font-bold tap-scale">
                            Claim GHS 87
                        </button>                    
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500/20 rounded-full blur-3xl"></div>
                </section>

                <section class="bg-white rounded-[2rem] p-6 md:p-10 border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-extrabold mb-8 uppercase tracking-widest text-gray-400">Order Data</h3>
                    
                    <div class="space-y-8">
                        <div>
                            <p class="text-sm font-bold mb-4">1. Choose Network</p>
                            <div class="grid grid-cols-3 gap-3">
                                <button onclick="selectNetwork(this, 'mtn')" class="network-card selected border-gray-100 bg-gray-50 p-4 rounded-2xl flex flex-col items-center gap-2 tap-scale">
                                    <div class="h-10 w-10 bg-yellow-400 rounded-full flex items-center justify-center text-[10px] font-black">MTN</div>
                                    <span class="text-[10px] font-bold">MTN</span>
                                </button>
                                <button onclick="selectNetwork(this, 'telecel')" class="network-card border-gray-100 bg-gray-50 p-4 rounded-2xl flex flex-col items-center gap-2 tap-scale">
                                    <div class="h-10 w-10 bg-red-600 rounded-full flex items-center justify-center text-[10px] text-white font-black">TL</div>
                                    <span class="text-[10px] font-bold">Telecel</span>
                                </button>
                                <button onclick="selectNetwork(this, 'at')" class="network-card border-gray-100 bg-gray-50 p-4 rounded-2xl flex flex-col items-center gap-2 tap-scale">
                                    <div class="h-10 w-10 bg-blue-900 rounded-full flex items-center justify-center text-[10px] text-white font-black">AT</div>
                                    <span class="text-[10px] font-bold text-center">AT (AirtelTigo)</span>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-bold mb-2 block">2. Recipient Number</label>
                            <input type="tel" id="phone-number" name="phone" placeholder="054 000 0000" class="w-full bg-gray-50 p-4 rounded-xl border-2 border-transparent focus:border-blue-600 outline-none font-bold text-lg">
                        </div>
                            <div class="min-w-0">
                                <label class="text-sm font-bold mb-2 block">3. Data Plan</label>
                                <select id="bundle-dropdown" class="w-full bg-gray-50 p-4 rounded-xl border-2 border-transparent focus:border-blue-600 outline-none font-bold appearance-none cursor-pointer">
                                    </select>
                            </div>
                        </div>

                        <button type="button" id="buy-button" class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl text-xl shadow-xl shadow-blue-100 tap-scale">
                            Buy Now
                        </button>
                    </div>
                </section>

            </div>

            

            <div class="lg:col-span-5 space-y-6 w-full min-w-0">
                <div class="bg-gray-50 rounded-[2rem] p-8 border border-gray-100">
                    <h4 class="font-bold mb-4">Instant Delivery ⚡️</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Fast and reliable data delivery.</p>
                </div>
            </div>
        </div>
    </main>

    <script src="scripts/scripts.js"></script>
    <script src="scripts/flashsale.js"></script>
    

    <script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    // 1. Configuration & Data
    const allBundles = <?php echo json_encode($bundles); ?>;
    const paystackPublicKey = 'pk_live_f2cbc5f8b5d9ba170253a7ab362f1629cdfa2281'; // Replace with your actual key
    let currentNetwork = 'mtn'; // Default network tracker



// 4. Paystack Integration
function payWithPaystack(amount, network, bundle, recipient) {
    let handler = PaystackPop.setup({
        key: '<?php echo PAYSTACK_PUBLIC_KEY; ?>',
        email: 'customer@email.com', // Or get user email
        amount: amount * 100, // Convert GHS to Pesewas
        currency: 'GHS',
        ref: 'ZB-' + Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
            custom_fields: [
                { display_name: "Recipient Number", variable_name: "recipient_number", value: recipient },
                { display_name: "Network", variable_name: "network", value: network },
                { display_name: "Bundle Size", variable_name: "bundle_size", value: bundle }
            ]
        },
        callback: function(response) {
            // Redirect to your verification script
            window.location.href = "includes/verify.php?reference=" + response.reference;
        },
        onClose: function() {
            Swal.fire('Cancelled', 'Transaction was not completed.', 'info');
        }
    });
    handler.openIframe();
}
   
</script>

</body>
</html>