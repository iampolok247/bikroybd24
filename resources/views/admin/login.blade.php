<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BikroyBD24</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-4 font-['Inter']">

    <div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-6">
        <div class="text-center space-y-3">
            <img src="{{ asset('logo.png') }}" alt="BikroyBD24" class="h-10 mx-auto brightness-0 invert" onerror="this.src='/logo.png'">
            <h1 class="text-2xl font-black font-['Outfit']">Admin Portal</h1>
            <p class="text-xs text-slate-400">Enter your credentials to access the store management dashboard.</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 p-3.5 rounded-2xl text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Email Address</label>
                <div class="relative">
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', 'admin@bikroybd24.com') }}" 
                        required 
                        class="w-full bg-slate-800 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition"
                    >
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        value="admin123" 
                        required 
                        class="w-full bg-slate-800 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition"
                    >
                </div>
            </div>

            <button 
                type="submit" 
                class="w-full bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-slate-950 font-black text-xs sm:text-sm py-3.5 rounded-2xl transition shadow-lg shadow-emerald-600/25"
            >
                Sign In to Dashboard
            </button>
        </form>

        <div class="pt-4 border-t border-slate-800 text-center text-xs text-slate-500">
            <p>Default Login: <strong class="text-emerald-400">admin@bikroybd24.com</strong> / <strong class="text-emerald-400">admin123</strong></p>
            <div class="mt-3">
                <a href="{{ route('home') }}" class="text-slate-400 hover:text-white transition">← Return to Website</a>
            </div>
        </div>
    </div>

</body>
</html>
