<?php $currentStatus = $currentStatus ?? ''; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Invoices</h1>
        <p class="text-gray-500 text-sm mt-1">Manage and track all your invoices</p>
    </div>
    <a href="/invoices/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white rounded-full text-sm font-medium hover:bg-primary-600 transition shadow-sm">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>New Invoice
    </a>
</div>

<div class="flex items-center gap-2 mb-6">
    <a href="/invoices" class="px-4 py-2 rounded-full text-sm font-medium <?= !$currentStatus ? 'bg-primary-500 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?> transition">All</a>
    <a href="/invoices?status=draft" class="px-4 py-2 rounded-full text-sm font-medium <?= $currentStatus==='draft' ? 'bg-gray-700 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?> transition">Draft</a>
    <a href="/invoices?status=pending" class="px-4 py-2 rounded-full text-sm font-medium <?= $currentStatus==='pending' ? 'bg-yellow-500 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?> transition">Pending</a>
    <a href="/invoices?status=paid" class="px-4 py-2 rounded-full text-sm font-medium <?= $currentStatus==='paid' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?> transition">Paid</a>
    <a href="/invoices?status=overdue" class="px-4 py-2 rounded-full text-sm font-medium <?= $currentStatus==='overdue' ? 'bg-red-500 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?> transition">Overdue</a>
</div>

<div class="bg-white rounded-2xl border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4">Invoice #</th>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Amount</th>
                    <th class="px-6 py-4">Issue Date</th>
                    <th class="px-6 py-4">Due Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (empty($invoices)): ?>
                <tr><td colspan="7" class="px-6 py-16 text-center">
                    <span class="material-symbols-sharp text-gray-300 mb-3 block" style="font-size:48px">receipt_long</span>
                    <p class="text-gray-500 text-sm">No invoices found</p>
                    <a href="/invoices/create" class="text-primary-500 text-sm hover:underline mt-1 inline-block">Create your first invoice</a>
                </td></tr>
                <?php else: foreach ($invoices as $inv): ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4"><a href="/invoices/<?= $inv['id'] ?>" class="text-sm font-semibold text-gray-900 hover:text-primary-500"><?= e($inv['invoice_number']) ?></a></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= e($inv['client_name'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">$<?= number_format($inv['total'] ?? 0, 2) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($inv['issue_date'])) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($inv['due_date'])) ?></td>
                    <td class="px-6 py-4">
                        <?php
                        $sc = ['paid'=>'green','pending'=>'yellow','draft'=>'gray','overdue'=>'red'];
                        $c = $sc[$inv['status']] ?? 'gray';
                        ?>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-<?= $c ?>-50 text-<?= $c ?>-700"><?= ucfirst($inv['status']) ?></span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="/invoices/<?= $inv['id'] ?>" class="p-2 text-gray-400 hover:text-primary-500 rounded-lg hover:bg-gray-100 transition" title="View">
                                <span class="material-symbols-sharp" style="font-size:18px">visibility</span>
                            </a>
                            <a href="/invoices/<?= $inv['id'] ?>/edit" class="p-2 text-gray-400 hover:text-blue-500 rounded-lg hover:bg-gray-100 transition" title="Edit">
                                <span class="material-symbols-sharp" style="font-size:18px">edit</span>
                            </a>
                            <form action="/invoices/<?= $inv['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?')">
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
