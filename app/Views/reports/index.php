<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Reports</h1>
        <p class="text-gray-500 text-sm mt-1">Financial overview and analytics</p>
    </div>
</div>

<div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-green-600" style="font-size:22px">trending_up</span>
            </div>
            <span class="text-sm font-medium text-gray-500">Total Revenue</span>
        </div>
        <?php $totalRev = 0; foreach ($monthlyRevenue ?? [] as $m) $totalRev += $m['revenue']; ?>
        <p class="text-3xl font-bold text-gray-900">$<?= number_format($totalRev, 2) ?></p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-blue-600" style="font-size:22px">receipt_long</span>
            </div>
            <span class="text-sm font-medium text-gray-500">Total Invoices</span>
        </div>
        <?php $totalInv = 0; foreach ($statusBreakdown ?? [] as $s) $totalInv += $s['count']; ?>
        <p class="text-3xl font-bold text-gray-900"><?= $totalInv ?></p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                <span class="material-symbols-sharp text-purple-600" style="font-size:22px">group</span>
            </div>
            <span class="text-sm font-medium text-gray-500">Top Clients</span>
        </div>
        <p class="text-3xl font-bold text-gray-900"><?= count($topClients ?? []) ?></p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-base font-semibold text-gray-900 mb-4">Invoice Status Breakdown</h2>
        <?php if (empty($statusBreakdown)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">No data available</p>
        <?php else: ?>
        <div class="space-y-4">
            <?php
            $colors = ['paid'=>'green','pending'=>'yellow','draft'=>'gray','overdue'=>'red'];
            $maxCount = max(array_column($statusBreakdown, 'count'));
            foreach ($statusBreakdown as $s):
                $col = $colors[$s['status']] ?? 'gray';
                $pct = $maxCount > 0 ? ($s['count'] / $maxCount) * 100 : 0;
            ?>
            <div>
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700"><?= ucfirst($s['status']) ?></span>
                    <span class="text-gray-500"><?= $s['count'] ?> invoices &middot; $<?= number_format($s['total'] ?? 0, 2) ?></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-<?= $col ?>-500 h-2 rounded-full transition-all" style="width:<?= $pct ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-base font-semibold text-gray-900 mb-4">Monthly Revenue (Last 12 Months)</h2>
        <?php if (empty($monthlyRevenue)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">No data available</p>
        <?php else: ?>
        <div class="space-y-3">
            <?php
            $maxRev = max(array_column($monthlyRevenue, 'revenue')) ?: 1;
            foreach (array_reverse($monthlyRevenue) as $m):
                $pct = ($m['revenue'] / $maxRev) * 100;
            ?>
            <div>
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="text-gray-600"><?= $m['month'] ?></span>
                    <span class="font-medium text-gray-900">$<?= number_format($m['revenue'], 2) ?></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-primary-500 h-2 rounded-full transition-all" style="width:<?= $pct ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100">
    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">Top Clients by Revenue</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-medium text-gray-400 uppercase tracking-wider border-b border-gray-50">
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Client</th>
                    <th class="px-6 py-3">Invoices</th>
                    <th class="px-6 py-3 text-right">Revenue</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (empty($topClients)): ?>
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">No client data yet</td></tr>
                <?php else: $i=1; foreach ($topClients as $tc): ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 text-sm text-gray-400"><?= $i++ ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-primary-50 rounded-lg flex items-center justify-center text-primary-600 font-semibold text-xs">
                                <?= strtoupper(substr($tc['client_name'], 0, 2)) ?>
                            </div>
                            <span class="text-sm font-medium text-gray-900"><?= e($tc['client_name']) ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= $tc['invoice_count'] ?></td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right">$<?= number_format($tc['total_revenue'], 2) ?></td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
