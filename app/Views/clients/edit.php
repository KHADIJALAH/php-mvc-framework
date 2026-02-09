<?php $c = $client; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Client</h1>
        <p class="text-gray-500 text-sm mt-1">Update <?= e($c['name']) ?></p>
    </div>
    <a href="/clients/<?= $c['id'] ?>" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
        <span class="material-symbols-sharp" style="font-size:20px">arrow_back</span>Back
    </a>
</div>

<div class="max-w-2xl">
    <form action="/clients/<?= $c['id'] ?>/update" method="POST" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
        <?= csrf_field() ?>
        <div class="grid md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label>
                <input type="text" name="name" value="<?= e($c['name']) ?>" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="<?= e($c['email'] ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                <input type="tel" name="phone" value="<?= e($c['phone'] ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Company</label>
                <input type="text" name="company" value="<?= e($c['company'] ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">City</label>
                <input type="text" name="city" value="<?= e($c['city'] ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label>
                <input type="text" name="country" value="<?= e($c['country'] ?? '') ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"><?= e($c['address'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">Save Changes</button>
            <a href="/clients/<?= $c['id'] ?>" class="px-6 py-2.5 text-gray-500 text-sm font-medium hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
