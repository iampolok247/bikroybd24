@extends('layouts.admin')

@section('title', 'API Integrations - BikroyBD24 Admin')
@section('page_title', 'Third-Party Integrations & AI Setup')

@section('content')
<div class="space-y-6 max-w-4xl">
    <div>
        <h2 class="text-xl font-black text-white">API Integrations</h2>
        <p class="text-xs text-slate-400">Configure Gemini AI, Steadfast Courier, and WhatsApp hotline.</p>
    </div>

    <div class="space-y-6">
        
        <!-- Gemini AI API Configuration -->
        <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 sm:p-8 shadow-sm space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-800">
                <div class="w-10 h-10 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-sparkles"></i>
                </div>
                <div>
                    <h3 class="font-black text-sm text-white">Google Gemini AI Customer Assistant</h3>
                    <p class="text-xs text-slate-400">Powers live chatbot for customer questions</p>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Gemini API Key</label>
                <input 
                    type="password" 
                    id="integration-geminiApiKey"
                    value="{{ env('GEMINI_API_KEY', '') }}" 
                    placeholder="Enter your Gemini API key"
                    class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition font-mono"
                >
            </div>
        </div>

        <!-- Steadfast Courier API -->
        <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 sm:p-8 shadow-sm space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-800">
                <div class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div>
                    <h3 class="font-black text-sm text-white">Steadfast Courier API (Logistics & Fraud Check)</h3>
                    <p class="text-xs text-slate-400">Auto parcel creation and delivery success rate calculation</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1.5">Steadfast API Key</label>
                    <input 
                        type="password" 
                        value="sf_live_key_99218204" 
                        class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition font-mono"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1.5">Secret Key</label>
                    <input 
                        type="password" 
                        value="sf_secret_sec_884192" 
                        class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition font-mono"
                    >
                </div>
            </div>
        </div>

        <!-- WhatsApp Floating Chat & Notification -->
        <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 sm:p-8 shadow-sm space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-800">
                <div class="w-10 h-10 rounded-2xl bg-[#25D366]/10 text-[#25D366] flex items-center justify-center text-xl">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h3 class="font-black text-sm text-white">WhatsApp Direct Hotline</h3>
                    <p class="text-xs text-slate-400">Phone number linked to the floating WhatsApp widget</p>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">WhatsApp Mobile Number</label>
                <input 
                    type="text" 
                    value="+8801854288311" 
                    class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition font-mono"
                >
            </div>
        </div>

        <div class="flex justify-end">
            <button 
                onclick="alert('Integration settings saved successfully!')"
                class="bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-slate-950 font-black text-xs px-6 py-3 rounded-xl transition shadow-md cursor-pointer"
            >
                Save Integration Keys
            </button>
        </div>

    </div>
</div>
@endsection
