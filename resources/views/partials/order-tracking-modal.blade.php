<!-- Order Tracking Modal -->
<div id="tracking-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <div id="tracking-backdrop" onclick="window.App.closeTrackingModal()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 cursor-pointer"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div id="tracking-panel" class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 scale-95 duration-200">
            <div class="p-6 sm:p-8">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-truck-fast text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-900">Track Your Order</h3>
                            <p class="text-xs text-slate-500">Live Steadfast / Redx Courier Status</p>
                        </div>
                    </div>
                    <button onclick="window.App.closeTrackingModal()" class="text-slate-400 hover:text-slate-700 bg-slate-100 w-8 h-8 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Input Form -->
                <div class="mt-5 space-y-3">
                    <label class="block text-xs font-bold text-slate-700">Order ID, Invoice # or Phone Number</label>
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            id="tracking-query-input" 
                            placeholder="e.g. BD24-171800 or 018XXXXXXXX" 
                            class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
                        >
                        <button 
                            type="button" 
                            onclick="window.App.searchOrderTracking()"
                            class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white text-xs font-black px-5 py-2.5 rounded-xl shadow-md shadow-emerald-600/20 transition cursor-pointer"
                        >
                            Track
                        </button>
                    </div>
                </div>

                <!-- Live Tracking Result Container -->
                <div id="tracking-result" class="mt-6 hidden">
                    <!-- Dynamic timeline injected via JS -->
                </div>

            </div>
        </div>
    </div>
</div>
