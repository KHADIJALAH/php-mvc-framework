<?php $user = app\Core\Application::$app->user; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Settings</h1>
        <p class="text-slate-500 text-sm mt-1">Manage your account preferences</p>
    </div>
</div>

<div class="max-w-3xl space-y-6">
    <!-- Profile Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-primary-500 to-amber-500 h-24 relative">
            <div class="absolute -bottom-10 left-8">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-amber-500 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl ring-4 ring-white shadow-xl">
                    <?= strtoupper(substr($user->name ?? 'U', 0, 2)) ?>
                </div>
            </div>
        </div>
        <div class="pt-14 px-8 pb-8">
            <h3 class="text-lg font-bold text-slate-900"><?= e($user->name ?? 'User') ?></h3>
            <p class="text-sm text-slate-500"><?= e($user->email ?? '') ?></p>
        </div>
    </div>

    <!-- Account Info -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-blue-500" style="font-size:20px">person</span>
            </div>
            <h2 class="text-base font-bold text-slate-900">Account Information</h2>
        </div>
        <form action="/settings" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="<?= e($user->name ?? '') ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm bg-slate-50 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email" value="<?= e($user->email ?? '') ?>" disabled class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-400 text-sm cursor-not-allowed">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-xl text-sm font-bold hover:from-primary-600 hover:to-amber-600 transition-all shadow-lg shadow-primary-500/25 hover:scale-[1.02] active:scale-[0.98]">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Password -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-violet-500" style="font-size:20px">lock</span>
            </div>
            <h2 class="text-base font-bold text-slate-900">Change Password</h2>
        </div>
        <form action="/settings/password" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Current Password</label>
                <input type="password" name="current_password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm bg-slate-50 focus:bg-white transition">
            </div>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">New Password</label>
                    <input type="password" name="new_password" required minlength="6" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm bg-slate-50 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm New Password</label>
                    <input type="password" name="new_password_confirm" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm bg-slate-50 focus:bg-white transition">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-all shadow-lg hover:scale-[1.02] active:scale-[0.98]">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-white rounded-2xl border border-rose-200 shadow-sm p-8">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-rose-500" style="font-size:20px">warning</span>
            </div>
            <div>
                <h2 class="text-base font-bold text-rose-600">Danger Zone</h2>
                <p class="text-xs text-slate-400">Irreversible actions</p>
            </div>
        </div>
        <p class="text-sm text-slate-500 mb-4">Once you sign out, you'll need to log back in to access your data.</p>
        <a href="/logout" class="inline-flex items-center gap-2 px-5 py-2.5 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold hover:bg-rose-100 transition ring-1 ring-inset ring-rose-200">
            <span class="material-symbols-sharp" style="font-size:18px">logout</span>Sign Out
        </a>
    </div>
</div>
