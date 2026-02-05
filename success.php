<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed! | ZoneBundles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(circle at top right, #eff6ff, #ffffff);
            overflow: hidden;
        }

        .success-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .shimmer {
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.6) 50%, rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="max-w-md w-full success-card rounded-[3rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.05)] text-center animate__animated animate__zoomInDown">
        
        <div class="relative mx-auto w-28 h-28 mb-8">
            <div class="absolute inset-0 bg-green-400 opacity-20 rounded-full animate-ping"></div>
            <div class="relative w-28 h-28 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-200 animate__animated animate__bounceIn animate__delay-1s">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <h1 class="text-4xl font-extrabold tracking-tighter text-gray-900 mb-3">Payment Received!</h1>
        <div class="inline-flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-full mb-6">
            <span class="h-2 w-2 bg-blue-500 rounded-full animate-pulse"></span>
            <span class="text-[10px] font-black text-blue-700 uppercase tracking-widest">Processing Data</span>
        </div>

        <p class="text-gray-600 font-semibold leading-relaxed mb-8">
            Great news! Your transaction was successful. Your bundle will arrive in <span class="text-blue-600 font-extrabold underline decoration-blue-200">15-30 minutes</span>.
        </p>

        <div class="bg-gray-900 rounded-[2rem] p-8 text-left mb-8 relative overflow-hidden">
            <div class="relative z-10 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-[10px] font-black uppercase tracking-widest">Reference</span>
                    <span class="text-white font-mono text-sm"><?php echo htmlspecialchars($_GET['ref'] ?? 'ZB-INTERNAL'); ?></span>
                </div>
                <div class="h-[1px] bg-gray-800 w-full"></div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-[10px] font-black uppercase tracking-widest">Arrival Estimate</span>
                    <span class="text-green-400 font-bold text-sm">~ 25 Mins</span>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-blue-500/10 rounded-full blur-2xl"></div>
        </div>

        <div class="space-y-4">
            <a href="./" class="block w-full bg-blue-600 text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all tap-scale">
                Back to Home
            </a>
            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-tighter">
                Need help? Take a screenshot of this page.
            </p>
        </div>
    </div>

    <script>
        // Trigger Confetti on Load
        window.onload = function() {
            const count = 200;
            const defaults = {
                origin: { y: 0.7 },
                zIndex: 1000
            };

            function fire(particleRatio, opts) {
                confetti({
                    ...defaults,
                    ...opts,
                    particleCount: Math.floor(count * particleRatio)
                });
            }

            fire(0.25, { spread: 26, startVelocity: 55 });
            fire(0.2, { spread: 60 });
            fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
            fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
            fire(0.1, { spread: 120, startVelocity: 45 });
        };
    </script>
</body>
</html>