<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome back, <?= e($user->name ?? 'User') ?>!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800"><?= $totalUsers ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                </div>
            </div>
            <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> 12% from last month</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Projects</p>
                    <p class="text-3xl font-bold text-gray-800">24</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder text-green-600 text-xl"></i>
                </div>
            </div>
            <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> 8% from last month</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Completed Tasks</p>
                    <p class="text-3xl font-bold text-gray-800">156</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                </div>
            </div>
            <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> 23% from last month</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Revenue</p>
                    <p class="text-3xl font-bold text-gray-800">$12.4k</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                </div>
            </div>
            <p class="text-red-500 text-sm mt-2"><i class="fas fa-arrow-down"></i> 3% from last month</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Activity</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">New user registered</p>
                        <p class="text-gray-500 text-sm">John Doe created an account</p>
                        <p class="text-gray-400 text-xs mt-1">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-project-diagram text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Project updated</p>
                        <p class="text-gray-500 text-sm">E-commerce redesign reached 75%</p>
                        <p class="text-gray-400 text-xs mt-1">5 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-check text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Task completed</p>
                        <p class="text-gray-500 text-sm">API integration finished</p>
                        <p class="text-gray-400 text-xs mt-1">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <a href="/dashboard/users" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-users text-indigo-600"></i>
                    </div>
                    <span class="text-gray-700">Manage Users</span>
                </a>
                <a href="/profile" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user text-green-600"></i>
                    </div>
                    <span class="text-gray-700">Edit Profile</span>
                </a>
                <a href="/contact" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <span class="text-gray-700">Contact Support</span>
                </a>
            </div>
        </div>
    </div>
</div>
