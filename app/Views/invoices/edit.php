<?php $inv = $invoice; ?>
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Invoice</h1>
        <p class="text-gray-500 text-sm mt-1">Update invoice <?= e($inv['invoice_number']) ?></p>
    </div>
    <a href="/invoices/<?= $inv['id'] ?>" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
        <span class="material-symbols-sharp" style="font-size:20px">arrow_back</span>Back to Invoice
    </a>
</div>

<form action="/invoices/<?= $inv['id'] ?>/update" method="POST" id="invoiceForm">
    <?= csrf_field() ?>
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Invoice Details</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Invoice Number</label>
                        <input type="text" name="invoice_number" value="<?= e($inv['invoice_number']) ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Client</label>
                        <select name="client_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm">
                            <?php foreach ($clients ?? [] as $client): ?>
                            <option value="<?= $client['id'] ?>" <?= (int)$client['id'] === (int)$inv['client_id'] ? 'selected' : '' ?>><?= e($client['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Issue Date</label>
                        <input type="date" name="issue_date" value="<?= $inv['issue_date'] ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Due Date</label>
                        <input type="date" name="due_date" value="<?= $inv['due_date'] ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm">
                            <?php foreach (['draft','pending','paid','overdue'] as $s): ?>
                            <option value="<?= $s ?>" <?= $inv['status'] === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" value="<?= $inv['tax_rate'] ?? 0 ?>" step="0.01" min="0" max="100" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-gray-900">Line Items</h2>
                    <button type="button" onclick="addItem()" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm text-primary-500 hover:bg-primary-50 rounded-lg transition">
                        <span class="material-symbols-sharp" style="font-size:18px">add</span>Add Item
                    </button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-400 uppercase">
                            <th class="pb-3 pr-4">Product</th>
                            <th class="pb-3 pr-4">Description</th>
                            <th class="pb-3 pr-4 w-24">Qty</th>
                            <th class="pb-3 pr-4 w-32">Price</th>
                            <th class="pb-3 pr-4 w-32">Total</th>
                            <th class="pb-3 w-10"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody">
                        <?php foreach ($inv['items'] ?? [] as $item): ?>
                        <tr class="item-row">
                            <td class="pb-3 pr-4">
                                <select name="item_product_id[]" onchange="fillProduct(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                                    <option value="">Custom</option>
                                    <?php foreach ($products ?? [] as $p): ?>
                                    <option value="<?= $p['id'] ?>" data-name="<?= e($p['name']) ?>" data-price="<?= $p['price'] ?>" <?= (int)($item['product_id'] ?? 0) === (int)$p['id'] ? 'selected' : '' ?>><?= e($p['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="pb-3 pr-4"><input type="text" name="item_description[]" value="<?= e($item['description']) ?>" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><input type="number" name="item_quantity[]" value="<?= $item['quantity'] ?>" min="1" step="0.01" onchange="calcRow(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><input type="number" name="item_price[]" value="<?= $item['unit_price'] ?>" step="0.01" min="0" onchange="calcRow(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><span class="row-total text-sm font-semibold text-gray-700">$<?= number_format($item['total'], 2) ?></span></td>
                            <td class="pb-3"><button type="button" onclick="removeItem(this)" class="p-1 text-gray-400 hover:text-red-500"><span class="material-symbols-sharp" style="font-size:18px">close</span></button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($inv['items'])): ?>
                        <tr class="item-row">
                            <td class="pb-3 pr-4"><select name="item_product_id[]" onchange="fillProduct(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"><option value="">Custom</option><?php foreach ($products ?? [] as $p): ?><option value="<?= $p['id'] ?>" data-name="<?= e($p['name']) ?>" data-price="<?= $p['price'] ?>"><?= e($p['name']) ?></option><?php endforeach; ?></select></td>
                            <td class="pb-3 pr-4"><input type="text" name="item_description[]" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><input type="number" name="item_quantity[]" value="1" min="1" step="0.01" onchange="calcRow(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><input type="number" name="item_price[]" value="0" step="0.01" min="0" onchange="calcRow(this)" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm"></td>
                            <td class="pb-3 pr-4"><span class="row-total text-sm font-semibold text-gray-700">$0.00</span></td>
                            <td class="pb-3"><button type="button" onclick="removeItem(this)" class="p-1 text-gray-400 hover:text-red-500"><span class="material-symbols-sharp" style="font-size:18px">close</span></button></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Notes</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 text-sm"><?= e($inv['notes'] ?? '') ?></textarea>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-8">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Summary</h2>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Subtotal</span><span id="subtotal" class="font-medium">$<?= number_format($inv['subtotal'] ?? 0, 2) ?></span></div>
                    <div class="flex justify-between text-sm"><span class="text-gray-500">Tax</span><span id="taxAmount" class="font-medium">$<?= number_format($inv['tax_amount'] ?? 0, 2) ?></span></div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between"><span class="font-semibold">Total</span><span id="totalAmount" class="text-xl font-bold text-primary-600">$<?= number_format($inv['total'] ?? 0, 2) ?></span></div>
                </div>
                <button type="submit" class="w-full mt-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition text-sm shadow-lg shadow-primary-500/30">
                    Update Invoice
                </button>
            </div>
        </div>
    </div>
</form>

<script>
function addItem() {
    const tbody = document.getElementById('itemsBody');
    const row = tbody.querySelector('.item-row').cloneNode(true);
    row.querySelectorAll('input[type="text"],input[type="number"]').forEach(i => { if(i.name==='item_quantity[]') i.value='1'; else if(i.type==='number') i.value='0'; else i.value=''; });
    row.querySelector('select').selectedIndex = 0;
    row.querySelector('.row-total').textContent = '$0.00';
    tbody.appendChild(row);
}
function removeItem(btn) { const rows = document.querySelectorAll('.item-row'); if(rows.length > 1){btn.closest('tr').remove(); calcTotals();} }
function fillProduct(sel) { const opt = sel.options[sel.selectedIndex]; const row = sel.closest('tr'); if(opt.dataset.name){row.querySelector('[name="item_description[]"]').value=opt.dataset.name; row.querySelector('[name="item_price[]"]').value=opt.dataset.price||0; calcRow(sel);} }
function calcRow(el) { const row = el.closest('tr'); const q = parseFloat(row.querySelector('[name="item_quantity[]"]').value)||0; const p = parseFloat(row.querySelector('[name="item_price[]"]').value)||0; row.querySelector('.row-total').textContent = '$'+(q*p).toFixed(2); calcTotals(); }
function calcTotals() { let sub=0; document.querySelectorAll('.item-row').forEach(r=>{const q=parseFloat(r.querySelector('[name="item_quantity[]"]').value)||0;const p=parseFloat(r.querySelector('[name="item_price[]"]').value)||0;sub+=q*p;}); const tx=parseFloat(document.querySelector('[name="tax_rate"]').value)||0; const t=sub*tx/100; document.getElementById('subtotal').textContent='$'+sub.toFixed(2); document.getElementById('taxAmount').textContent='$'+t.toFixed(2); document.getElementById('totalAmount').textContent='$'+(sub+t).toFixed(2); }
document.querySelector('[name="tax_rate"]').addEventListener('change', calcTotals);
</script>
