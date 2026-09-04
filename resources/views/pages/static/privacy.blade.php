@extends('layouts.app')

@section('title', 'Privacy Policy - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Data Protection</span>
        <h1 class="text-3xl font-black text-slate-900">Privacy Policy</h1>
        <p class="text-xs text-slate-500">How we collect, protect, and handle your order information on BikroyBD24.</p>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6 text-xs text-slate-600 leading-relaxed">
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">1. Information We Collect</h3>
            <p>We only collect information strictly required to fulfill your e-commerce orders: full name, phone number, and delivery address in Bangladesh.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">2. Courier Sharing</h3>
            <p>Your delivery information is shared securely with our designated logistics partners (such as Steadfast Courier, Redx, Pathao) solely for parcel shipment and OTP verification.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">3. Data Security</h3>
            <p>We do not store payment card numbers. All customer details are securely kept on private encrypted databases.</p>
        </div>
    </div>
</div>
@endsection
