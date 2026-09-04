<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - BikroyBD24')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', 'Inter', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Left Admin Sidebar -->
        <aside class="w-64 bg-slate-950 border-r border-slate-800 flex flex-col justify-between shrink-0 hidden md:flex">
            <div>
                <!-- Brand Header -->
                <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('logo.png') }}" alt="BikroyBD24" class="h-8 w-auto brightness-0 invert" onerror="this.src='/logo.png'">
                    </a>
                </div>

                <!-- Admin Navigation Menu -->
                <nav class="p-4 space-y-1 text-xs font-bold text-slate-400">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie text-sm"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.orders') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-box-open text-sm"></i>
                        <span>Orders</span>
                    </a>

                    <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.products') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-tags text-sm"></i>
                        <span>Products</span>
                    </a>

                    <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.categories') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-grid-2 text-sm"></i>
                        <span>Categories</span>
                    </a>

                    <a href="{{ route('admin.coupons') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.coupons') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-ticket text-sm"></i>
                        <span>Coupons</span>
                    </a>

                    <a href="{{ route('admin.customers') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.customers') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-users text-sm"></i>
                        <span>Customers</span>
                    </a>

                    <a href="{{ route('admin.cms') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.cms') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-pen-ruler text-sm"></i>
                        <span>CMS & Banners</span>
                    </a>

                    <a href="{{ route('admin.integrations') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.integrations') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-plug text-sm"></i>
                        <span>Integrations & AI</span>
                    </a>

                    <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.audit-logs') ? 'bg-emerald-600 text-white font-extrabold shadow-lg shadow-emerald-600/20' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-scroll text-sm"></i>
                        <span>Audit Logs</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Store Link & Logout -->
            <div class="p-4 border-t border-slate-800 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-emerald-400 text-xs font-bold py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-store"></i> View Live Store
                </a>
                <a href="{{ route('admin.logout') }}" class="w-full flex items-center justify-center gap-2 text-rose-400 hover:text-rose-300 text-xs font-bold py-2 rounded-xl transition">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Right Main Workspace -->
        <div class="flex-1 flex flex-col overflow-hidden bg-slate-900">
            
            <!-- Top Admin Header Bar -->
            <header class="h-16 bg-slate-950 border-b border-slate-800 px-6 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="md:hidden">
                        <img src="{{ asset('logo.png') }}" alt="BikroyBD24" class="h-7 w-auto brightness-0 invert">
                    </a>
                    <h2 class="text-sm sm:text-base font-extrabold text-white">@yield('page_title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-4 text-xs font-bold">
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-black">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <span class="hidden sm:inline-block">{{ session('admin_name', 'Administrator') }}</span>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
                @if(session('success'))
                    <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-4 rounded-2xl text-xs font-bold flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-rose-500/20 border border-rose-500 text-rose-300 p-4 rounded-2xl text-xs font-bold flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    <!-- Admin Global JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
