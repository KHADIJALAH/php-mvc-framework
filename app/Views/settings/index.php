<?php $user = app\Core\Application::$app->user; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-500 text-sm mt-1">Manage your account preferences</p>
    </div>
</div>

<div class="max-w-3xl space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 p-8">
        <h2 class="text-base font-semibold text-gray-900 mb-6">Account Information</h2>
        <form action="/settings" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div class="flex items-center gap-6 mb-6">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-primary-600 font-bold text-xl">
                    <?= strtoupper(substr($user->name ?? 'U', 0, 2)) ?>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900"><?= e($user->name ?? 'User') ?></h3>
                    <p class="text-sm text-gray-500"><?= e($user->email ?? '') ?></p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                    <input type="text" name="name" value="<?= e($user->name ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" value="<?= e($user->email ?? '') ?>" disabled class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-8">
        <h2 class="text-base font-semibold text-gray-900 mb-6">Change Password</h2>
        <form action="/settings/password" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Current Password</label>
                <input type="password" name="current_password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
                    <input type="password" name="new_password" required minlength="6" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm New Password</label>
                    <input type="password" name="new_password_confirm" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-gray-800 text-white rounded-xl text-sm font-medium hover:bg-gray-900 transition shadow-sm">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-red-100 p-8">
        <h2 class="text-base font-semibold text-red-600 mb-2">Danger Zone</h2>
        <p class="text-sm text-gray-500 mb-4">Once you delete your account, there is no going back.</p>
        <a href="/logout" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl text-sm font-medium hover:bg-red-100 transition">
            <span class="material-symbols-sharp" style="font-size:18px">logout</span>Sign Out
        </a>
    </div>
</div>
