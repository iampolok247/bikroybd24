<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BikroyBD24 - Bangladesh Premium Online Shopping')</title>
    <meta name="description" content="@yield('meta_description', 'Discover best deals on smartphones, gadgets, electronics, lifestyle and fashion in Bangladesh with Cash on Delivery and express shipping.')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN (Full utility suite) -->
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
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', 'Inter', sans-serif; }
        .gradient-emerald { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .gradient-dark { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white pb-16 lg:pb-0">

    <!-- Top Announcement Bar -->
    @include('partials.top-banner')

    <!-- Main Header -->
    @include('partials.header')

    <!-- Navigation Bar -->
    @include('partials.navbar')

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Mobile Bottom Navigation Bar -->
    @include('partials.mobile-bottom-nav')

    <!-- Cart Drawer Modal -->
    @include('partials.cart-drawer')

    <!-- Mobile Category & Menu Drawer -->
    @include('partials.mobile-menu')

    <!-- Quick View Modal -->
    @include('partials.quick-view-modal')

    <!-- Order Tracking Modal -->
    @include('partials.order-tracking-modal')

    <!-- Login / Account Modal -->
    @include('partials.login-modal')

    <!-- Live Gemini AI Chatbot -->
    @include('partials.ai-chatbot')

    <!-- WhatsApp Floating Action Button -->
    @include('partials.whatsapp-button')

    <!-- Toast Notification Container -->
    @include('partials.toast')

    <!-- Global Core Application JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
