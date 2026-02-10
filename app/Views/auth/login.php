<div class="w-full max-w-md relative z-10 animate-slide-up">
    <!-- Mobile logo -->
    <div class="lg:hidden flex items-center gap-3 mb-10 justify-center">
        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
            <span class="material-symbols-sharp text-white" style="font-size:26px">receipt_long</span>
        </div>
        <span class="text-2xl font-extrabold text-white tracking-tight">InvoiceFlow</span>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white mb-2">Welcome back</h1>
        <p class="text-slate-400">Sign in to your account to continue</p>
    </div>

    <form action="/login" method="POST" class="space-y-5">
        <?= csrf_field() ?>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Email address</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-primary-400 transition">
                    <span class="material-symbols-sharp" style="font-size:20px">mail</span>
                </span>
                <input type="email" name="email" required class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:bg-white/10 text-sm transition-all" placeholder="you@example.com">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-primary-400 transition">
                    <span class="material-symbols-sharp" style="font-size:20px">lock</span>
                </span>
                <input type="password" name="password" required class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:bg-white/10 text-sm transition-all" placeholder="Enter your password">
            </div>
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" class="w-4 h-4 bg-white/5 border-white/20 rounded text-primary-500 focus:ring-primary-500/50">
                <span class="text-sm text-slate-400 group-hover:text-slate-300 transition">Remember me</span>
            </label>
        </div>
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl font-bold hover:from-primary-600 hover:to-amber-600 transition-all text-sm shadow-xl shadow-primary-500/25 hover:shadow-primary-500/40 hover:scale-[1.02] active:scale-[0.98]">
            Sign In
        </button>
    </form>

    <div class="mt-8 flex items-center gap-4">
        <div class="flex-1 h-px bg-white/10"></div>
        <span class="text-xs text-slate-500 uppercase tracking-wider">or</span>
        <div class="flex-1 h-px bg-white/10"></div>
    </div>

    <p class="mt-6 text-center text-sm text-slate-400">
        Don't have an account? <a href="/register" class="text-primary-400 hover:text-primary-300 font-semibold transition">Create free account</a>
    </p>
</div>
