<div class="w-full max-w-md px-4">
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="material-symbols-sharp text-primary-500" style="font-size:32px">receipt_long</span>
                <span class="text-2xl font-bold text-gray-900 tracking-tight">INVOICEFLOW</span>
            </div>
            <p class="text-gray-500 text-sm">Sign in to manage your invoices</p>
        </div>
        <form action="/login" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <span class="material-symbols-sharp" style="font-size:20px">mail</span>
                    </span>
                    <input type="email" name="email" required class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm transition" placeholder="you@example.com">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <span class="material-symbols-sharp" style="font-size:20px">lock</span>
                    </span>
                    <input type="password" name="password" required class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm transition" placeholder="Enter your password">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="w-4 h-4 text-primary-500 border-gray-300 rounded focus:ring-primary-500">
                    <span class="text-sm text-gray-600">Remember me</span>
                </label>
            </div>
            <button type="submit" class="w-full py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors text-sm shadow-lg shadow-primary-500/30">
                Sign In
            </button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-500">
            Don't have an account? <a href="/register" class="text-primary-500 hover:text-primary-600 font-medium">Create one</a>
        </p>
    </div>
</div>
