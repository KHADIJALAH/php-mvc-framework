<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Add Client</h1>
        <p class="text-gray-500 text-sm mt-1">Add a new client to your directory</p>
    </div>
    <a href="/clients" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
        <span class="material-symbols-sharp" style="font-size:20px">arrow_back</span>Back to Clients
    </a>
</div>

<div class="max-w-2xl">
    <form action="/clients" method="POST" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
        <?= csrf_field() ?>
        <div class="grid md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Client name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="client@example.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                <input type="tel" name="phone" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="+1 (555) 000-0000">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Company</label>
                <input type="text" name="company" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Company name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">City</label>
                <input type="text" name="city" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="City">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label>
                <input type="text" name="country" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Country">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm" placeholder="Full address"></textarea>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white rounded-xl text-sm font-medium hover:bg-primary-600 transition shadow-sm">
                Add Client
            </button>
            <a href="/clients" class="px-6 py-2.5 text-gray-500 text-sm font-medium hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
