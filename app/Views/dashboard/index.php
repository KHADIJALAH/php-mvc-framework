<?php $user = app\Core\Application::$app->user; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <p class="text-sm text-slate-500 mb-1"><?= date('l, F j, Y') ?></p>
        <h1 class="text-2xl font-extrabold text-slate-900">Good <?= date('H') < 12 ? 'morning' : (date('H') < 18 ? 'afternoon' : 'evening') ?>, <?= e(explode(' ', $user->name ?? 'User')[0]) ?></h1>
    </div>
    <a href="/invoices/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl text-sm font-bold hover:from-primary-600 hover:to-amber-600 transition-all shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 hover:scale-[1.02] active:scale-[0.98]">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>New Invoice
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <span class="material-symbols-sharp text-white" style="font-size:22px">payments</span>
            </div>
            <span class="material-symbols-sharp text-emerald-500 opacity-0 group-hover:opacity-100 transition" style="font-size:20px">north_east</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">$<?= number_format($stats['revenue'] ?? 0, 2) ?></p>
        <p class="text-xs text-slate-400 mt-1 font-medium">Total Revenue</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                <span class="material-symbols-sharp text-white" style="font-size:22px">receipt_long</span>
            </div>
            <span class="material-symbols-sharp text-blue-500 opacity-0 group-hover:opacity-100 transition" style="font-size:20px">north_east</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-900"><?= $stats['total_invoices'] ?? 0 ?></p>
        <p class="text-xs text-slate-400 mt-1 font-medium">Total Invoices</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-violet-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                <span class="material-symbols-sharp text-white" style="font-size:22px">group</span>
            </div>
            <span class="material-symbols-sharp text-violet-500 opacity-0 group-hover:opacity-100 transition" style="font-size:20px">north_east</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-900"><?= $stats['client_count'] ?? 0 ?></p>
        <p class="text-xs text-slate-400 mt-1 font-medium">Active Clients</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-rose-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg shadow-rose-500/30">
                <span class="material-symbols-sharp text-white" style="font-size:22px">warning</span>
            </div>
            <span class="material-symbols-sharp text-rose-500 opacity-0 group-hover:opacity-100 transition" style="font-size:20px">north_east</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">$<?= number_format($stats['overdue_amount'] ?? 0, 2) ?></p>
        <p class="text-xs text-slate-400 mt-1 font-medium">Overdue Amount</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <a href="/invoices/create" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:border-primary-200 hover:shadow-md transition-all group">
        <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center group-hover:bg-primary-100 transition">
            <span class="material-symbols-sharp text-primary-500" style="font-size:20px">add_circle</span>
        </div>
        <span class="text-sm font-semibold text-slate-700">New Invoice</span>
    </a>
    <a href="/clients/create" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:border-violet-200 hover:shadow-md transition-all group">
        <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition">
            <span class="material-symbols-sharp text-violet-500" style="font-size:20px">person_add</span>
        </div>
        <span class="text-sm font-semibold text-slate-700">Add Client</span>
    </a>
    <a href="/products/create" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:border-blue-200 hover:shadow-md transition-all group">
        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition">
            <span class="material-symbols-sharp text-blue-500" style="font-size:20px">add_box</span>
        </div>
        <span class="text-sm font-semibold text-slate-700">Add Product</span>
    </a>
    <a href="/reports" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:border-emerald-200 hover:shadow-md transition-all group">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition">
            <span class="material-symbols-sharp text-emerald-500" style="font-size:20px">analytics</span>
        </div>
        <span class="text-sm font-semibold text-slate-700">View Reports</span>
    </a>
</div>

<!-- Recent Invoices -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-sharp text-slate-500" style="font-size:18px">receipt_long</span>
            </div>
            <h2 class="text-base font-bold text-slate-900">Recent Invoices</h2>
        </div>
        <a href="/invoices" class="text-sm text-primary-500 hover:text-primary-600 font-semibold flex items-center gap-1 transition">
            View all<span class="material-symbols-sharp" style="font-size:16px">chevron_right</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                    <th class="px-6 py-3.5">Invoice</th>
                    <th class="px-6 py-3.5">Client</th>
                    <th class="px-6 py-3.5">Amount</th>
                    <th class="px-6 py-3.5">Date</th>
                    <th class="px-6 py-3.5">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (empty($recentInvoices)): ?>
                <tr><td colspan="5" class="px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-sharp text-slate-300" style="font-size:32px">receipt_long</span>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">No invoices yet</p>
                    <a href="/invoices/create" class="text-primary-500 text-sm font-semibold hover:text-primary-600 mt-2 inline-flex items-center gap-1">
                        Create your first invoice<span class="material-symbols-sharp" style="font-size:16px">arrow_forward</span>
                    </a>
                </td></tr>
                <?php else: foreach ($recentInvoices as $inv): ?>
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-6 py-4">
                        <a href="/invoices/<?= $inv['id'] ?>" class="text-sm font-bold text-slate-900 hover:text-primary-500 transition"><?= e($inv['invoice_number']) ?></a>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 bg-gradient-to-br from-slate-200 to-slate-100 rounded-lg flex items-center justify-center text-slate-500 font-bold text-[10px]">
                                <?= strtoupper(substr($inv['client_name'] ?? 'N', 0, 2)) ?>
                            </div>
                            <span class="text-sm text-slate-600"><?= e($inv['client_name'] ?? 'N/A') ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-slate-900">$<?= number_format($inv['total'] ?? 0, 2) ?></td>
                    <td class="px-6 py-4 text-sm text-slate-500"><?= date('M d, Y', strtotime($inv['issue_date'])) ?></td>
                    <td class="px-6 py-4">
                        <?php
                        $sc = [
                            'paid' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                            'pending' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                            'draft' => 'bg-slate-50 text-slate-600 ring-slate-500/20',
                            'overdue' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                        ];
                        $cls = $sc[$inv['status']] ?? $sc['draft'];
                        ?>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold ring-1 ring-inset <?= $cls ?>"><?= ucfirst($inv['status']) ?></span>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
