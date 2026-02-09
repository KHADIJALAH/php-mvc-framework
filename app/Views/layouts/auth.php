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
<body class="bg-gradient-to-br from-primary-500 via-primary-600 to-orange-700 min-h-screen flex items-center justify-center font-sans">
    <?php if (hasFlash('success')): ?>
    <div class="fixed top-4 right-4 z-50 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2 shadow-lg">
        <span class="material-symbols-sharp" style="font-size:20px">check_circle</span><?= flash('success') ?>
    </div>
    <?php endif; ?>
    <?php if (hasFlash('error')): ?>
    <div class="fixed top-4 right-4 z-50 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2 shadow-lg">
        <span class="material-symbols-sharp" style="font-size:20px">error</span><?= flash('error') ?>
    </div>
    <?php endif; ?>
    <?= $content ?>
</body>
</html>
