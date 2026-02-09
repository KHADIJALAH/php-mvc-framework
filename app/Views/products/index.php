<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Products & Services</h1>
        <p class="text-gray-500 text-sm mt-1">Manage your product and service catalog</p>
    </div>
    <a href="/products/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white rounded-full text-sm font-medium hover:bg-primary-600 transition shadow-sm">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>Add Product
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4">Product</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4">Unit</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (empty($products)): ?>
                <tr><td colspan="5" class="px-6 py-16 text-center">
                    <span class="material-symbols-sharp text-gray-300 mb-3 block" style="font-size:48px">inventory_2</span>
                    <p class="text-gray-500 text-sm">No products yet</p>
                    <a href="/products/create" class="text-primary-500 text-sm hover:underline mt-1 inline-block">Add your first product</a>
                </td></tr>
                <?php else: foreach ($products as $p): ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-sharp text-primary-500" style="font-size:20px">inventory_2</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900"><?= e($p['name']) ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate"><?= e($p['description'] ?? '-') ?></td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">$<?= number_format($p['price'], 2) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= e($p['unit'] ?? 'unit') ?></td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="/products/<?= $p['id'] ?>/edit" class="p-2 text-gray-400 hover:text-blue-500 rounded-lg hover:bg-gray-100 transition" title="Edit">
                                <span class="material-symbols-sharp" style="font-size:18px">edit</span>
                            </a>
                            <form action="/products/<?= $p['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                <?= csrf_field() ?>
                                <button class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100 transition" title="Delete">
                                    <span class="material-symbols-sharp" style="font-size:18px">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
