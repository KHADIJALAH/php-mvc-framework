<?php $user = app\Core\Application::$app->user; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">Welcome back, <?= e($user->name ?? 'User') ?>!</p>
    </div>
    <a href="/invoices/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white rounded-full text-sm font-medium hover:bg-primary-600 transition shadow-sm">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>New Invoice
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-green-600" style="font-size:22px">payments</span>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Revenue</span>
        </div>
        <p class="text-2xl font-bold text-gray-900">$<?= number_format($stats['revenue'] ?? 0, 2) ?></p>
        <p class="text-xs text-gray-500 mt-1">Total revenue</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-blue-600" style="font-size:22px">receipt_long</span>
            </div>
            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Invoices</span>
        </div>
        <p class="text-2xl font-bold text-gray-900"><?= $stats['total_invoices'] ?? 0 ?></p>
        <p class="text-xs text-gray-500 mt-1">Total invoices</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-purple-600" style="font-size:22px">group</span>
            </div>
            <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Clients</span>
        </div>
        <p class="text-2xl font-bold text-gray-900"><?= $stats['client_count'] ?? 0 ?></p>
        <p class="text-xs text-gray-500 mt-1">Active clients</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-red-600" style="font-size:22px">warning</span>
            </div>
            <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-full">Overdue</span>
        </div>
        <p class="text-2xl font-bold text-gray-900">$<?= number_format($stats['overdue_amount'] ?? 0, 2) ?></p>
        <p class="text-xs text-gray-500 mt-1">Overdue amount</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900">Recent Invoices</h2>
        <a href="/invoices" class="text-sm text-primary-500 hover:text-primary-600 font-medium">View all</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Invoice</th>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Amount</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (empty($recentInvoices)): ?>
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">No invoices yet. <a href="/invoices/create" class="text-primary-500 hover:underline">Create your first invoice</a></td></tr>
                <?php else: foreach ($recentInvoices as $inv): ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4"><a href="/invoices/<?= $inv['id'] ?>" class="text-sm font-medium text-gray-900 hover:text-primary-500"><?= e($inv['invoice_number']) ?></a></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?= e($inv['client_name'] ?? 'N/A') ?></td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">$<?= number_format($inv['total'] ?? 0, 2) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($inv['issue_date'])) ?></td>
                    <td class="px-6 py-4">
                        <?php
                        $statusColors = ['paid' => 'green', 'pending' => 'yellow', 'draft' => 'gray', 'overdue' => 'red'];
                        $c = $statusColors[$inv['status']] ?? 'gray';
                        ?>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-<?= $c ?>-50 text-<?= $c ?>-700"><?= ucfirst($inv['status']) ?></span>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
