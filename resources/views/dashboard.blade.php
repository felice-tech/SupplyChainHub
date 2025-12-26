<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Sidebar Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold">Laravel App</h1>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors bg-gray-700">
                            <i class="fas fa-home w-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-users w-5"></i>
                            <span class="ml-3">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-box w-5"></i>
                            <span class="ml-3">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-shopping-cart w-5"></i>
                            <span class="ml-3">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-chart-line w-5"></i>
                            <span class="ml-3">Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-cog w-5"></i>
                            <span class="ml-3">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" alt="User" class="w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <p class="text-sm font-medium">Admin User</p>
                        <p class="text-xs text-gray-400">admin@example.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Navigation Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        <button class="p-2 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-user text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-500 text-sm font-medium">Total Users</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">1,234</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-500 text-sm font-medium">Total Orders</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">567</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-gray-500 text-sm font-medium">Revenue</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">$12,345</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>