<?php $user = app\Core\Application::$app->user; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
        <p class="text-gray-500 text-sm mt-1">Manage your account settings</p>
    </div>
</div>

<div class="grid md:grid-cols-3 gap-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
        <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl font-bold text-primary-600"><?= strtoupper(substr($user->name ?? 'U', 0, 2)) ?></span>
        </div>
        <h2 class="text-lg font-bold text-gray-900"><?= e($user->name ?? 'User') ?></h2>
        <p class="text-sm text-gray-500 mt-1"><?= e($user->email ?? '') ?></p>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-400">Member since <?= date('M Y', strtotime($user->created_at ?? 'now')) ?></p>
        </div>
    </div>
    <div class="md:col-span-2 bg-white rounded-2xl border border-gray-100 p-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Account Details</h2>
        <form action="/profile" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                <input type="text" name="name" value="<?= e($user->name ?? '') ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" value="<?= e($user->email ?? '') ?>" disabled class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm">
            </div>
            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
