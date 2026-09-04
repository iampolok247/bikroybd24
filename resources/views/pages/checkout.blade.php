@extends('layouts.app')

@section('title', 'Checkout & Order Placement - BikroyBD24')

@section('content')
<div class="max-w-[1200px] mx-auto px-3 sm:px-4 py-8">
    
    <div class="text-center max-w-xl mx-auto mb-8 space-y-2">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
            Fast 1-Step Checkout
        </span>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900">Complete Your Order</h1>
        <p class="text-xs text-slate-500">Provide your delivery details below to confirm your order with Cash on Delivery.</p>
    </div>

    <form id="checkout-form" onsubmit="window.App.handleCheckoutSubmit(event)">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Form Fields -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- 1. Customer Information Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            1
                        </div>
                        <h3 class="text-base font-black text-slate-900">Delivery Information</h3>
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1.5">
                            Customer Full Name <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="customerName" 
                            id="checkout-name" 
                            required 
                            placeholder="e.g. মোঃ তানভীর আহমেদ"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
                        >
                    </div>

                    <!-- Phone Number with Fraud / Courier Trust check -->
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1.5 flex justify-between items-center">
                            <span>Phone Number (১১ ডিজিট মোবাইল নম্বর) <span class="text-rose-500">*</span></span>
                            <span id="courier-trust-badge" class="hidden text-[10px] font-bold px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800">
                                <i class="fa-solid fa-shield-check"></i> Verified Customer
                            </span>
                        </label>
                        <div class="relative">
                            <input 
                                type="tel" 
                                name="phone" 
                                id="checkout-phone" 
                                required 
                                placeholder="017XXXXXXXX"
                                maxlength="14"
                                oninput="window.App.checkPhoneTrust(this.value)"
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition tracking-wider"
                            >
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">We will call or SMS you on this number to confirm the parcel.</p>
                    </div>

                    <!-- Full Delivery Address -->
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1.5">
                            Full Delivery Address (সম্পূর্ণ ঠিকানা) <span class="text-rose-500">*</span>
                        </label>
                        <textarea 
                            name="address" 
                            id="checkout-address" 
                            rows="2" 
                            required 
                            placeholder="House / Flat No, Road No, Area / Thana, District"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
                        ></textarea>
                    </div>

                    <!-- District Selection for Delivery Charge -->
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1.5">
                            District / Delivery Area <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="district" 
                            id="checkout-district" 
                            onchange="window.App.handleDistrictChange(this.value)"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
                        >
                            <option value="Dhaka">Inside Dhaka City (ঢাকা সিটি) - ৳70</option>
                            <option value="Outside Dhaka">Outside Dhaka / Whole Bangladesh (ঢাকার বাইরে) - ৳130</option>
                        </select>
                    </div>

                    <!-- Order Notes (Optional) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">
                            Order Notes (Optional / বিশেষ নির্দেশনা)
                        </label>
                        <input 
                            type="text" 
                            name="notes" 
                            id="checkout-notes" 
                            placeholder="e.g. Please deliver after 5 PM"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
                        >
                    </div>

                </div>

                <!-- 2. Payment Method Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            2
                        </div>
                        <h3 class="text-base font-black text-slate-900">Payment Option</h3>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-emerald-500 bg-emerald-50/30 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="paymentMethod" value="COD" checked class="text-emerald-600 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs sm:text-sm font-black text-slate-900 block">Cash on Delivery (ক্যাশ অন ডেলিভারি)</span>
                                    <span class="text-[11px] text-slate-500">Pay cash in hand when courier delivers your parcel</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-hand-holding-dollar text-emerald-600 text-xl"></i>
                        </label>

                        <label class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="paymentMethod" value="bKash" class="text-emerald-600 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs sm:text-sm font-black text-slate-900 block">bKash / Nagad Online Payment</span>
                                    <span class="text-[11px] text-slate-500">Instant digital wallet checkout</span>
                                </div>
                            </div>
                            <span class="text-xs font-black text-pink-600 bg-pink-50 px-2 py-1 rounded-md">bKash</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right Order Summary Sidebar -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-5 sticky top-24">
                    <h3 class="text-base font-black text-slate-900 pb-3 border-b border-slate-100 flex items-center justify-between">
                        <span>Order Summary</span>
                        <span id="checkout-item-count" class="text-xs font-bold text-slate-400">0 items</span>
                    </h3>

                    <!-- Cart Items Review List -->
                    <div id="checkout-items-list" class="space-y-3 max-h-60 overflow-y-auto custom-scrollbar pr-1">
                        <!-- Injected via JS -->
                    </div>

                    <!-- Coupon Code Input Box -->
                    <div class="pt-3 border-t border-slate-100">
                        <div class="flex gap-2">
                            <input 
                                type="text" 
                                id="checkout-coupon-input" 
                                placeholder="Promo Code (e.g. NEXABD500)" 
                                class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs uppercase font-bold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600"
                            >
                            <button 
                                type="button" 
                                onclick="window.App.applyCheckoutCoupon()"
                                class="bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs px-4 py-2 rounded-xl transition cursor-pointer"
                            >
                                Apply
                            </button>
                        </div>
                        <div id="checkout-coupon-msg" class="text-xs font-semibold mt-1 hidden"></div>
                    </div>

                    <!-- Cost Calculations -->
                    <div class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                        <div class="flex justify-between font-semibold">
                            <span>Subtotal:</span>
                            <span id="checkout-subtotal" class="font-extrabold text-slate-900">৳0</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Delivery Charge:</span>
                            <span id="checkout-shipping" class="font-extrabold text-slate-900">৳70</span>
                        </div>
                        <div id="checkout-discount-row" class="flex justify-between font-semibold text-emerald-600 hidden">
                            <span>Coupon Discount:</span>
                            <span id="checkout-discount">-৳0</span>
                        </div>
                        <div class="pt-3 border-t border-slate-200 flex justify-between items-baseline">
                            <span class="text-base font-extrabold text-slate-900">Total Payable:</span>
                            <span id="checkout-total" class="text-2xl font-black text-emerald-700">৳0</span>
                        </div>
                    </div>

                    <!-- Confirm Order Button -->
                    <button 
                        type="submit" 
                        id="checkout-submit-btn"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-black text-sm sm:text-base py-4 rounded-2xl shadow-xl shadow-emerald-600/30 transition flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>Confirm & Place Order</span>
                    </button>

                    <div class="text-[11px] text-slate-400 text-center space-y-1">
                        <p class="flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                            <span>100% Safe & Secure Ordering Guarantee</span>
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </form>

</div>
@endsection
