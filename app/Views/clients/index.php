<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Clients</h1>
        <p class="text-gray-500 text-sm mt-1">Manage your client directory</p>
    </div>
    <a href="/clients/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white rounded-full text-sm font-medium hover:bg-primary-600 transition shadow-sm">
        <span class="material-symbols-sharp" style="font-size:20px">add</span>Add Client
    </a>
</div>

<?php if (empty($clients)): ?>
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center">
    <span class="material-symbols-sharp text-gray-300 mb-3 block" style="font-size:48px">group</span>
    <p class="text-gray-500 text-sm">No clients yet</p>
    <a href="/clients/create" class="text-primary-500 text-sm hover:underline mt-1 inline-block">Add your first client</a>
</div>
<?php else: ?>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($clients as $client): ?>
    <a href="/clients/<?= $client['id'] ?>" class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md hover:border-primary-200 transition group">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 font-bold text-sm shrink-0">
                <?= strtoupper(substr($client['name'], 0, 2)) ?>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-500 transition truncate"><?= e($client['name']) ?></h3>
                <?php if (!empty($client['company'])): ?>
                <p class="text-xs text-gray-500 mt-0.5 truncate"><?= e($client['company']) ?></p>
                <?php endif; ?>
                <?php if (!empty($client['email'])): ?>
                <p class="text-xs text-gray-400 mt-2 flex items-center gap-1 truncate">
                    <span class="material-symbols-sharp" style="font-size:14px">mail</span><?= e($client['email']) ?>
                </p>
                <?php endif; ?>
                <?php if (!empty($client['phone'])): ?>
                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                    <span class="material-symbols-sharp" style="font-size:14px">phone</span><?= e($client['phone']) ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
