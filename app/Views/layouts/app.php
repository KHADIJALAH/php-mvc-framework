<?php $user = app\Core\Application::$app->user; $activePage = $activePage ?? 'dashboard'; ?>
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
        @keyframes slide-in{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .animate-in{animation:slide-in 0.4s ease-out forwards}
        .nav-item{position:relative;transition:all 0.2s}
        .nav-item.active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:24px;background:linear-gradient(to bottom,#f97316,#f59e0b);border-radius:0 4px 4px 0;}
        ::-webkit-scrollbar{width:6px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:3px}
        ::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,0.2)}

        @media print {
            @page { margin: 15mm; size: A4; }
            body { background: white !important; }
            aside { display: none !important; }
            .no-print { display: none !important; }
            .flash-message { display: none !important; }
            main { overflow: visible !important; }
            .flex.h-screen { display: block !important; height: auto !important; overflow: visible !important; }
            main .px-8, main .lg\:px-10 { padding: 0 !important; }
            main .py-8 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .animate-in { animation: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-[270px] bg-slate-900 flex flex-col h-full shrink-0 relative overflow-hidden">
        <!-- Sidebar glow -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-0 w-24 h-24 bg-amber-500/10 rounded-full blur-3xl"></div>

        <!-- Logo -->
        <div class="px-7 py-6 relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <span class="material-symbols-sharp text-white" style="font-size:22px">receipt_long</span>
                </div>
                <span class="text-lg font-extrabold text-white tracking-tight">InvoiceFlow</span>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto relative z-10">
            <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3">Menu</p>
            <a href="/dashboard" class="nav-item <?= $activePage==='dashboard'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='dashboard'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px"><?= $activePage==='dashboard'?'dashboard':'dashboard' ?></span>Dashboard
            </a>
            <a href="/invoices" class="nav-item <?= $activePage==='invoices'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='invoices'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px">receipt_long</span>Invoices
            </a>
            <a href="/clients" class="nav-item <?= $activePage==='clients'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='clients'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px">group</span>Clients
            </a>
            <a href="/products" class="nav-item <?= $activePage==='products'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='products'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px">inventory_2</span>Products
            </a>

            <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3 mt-6">Analytics</p>
            <a href="/reports" class="nav-item <?= $activePage==='reports'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='reports'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px">bar_chart</span>Reports
            </a>
            <a href="/settings" class="nav-item <?= $activePage==='settings'?'active':'' ?> flex items-center gap-3.5 px-4 py-2.5 rounded-xl text-sm <?= $activePage==='settings'?'bg-white/10 text-white font-semibold':'text-slate-400 hover:text-white hover:bg-white/5' ?> transition-all">
                <span class="material-symbols-sharp" style="font-size:20px">settings</span>Settings
            </a>
        </nav>

        <!-- User -->
        <div class="px-5 py-5 border-t border-white/5 relative z-10">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-white/5 transition-all group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-amber-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                    <?= strtoupper(substr($user->name??'U',0,2)) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate"><?= e($user->name??'User') ?></p>
                    <p class="text-xs text-slate-500 truncate"><?= e($user->email??'') ?></p>
                </div>
                <a href="/logout" class="text-slate-500 hover:text-red-400 transition opacity-0 group-hover:opacity-100">
                    <span class="material-symbols-sharp" style="font-size:18px">logout</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto bg-slate-50">
        <?php if(hasFlash('success')):?>
        <div class="mx-8 mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-sm flex items-center gap-3 animate-in shadow-sm no-print">
            <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-sharp text-emerald-600" style="font-size:18px">check_circle</span>
            </div>
            <?=flash('success')?>
        </div>
        <?php endif;?>
        <?php if(hasFlash('error')):?>
        <div class="mx-8 mt-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm flex items-center gap-3 animate-in shadow-sm no-print">
            <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-sharp text-red-600" style="font-size:18px">error</span>
            </div>
            <?=flash('error')?>
        </div>
        <?php endif;?>
        <div class="px-8 py-8 lg:px-10 animate-in"><?= $content ?></div>
    </main>
</div>
</body>
</html>
