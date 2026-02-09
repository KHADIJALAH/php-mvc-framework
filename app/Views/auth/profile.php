<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Profile</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-4xl font-bold text-indigo-600"><?= strtoupper(substr($user->name ?? 'U', 0, 1)) ?></span>
            </div>
            <h2 class="text-xl font-bold text-gray-800"><?= e($user->name ?? 'User') ?></h2>
            <p class="text-gray-500"><?= e($user->email ?? '') ?></p>
            <p class="text-sm text-gray-400 mt-2">Member since <?= formatDate($user->created_at ?? date('Y-m-d')) ?></p>
        </div>

        <!-- Profile Details -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Account Details</h2>
            <form class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" value="<?= e($user->name ?? '') ?>" disabled
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" value="<?= e($user->email ?? '') ?>" disabled
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <input type="text" value="User" disabled
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-600">
                </div>
                <div class="pt-4">
                    <button type="button" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Edit Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
