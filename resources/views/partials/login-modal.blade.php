<!-- User / Admin Login Modal -->
<div id="login-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <div id="login-backdrop" onclick="window.App.closeLoginModal()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 cursor-pointer"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div id="login-panel" class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full opacity-0 scale-95 duration-200">
            <div class="p-6 sm:p-8">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-lock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-900">Account Access</h3>
                            <p class="text-xs text-slate-500">Sign in to manage orders & profile</p>
                        </div>
                    </div>
                    <button onclick="window.App.closeLoginModal()" class="text-slate-400 hover:text-slate-700 bg-slate-100 w-8 h-8 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <div class="mt-6 space-y-4">
                    <p class="text-xs text-slate-600">
                        For quick order tracking, please use your phone number in <a href="javascript:void(0)" onclick="window.App.closeLoginModal(); window.App.openTrackingModal();" class="text-emerald-600 font-bold hover:underline">Track Order</a>.
                    </p>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 text-center space-y-3">
                        <p class="text-xs font-bold text-slate-700">Are you a store manager?</p>
                        <a href="{{ route('admin.login') }}" class="block w-full bg-slate-900 hover:bg-black text-white font-bold text-xs py-3 rounded-xl transition shadow-md">
                            Access Admin CMS Dashboard
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
