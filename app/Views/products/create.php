<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Add Product/Service</h1>
        <p class="text-gray-500 text-sm mt-1">Add a new item to your catalog</p>
    </div>
    <a href="/products" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
        <span class="material-symbols-sharp" style="font-size:20px">arrow_back</span>Back to Products
    </a>
</div>

<div class="max-w-2xl">
    <form action="/products" method="POST" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
        <?= csrf_field() ?>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Name *</label>
            <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Product or service name">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Brief description"></textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Price *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 text-sm">$</span>
                    <input type="number" name="price" required step="0.01" min="0" class="w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="0.00">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Unit</label>
                <select name="unit" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                    <option value="unit">Unit</option>
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="project">Project</option>
                    <option value="month">Month</option>
                    <option value="service">Service</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">Add Product</button>
            <a href="/products" class="px-6 py-2.5 text-gray-500 text-sm font-medium hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
