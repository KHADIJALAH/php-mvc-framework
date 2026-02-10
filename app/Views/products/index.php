<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Products & Services</h1>
        <p class="text-slate-500 text-sm mt-1">Manage your product and service catalog</p>
    </div>
    <a href="/products/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl text-sm font-bold hover:from-primary-600 hover:to-amber-600 transition-all shadow-lg shadow-primary-500/25 hover:scale-[1.02] active:scale-[0.98]">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>Add Product
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                    <th class="px-6 py-3.5">Product</th>
                    <th class="px-6 py-3.5">Description</th>
                    <th class="px-6 py-3.5">Price</th>
                    <th class="px-6 py-3.5">Unit</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (empty($products)): ?>
                <tr><td colspan="5" class="px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-sharp text-slate-300" style="font-size:32px">inventory_2</span>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">No products yet</p>
                    <a href="/products/create" class="text-primary-500 text-sm font-semibold hover:text-primary-600 mt-2 inline-flex items-center gap-1">Add your first product<span class="material-symbols-sharp" style="font-size:16px">arrow_forward</span></a>
                </td></tr>
                <?php else: foreach ($products as $p): ?>
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/20">
                                <span class="material-symbols-sharp text-white" style="font-size:18px">inventory_2</span>
                            </div>
                            <span class="text-sm font-bold text-slate-900"><?= e($p['name']) ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate"><?= e($p['description'] ?? '-') ?></td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-slate-900">$<?= number_format($p['price'], 2) ?></span>
                        <span class="text-xs text-slate-400">/<?= e($p['unit'] ?? 'unit') ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-50 text-slate-600 ring-1 ring-inset ring-slate-200"><?= ucfirst(e($p['unit'] ?? 'unit')) ?></span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-0.5 opacity-0 group-hover:opacity-100 transition">
                            <a href="/products/<?= $p['id'] ?>/edit" class="p-2 text-slate-400 hover:text-blue-500 rounded-xl hover:bg-slate-100 transition" title="Edit">
                                <span class="material-symbols-sharp" style="font-size:18px">edit</span>
                            </a>
                            <form action="/products/<?= $p['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                <?= csrf_field() ?>
                                <button class="p-2 text-slate-400 hover:text-rose-500 rounded-xl hover:bg-slate-100 transition" title="Delete">
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
