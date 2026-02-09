<?php $p = $product; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-gray-500 text-sm mt-1">Update <?= e($p['name']) ?></p>
    </div>
    <a href="/products" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
        <span class="material-symbols-sharp" style="font-size:20px">arrow_back</span>Back to Products
    </a>
</div>

<div class="max-w-2xl">
    <form action="/products/<?= $p['id'] ?>/update" method="POST" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
        <?= csrf_field() ?>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Name *</label>
            <input type="text" name="name" value="<?= e($p['name']) ?>" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"><?= e($p['description'] ?? '') ?></textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Price *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 text-sm">$</span>
                    <input type="number" name="price" value="<?= $p['price'] ?>" required step="0.01" min="0" class="w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Unit</label>
                <select name="unit" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                    <?php foreach (['unit','hour','day','project','month','service'] as $u): ?>
                    <option value="<?= $u ?>" <?= ($p['unit'] ?? 'unit') === $u ? 'selected' : '' ?>><?= ucfirst($u) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">Save Changes</button>
            <a href="/products" class="px-6 py-2.5 text-gray-500 text-sm font-medium hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
