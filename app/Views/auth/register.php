<div class="w-full max-w-md relative z-10 animate-slide-up">
    <!-- Mobile logo -->
    <div class="lg:hidden flex items-center gap-3 mb-10 justify-center">
        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
            <span class="material-symbols-sharp text-white" style="font-size:26px">receipt_long</span>
        </div>
        <span class="text-2xl font-extrabold text-white tracking-tight">InvoiceFlow</span>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white mb-2">Get started free</h1>
        <p class="text-slate-400">Create your account in seconds</p>
    </div>

    <form action="/register" method="POST" class="space-y-4">
        <?= csrf_field() ?>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Full name</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-primary-400 transition">
                    <span class="material-symbols-sharp" style="font-size:20px">person</span>
                </span>
                <input type="text" name="name" required class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:bg-white/10 text-sm transition-all" placeholder="Your full name">
            </div>
        </div>
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
                <input type="password" name="password" required minlength="6" class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:bg-white/10 text-sm transition-all" placeholder="Min. 6 characters">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Confirm password</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-primary-400 transition">
                    <span class="material-symbols-sharp" style="font-size:20px">lock</span>
                </span>
                <input type="password" name="password_confirm" required class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500/50 focus:bg-white/10 text-sm transition-all" placeholder="Confirm your password">
            </div>
        </div>
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl font-bold hover:from-primary-600 hover:to-amber-600 transition-all text-sm shadow-xl shadow-primary-500/25 hover:shadow-primary-500/40 hover:scale-[1.02] active:scale-[0.98] mt-2">
            Create Account
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-400">
        Already have an account? <a href="/login" class="text-primary-400 hover:text-primary-300 font-semibold transition">Sign in</a>
    </p>
</div>
