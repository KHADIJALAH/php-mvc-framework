<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'InvoiceFlow') ?> - InvoiceFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,100,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']},colors:{primary:{50:'#fff7ed',100:'#ffedd5',200:'#fed7aa',300:'#fdba74',400:'#fb923c',500:'#f97316',600:'#ea580c',700:'#c2410c',800:'#9a3412',900:'#7c2d12'}}}}}</script>
    <style>
        .material-symbols-sharp{font-variation-settings:'FILL' 0,'wght' 100,'GRAD' 0,'opsz' 24;font-size:24px;}
        @keyframes float{0%,100%{transform:translateY(0px)}50%{transform:translateY(-20px)}}
        @keyframes pulse-glow{0%,100%{opacity:0.4}50%{opacity:0.8}}
        @keyframes slide-up{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
        .animate-float{animation:float 6s ease-in-out infinite}
        .animate-float-delayed{animation:float 6s ease-in-out infinite 2s}
        .animate-pulse-glow{animation:pulse-glow 4s ease-in-out infinite}
        .animate-slide-up{animation:slide-up 0.6s ease-out forwards}
        .glass{backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15)}
    </style>
</head>
<body class="bg-slate-950 font-sans min-h-screen">
    <?php if (hasFlash('success')): ?>
    <div class="fixed top-6 right-6 z-50 bg-emerald-500/10 backdrop-blur-xl border border-emerald-500/20 text-emerald-400 px-5 py-3 rounded-2xl text-sm flex items-center gap-2 shadow-2xl animate-slide-up">
        <span class="material-symbols-sharp" style="font-size:20px">check_circle</span><?= flash('success') ?>
    </div>
    <?php endif; ?>
    <?php if (hasFlash('error')): ?>
    <div class="fixed top-6 right-6 z-50 bg-red-500/10 backdrop-blur-xl border border-red-500/20 text-red-400 px-5 py-3 rounded-2xl text-sm flex items-center gap-2 shadow-2xl animate-slide-up">
        <span class="material-symbols-sharp" style="font-size:20px">error</span><?= flash('error') ?>
    </div>
    <?php endif; ?>

    <div class="flex min-h-screen">
        <!-- Left Panel - Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-500 to-amber-500 p-12 flex-col justify-between">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse-glow"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl animate-pulse-glow" style="animation-delay:2s"></div>
                <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-orange-600/20 rounded-full blur-3xl animate-pulse-glow" style="animation-delay:4s"></div>
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/20 glass rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-sharp text-white" style="font-size:28px">receipt_long</span>
                    </div>
                    <span class="text-2xl font-extrabold text-white tracking-tight">InvoiceFlow</span>
                </div>
            </div>

            <div class="relative z-10 space-y-8">
                <!-- Floating cards -->
                <div class="glass rounded-3xl p-6 max-w-sm animate-float">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-emerald-400/20 rounded-2xl flex items-center justify-center">
                            <span class="material-symbols-sharp text-emerald-300" style="font-size:24px">trending_up</span>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs">Monthly Revenue</p>
                            <p class="text-white text-2xl font-bold">$24,580</p>
                        </div>
                    </div>
                    <div class="flex gap-1 h-12 items-end">
                        <div class="flex-1 bg-white/20 rounded-t-lg" style="height:40%"></div>
                        <div class="flex-1 bg-white/20 rounded-t-lg" style="height:60%"></div>
                        <div class="flex-1 bg-white/20 rounded-t-lg" style="height:45%"></div>
                        <div class="flex-1 bg-white/30 rounded-t-lg" style="height:80%"></div>
                        <div class="flex-1 bg-white/20 rounded-t-lg" style="height:55%"></div>
                        <div class="flex-1 bg-emerald-400/60 rounded-t-lg" style="height:100%"></div>
                        <div class="flex-1 bg-white/20 rounded-t-lg" style="height:70%"></div>
                    </div>
                </div>

                <div class="glass rounded-3xl p-5 max-w-xs ml-12 animate-float-delayed">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-400/20 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-sharp text-blue-300" style="font-size:20px">check_circle</span>
                        </div>
                        <div>
                            <p class="text-white text-sm font-semibold">Invoice #INV-042 Paid</p>
                            <p class="text-white/50 text-xs">Acme Corp &middot; $3,200.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                <p class="text-white/80 text-lg font-medium leading-relaxed">"InvoiceFlow transformed how I manage my freelance business. Clean, fast, and professional."</p>
                <div class="flex items-center gap-3 mt-4">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-sm">SL</div>
                    <div>
                        <p class="text-white font-semibold text-sm">Sarah Laurent</p>
                        <p class="text-white/50 text-xs">Freelance Designer</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="flex-1 flex items-center justify-center p-8 lg:p-12 relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>
            <?= $content ?>
        </div>
    </div>
</body>
</html>
