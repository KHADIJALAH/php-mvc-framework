<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Clients</h1>
        <p class="text-slate-500 text-sm mt-1">Manage your client directory</p>
    </div>
    <a href="/clients/create" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl text-sm font-bold hover:from-primary-600 hover:to-amber-600 transition-all shadow-lg shadow-primary-500/25 hover:scale-[1.02] active:scale-[0.98]">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>Add Client
    </a>
</div>

<?php if (empty($clients)): ?>
<div class="bg-white rounded-2xl border border-slate-100 py-20 text-center shadow-sm">
    <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
        <span class="material-symbols-sharp text-slate-300" style="font-size:40px">group</span>
    </div>
    <p class="text-slate-600 text-sm font-medium">No clients yet</p>
    <p class="text-slate-400 text-xs mt-1 mb-4">Start building your client directory</p>
    <a href="/clients/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-primary-500 to-amber-500 text-white rounded-2xl text-sm font-bold shadow-lg shadow-primary-500/25 hover:scale-[1.02] transition-all">
        <span class="material-symbols-sharp" style="font-size:18px">add</span>Add First Client
    </a>
</div>
<?php else: ?>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    <?php foreach ($clients as $client): ?>
    <a href="/clients/<?= $client['id'] ?>" class="bg-white rounded-2xl border border-slate-100 p-6 hover:shadow-lg hover:border-primary-200 transition-all group relative overflow-hidden">
        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary-500/5 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition"></div>
        <div class="flex items-start gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-amber-500 rounded-2xl flex items-center justify-center text-white font-bold text-sm shrink-0 shadow-lg shadow-primary-500/20">
                <?= strtoupper(substr($client['name'], 0, 2)) ?>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary-500 transition truncate"><?= e($client['name']) ?></h3>
                <?php if (!empty($client['company'])): ?>
                <p class="text-xs text-slate-500 mt-0.5 truncate font-medium"><?= e($client['company']) ?></p>
                <?php endif; ?>
                <div class="mt-3 space-y-1.5">
                    <?php if (!empty($client['email'])): ?>
                    <p class="text-xs text-slate-400 flex items-center gap-1.5 truncate">
                        <span class="material-symbols-sharp" style="font-size:14px">mail</span><?= e($client['email']) ?>
                    </p>
                    <?php endif; ?>
                    <?php if (!empty($client['phone'])): ?>
                    <p class="text-xs text-slate-400 flex items-center gap-1.5">
                        <span class="material-symbols-sharp" style="font-size:14px">phone</span><?= e($client['phone']) ?>
                    </p>
                    <?php endif; ?>
                    <?php if (!empty($client['city']) || !empty($client['country'])): ?>
                    <p class="text-xs text-slate-400 flex items-center gap-1.5">
                        <span class="material-symbols-sharp" style="font-size:14px">location_on</span><?= e(trim(($client['city'] ?? '') . ', ' . ($client['country'] ?? ''), ', ')) ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <span class="material-symbols-sharp text-slate-300 group-hover:text-primary-400 transition" style="font-size:20px">chevron_right</span>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
