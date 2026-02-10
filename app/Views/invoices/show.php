<?php
$inv = $invoice;
$statusColors = ['paid'=>'green','pending'=>'yellow','draft'=>'gray','overdue'=>'red'];
$c = $statusColors[$inv['status']] ?? 'gray';
?>
<div class="flex items-center justify-between mb-8 no-print">
    <div class="flex items-center gap-4">
        <a href="/invoices" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <span class="material-symbols-sharp" style="font-size:22px">arrow_back</span>
        </a>
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-900"><?= e($inv['invoice_number']) ?></h1>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-<?= $c ?>-50 text-<?= $c ?>-700"><?= ucfirst($inv['status']) ?></span>
            </div>
            <p class="text-gray-500 text-sm mt-1">Created <?= date('M d, Y', strtotime($inv['issue_date'])) ?></p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <?php if ($inv['status'] !== 'paid'): ?>
        <form action="/invoices/<?= $inv['id'] ?>/status" method="POST" class="inline">
            <?= csrf_field() ?>
            <input type="hidden" name="status" value="paid">
            <button class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-full text-sm font-medium hover:bg-green-600 transition">
                <span class="material-symbols-sharp" style="font-size:18px">check_circle</span>Mark Paid
            </button>
        </form>
        <?php endif; ?>
        <a href="/invoices/<?= $inv['id'] ?>/edit" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-50 transition">
            <span class="material-symbols-sharp" style="font-size:18px">edit</span>Edit
        </a>
        <form action="/invoices/<?= $inv['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?')">
            <?= csrf_field() ?>
            <button class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100 transition">
                <span class="material-symbols-sharp" style="font-size:18px">delete</span>
            </button>
        </form>
    </div>
</div>

<style>@media print { .invoice-grid { display: block !important; } .invoice-grid > .lg\:col-span-2 { width: 100% !important; max-width: 100% !important; } }</style>
<div class="grid lg:grid-cols-3 gap-6 invoice-grid">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-8">
            <div class="flex justify-between mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-sharp text-primary-500" style="font-size:24px">receipt_long</span>
                        <span class="text-lg font-bold text-gray-900">INVOICEFLOW</span>
                    </div>
                    <p class="text-sm text-gray-500">Invoice <?= e($inv['invoice_number']) ?></p>
                </div>
                <div class="text-right text-sm text-gray-500">
                    <p><strong>Issue:</strong> <?= date('M d, Y', strtotime($inv['issue_date'])) ?></p>
                    <p><strong>Due:</strong> <?= date('M d, Y', strtotime($inv['due_date'])) ?></p>
                </div>
            </div>

            <div class="mb-8 p-4 bg-gray-50 rounded-xl">
                <p class="text-xs font-medium text-gray-400 uppercase mb-1">Bill To</p>
                <p class="text-sm font-semibold text-gray-900"><?= e($inv['client_name'] ?? 'N/A') ?></p>
                <?php if (!empty($inv['client_email'])): ?><p class="text-sm text-gray-500"><?= e($inv['client_email']) ?></p><?php endif; ?>
            </div>

            <table class="w-full mb-6">
                <thead>
                    <tr class="text-left text-xs font-medium text-gray-400 uppercase border-b border-gray-100">
                        <th class="pb-3">Description</th>
                        <th class="pb-3 text-right">Qty</th>
                        <th class="pb-3 text-right">Price</th>
                        <th class="pb-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach ($inv['items'] ?? [] as $item): ?>
                    <tr>
                        <td class="py-3 text-sm text-gray-700"><?= e($item['description']) ?></td>
                        <td class="py-3 text-sm text-gray-500 text-right"><?= $item['quantity'] ?></td>
                        <td class="py-3 text-sm text-gray-500 text-right">$<?= number_format($item['unit_price'], 2) ?></td>
                        <td class="py-3 text-sm font-medium text-gray-900 text-right">$<?= number_format($item['total'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="border-t border-gray-100 pt-4 space-y-2">
                <div class="flex justify-between text-sm"><span class="text-gray-500">Subtotal</span><span class="font-medium">$<?= number_format($inv['subtotal'] ?? 0, 2) ?></span></div>
                <?php if (($inv['tax_rate'] ?? 0) > 0): ?>
                <div class="flex justify-between text-sm"><span class="text-gray-500">Tax (<?= $inv['tax_rate'] ?>%)</span><span class="font-medium">$<?= number_format($inv['tax_amount'] ?? 0, 2) ?></span></div>
                <?php endif; ?>
                <div class="flex justify-between text-lg pt-2 border-t border-gray-100"><span class="font-bold text-gray-900">Total</span><span class="font-bold text-primary-600">$<?= number_format($inv['total'] ?? 0, 2) ?></span></div>
            </div>
        </div>

        <?php if (!empty($inv['notes'])): ?>
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-2">Notes</h3>
            <p class="text-sm text-gray-600"><?= nl2br(e($inv['notes'])) ?></p>
        </div>
        <?php endif; ?>
    </div>

    <div class="space-y-6 no-print">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-2">
                <?php if ($inv['status'] === 'draft'): ?>
                <form action="/invoices/<?= $inv['id'] ?>/status" method="POST">
                    <?= csrf_field() ?><input type="hidden" name="status" value="pending">
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-50 border border-gray-200 transition">
                        <span class="material-symbols-sharp text-yellow-500" style="font-size:20px">send</span>Send Invoice
                    </button>
                </form>
                <?php endif; ?>
                <?php if ($inv['status'] === 'pending'): ?>
                <form action="/invoices/<?= $inv['id'] ?>/status" method="POST">
                    <?= csrf_field() ?><input type="hidden" name="status" value="paid">
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-50 border border-gray-200 transition">
                        <span class="material-symbols-sharp text-green-500" style="font-size:20px">check_circle</span>Mark as Paid
                    </button>
                </form>
                <form action="/invoices/<?= $inv['id'] ?>/status" method="POST">
                    <?= csrf_field() ?><input type="hidden" name="status" value="overdue">
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-50 border border-gray-200 transition">
                        <span class="material-symbols-sharp text-red-500" style="font-size:20px">warning</span>Mark Overdue
                    </button>
                </form>
                <?php endif; ?>
                <button onclick="window.print()" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-50 border border-gray-200 transition">
                    <span class="material-symbols-sharp text-blue-500" style="font-size:20px">print</span>Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>
