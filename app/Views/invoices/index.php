<?php $currentStatus = $currentStatus ?? ''; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Invoices</h1>
        <p class="text-slate-500 text-sm mt-1">Manage and track all your invoices</p>
    </div>
    <a href="/invoices/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl text-sm font-bold hover:from-primary-600 hover:to-amber-600 transition-all shadow-lg shadow-primary-500/25 hover:scale-[1.02] active:scale-[0.98]">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>New Invoice
    </a>
</div>

<div class="flex items-center gap-2 mb-6 p-1.5 bg-white rounded-2xl border border-slate-100 inline-flex shadow-sm">
    <?php
    $tabs = ['' => 'All', 'draft' => 'Draft', 'pending' => 'Pending', 'paid' => 'Paid', 'overdue' => 'Overdue'];
    $tabColors = ['' => 'from-slate-800 to-slate-700', 'draft' => 'from-slate-600 to-slate-500', 'pending' => 'from-amber-500 to-amber-600', 'paid' => 'from-emerald-500 to-emerald-600', 'overdue' => 'from-rose-500 to-rose-600'];
    foreach ($tabs as $key => $label):
        $active = $currentStatus === $key;
    ?>
    <a href="/invoices<?= $key ? "?status=$key" : '' ?>" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all <?= $active ? 'bg-gradient-to-r ' . $tabColors[$key] . ' text-white shadow-md' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' ?>"><?= $label ?></a>
    <?php endforeach; ?>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                    <th class="px-6 py-3.5">Invoice #</th>
                    <th class="px-6 py-3.5">Client</th>
                    <th class="px-6 py-3.5">Amount</th>
                    <th class="px-6 py-3.5">Issue Date</th>
                    <th class="px-6 py-3.5">Due Date</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (empty($invoices)): ?>
                <tr><td colspan="7" class="px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-sharp text-slate-300" style="font-size:32px">receipt_long</span>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">No invoices found</p>
                    <a href="/invoices/create" class="text-primary-500 text-sm font-semibold hover:text-primary-600 mt-2 inline-flex items-center gap-1">Create your first invoice<span class="material-symbols-sharp" style="font-size:16px">arrow_forward</span></a>
                </td></tr>
                <?php else: foreach ($invoices as $inv): ?>
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-6 py-4"><a href="/invoices/<?= $inv['id'] ?>" class="text-sm font-bold text-slate-900 hover:text-primary-500 transition"><?= e($inv['invoice_number']) ?></a></td>
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
                    <td class="px-6 py-4 text-sm text-slate-500"><?= date('M d, Y', strtotime($inv['due_date'])) ?></td>
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
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-0.5 opacity-0 group-hover:opacity-100 transition">
                            <a href="/invoices/<?= $inv['id'] ?>" class="p-2 text-slate-400 hover:text-primary-500 rounded-xl hover:bg-slate-100 transition" title="View">
                                <span class="material-symbols-sharp" style="font-size:18px">visibility</span>
                            </a>
                            <a href="/invoices/<?= $inv['id'] ?>/edit" class="p-2 text-slate-400 hover:text-blue-500 rounded-xl hover:bg-slate-100 transition" title="Edit">
                                <span class="material-symbols-sharp" style="font-size:18px">edit</span>
                            </a>
                            <form action="/invoices/<?= $inv['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?')">
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
