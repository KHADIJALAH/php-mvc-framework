<?php $c = $client; ?>
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <a href="/clients" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <span class="material-symbols-sharp" style="font-size:22px">arrow_back</span>
        </a>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 font-bold text-lg">
                <?= strtoupper(substr($c['name'], 0, 2)) ?>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900"><?= e($c['name']) ?></h1>
                <?php if (!empty($c['company'])): ?><p class="text-gray-500 text-sm"><?= e($c['company']) ?></p><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="/clients/<?= $c['id'] ?>/edit" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-50 transition">
            <span class="material-symbols-sharp" style="font-size:18px">edit</span>Edit
        </a>
        <form action="/clients/<?= $c['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this client and all related data?')">
            <?= csrf_field() ?>
            <button class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100 transition">
                <span class="material-symbols-sharp" style="font-size:18px">delete</span>
            </button>
        </form>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">Contact Info</h3>
            <div class="space-y-3">
                <?php if (!empty($c['email'])): ?>
                <div class="flex items-center gap-3 text-sm">
                    <span class="material-symbols-sharp text-gray-400" style="font-size:18px">mail</span>
                    <span class="text-gray-600"><?= e($c['email']) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($c['phone'])): ?>
                <div class="flex items-center gap-3 text-sm">
                    <span class="material-symbols-sharp text-gray-400" style="font-size:18px">phone</span>
                    <span class="text-gray-600"><?= e($c['phone']) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($c['address'])): ?>
                <div class="flex items-center gap-3 text-sm">
                    <span class="material-symbols-sharp text-gray-400" style="font-size:18px">location_on</span>
                    <span class="text-gray-600"><?= e($c['address']) ?><?= !empty($c['city']) ? ', '.e($c['city']) : '' ?><?= !empty($c['country']) ? ', '.e($c['country']) : '' ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-2">Quick Actions</h3>
            <a href="/invoices/create" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-50 border border-gray-200 transition mt-3">
                <span class="material-symbols-sharp text-primary-500" style="font-size:20px">add</span>Create Invoice
            </a>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Invoices</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider border-b border-gray-50">
                            <th class="px-6 py-3">Invoice #</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if (empty($invoices)): ?>
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">No invoices for this client</td></tr>
                        <?php else: foreach ($invoices as $inv): ?>
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-3"><a href="/invoices/<?= $inv['id'] ?>" class="text-sm font-medium text-gray-900 hover:text-primary-500"><?= e($inv['invoice_number']) ?></a></td>
                            <td class="px-6 py-3 text-sm font-semibold text-gray-900">$<?= number_format($inv['total'] ?? 0, 2) ?></td>
                            <td class="px-6 py-3 text-sm text-gray-500"><?= date('M d, Y', strtotime($inv['issue_date'])) ?></td>
                            <td class="px-6 py-3">
                                <?php $sc=['paid'=>'green','pending'=>'yellow','draft'=>'gray','overdue'=>'red']; $col=$sc[$inv['status']]??'gray'; ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-<?= $col ?>-50 text-<?= $col ?>-700"><?= ucfirst($inv['status']) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
