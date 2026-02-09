<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'PHP MVC Framework') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <span class="text-2xl font-bold text-indigo-600">PHP</span>
                        <span class="text-2xl font-bold text-gray-800">MVC</span>
                    </a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/" class="text-gray-600 hover:text-indigo-600 transition-colors">Home</a>
                        <a href="/about" class="text-gray-600 hover:text-indigo-600 transition-colors">About</a>
                        <a href="/contact" class="text-gray-600 hover:text-indigo-600 transition-colors">Contact</a>
                        <?php if (auth()): ?>
                        <a href="/dashboard" class="text-gray-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (auth()): ?>
                        <span class="text-gray-600">Hello, <?= e(user()->name) ?></span>
                        <a href="/profile" class="text-gray-600 hover:text-indigo-600">
                            <i class="fas fa-user"></i>
                        </a>
                        <a href="/logout" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="/login" class="text-gray-600 hover:text-indigo-600 transition-colors">Login</a>
                        <a href="/register" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (hasFlash('success')): ?>
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <?= e(flash('success')) ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (hasFlash('error')): ?>
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <?= e(flash('error')) ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; <?= date('Y') ?> PHP MVC Framework. Built by Khadija Lahlou.</p>
        </div>
    </footer>
</body>
</html>
