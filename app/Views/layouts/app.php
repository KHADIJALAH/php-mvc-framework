<?php $user = app\Core\Application::$app->user; $activePage = $activePage ?? 'dashboard'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'InvoiceFlow') ?> - InvoiceFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,100,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']},colors:{primary:{50:'#fff7ed',100:'#ffedd5',200:'#fed7aa',300:'#fdba74',400:'#fb923c',500:'#f97316',600:'#ea580c',700:'#c2410c',800:'#9a3412',900:'#7c2d12'}}}}}</script>
    <style>.material-symbols-sharp{font-variation-settings:'FILL' 0,'wght' 100,'GRAD' 0,'opsz' 24;font-size:24px;}</style>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex h-screen overflow-hidden">
    <aside class="w-[280px] bg-white border-r border-gray-200 flex flex-col h-full shrink-0">
        <div class="px-8 py-6 border-b border-gray-100"><div class="flex items-center gap-2"><span class="material-symbols-sharp text-primary-500" style="font-size:28px">receipt_long</span><span class="text-lg font-bold text-gray-900 tracking-tight">INVOICEFLOW</span></div></div>
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="px-4 text-xs font-medium text-gray-400 uppercase tracking-wider mb-3">Main</p>
            <a href="/dashboard" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='dashboard'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">dashboard</span>Dashboard</a>
            <a href="/invoices" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='invoices'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">receipt_long</span>Invoices</a>
            <a href="/clients" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='clients'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">group</span>Clients</a>
            <a href="/products" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='products'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">inventory_2</span>Products</a>
            <p class="px-4 text-xs font-medium text-gray-400 uppercase tracking-wider mb-3 mt-6">Management</p>
            <a href="/reports" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='reports'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">bar_chart</span>Reports</a>
            <a href="/settings" class="flex items-center gap-4 px-4 py-3 rounded-full text-sm <?= $activePage==='settings'?'bg-primary-500 text-white':'text-gray-600 hover:bg-gray-50' ?>"><span class="material-symbols-sharp" style="font-size:20px">settings</span>Settings</a>
        </nav>
        <div class="px-8 py-6 border-t border-gray-100"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold text-sm"><?= strtoupper(substr($user->name??'U',0,2)) ?></div><div class="flex-1 min-w-0"><p class="text-sm font-medium text-gray-900 truncate"><?= e($user->name??'User') ?></p><p class="text-xs text-gray-500 truncate"><?= e($user->email??'') ?></p></div><a href="/logout" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-sharp" style="font-size:20px">logout</span></a></div></div>
    </aside>
    <main class="flex-1 overflow-y-auto">
        <?php if(hasFlash('success')):?><div class="mx-8 mt-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm flex items-center gap-2"><span class="material-symbols-sharp" style="font-size:20px">check_circle</span><?=flash('success')?></div><?php endif;?>
        <?php if(hasFlash('error')):?><div class="mx-8 mt-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm flex items-center gap-2"><span class="material-symbols-sharp" style="font-size:20px">error</span><?=flash('error')?></div><?php endif;?>
        <div class="px-8 py-8 lg:px-10"><?= $content ?></div>
    </main>
</div>
</body>
</html>
