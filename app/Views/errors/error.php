<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $code ?? 500 ?> - Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center max-w-lg mx-auto px-4">
        <h1 class="text-9xl font-bold text-red-600"><?= $code ?? 500 ?></h1>
        <h2 class="text-3xl font-semibold text-gray-800 mt-4">Something went wrong</h2>
        <p class="text-gray-600 mt-2"><?= e($message ?? 'An unexpected error occurred.') ?></p>
        <a href="/" class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
            Go Home
        </a>
    </div>
</body>
</html>
