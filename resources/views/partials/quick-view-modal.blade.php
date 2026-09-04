<!-- Quick View Modal -->
<div id="quickview-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <!-- Backdrop -->
        <div id="quickview-backdrop" onclick="window.App.closeQuickView()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 cursor-pointer"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal Card -->
        <div id="quickview-panel" class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full opacity-0 scale-95 duration-200">
            <div class="relative p-6 sm:p-8">
                
                <!-- Close Button -->
                <button onclick="window.App.closeQuickView()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 w-9 h-9 rounded-full flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <!-- Image -->
                    <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 flex items-center justify-center p-4">
                        <img id="qv-image" src="" alt="" class="max-h-72 object-contain mx-auto rounded-xl">
                    </div>

                    <!-- Details -->
                    <div class="space-y-4">
                        <div>
                            <span id="qv-category" class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full"></span>
                            <h3 id="qv-title" class="text-lg sm:text-xl font-extrabold text-slate-900 mt-2"></h3>
                            <div class="flex items-center gap-2 mt-1">
                                <div id="qv-stars" class="flex text-amber-400 text-xs"></div>
                                <span id="qv-reviews" class="text-xs text-slate-400 font-semibold"></span>
                            </div>
                        </div>

                        <!-- Price Row -->
                        <div class="flex items-baseline gap-3">
                            <span id="qv-price" class="text-2xl sm:text-3xl font-black text-slate-900"></span>
                            <span id="qv-oldprice" class="text-sm font-semibold text-slate-400 line-through"></span>
                            <span id="qv-discount" class="text-xs font-extrabold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md"></span>
                        </div>

                        <p id="qv-desc" class="text-xs text-slate-600 leading-relaxed"></p>

                        <!-- Stock Status -->
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span id="qv-stock" class="text-emerald-700">In Stock (Fast Delivery in BD)</span>
                        </div>

                        <!-- Quantity and Add to Cart -->
                        <div class="flex items-center gap-3 pt-2">
                            <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden bg-slate-50">
                                <button onclick="window.App.decrementQvQty()" class="px-3 py-2 text-slate-600 hover:bg-slate-200 transition font-bold cursor-pointer">-</button>
                                <input type="number" id="qv-quantity" value="1" min="1" max="99" class="w-12 text-center bg-transparent text-sm font-bold focus:outline-none">
                                <button onclick="window.App.incrementQvQty()" class="px-3 py-2 text-slate-600 hover:bg-slate-200 transition font-bold cursor-pointer">+</button>
                            </div>
                            <button id="qv-add-btn" onclick="window.App.addCurrentQvToCart()" class="flex-1 bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-extrabold text-xs sm:text-sm py-3 px-4 rounded-xl shadow-lg shadow-emerald-600/20 transition flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-cart-plus"></i>
                                <span>Add to Cart</span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
