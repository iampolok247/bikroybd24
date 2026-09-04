<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('orderNumber')->unique()->nullable();
            $table->string('customerName');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('district')->default('Dhaka');
            $table->string('paymentMethod');
            $table->string('paymentStatus')->default('Unpaid');
            $table->decimal('deliveryCharge', 12, 2)->default(70);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('totalAmount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('supplierTotalCost', 12, 2)->default(0);
            $table->decimal('resellerProfit', 12, 2)->default(0);
            $table->string('orderStatus')->default('Pending Confirmation');
            $table->string('status')->default('Pending');
            $table->string('courierName')->nullable();
            $table->string('trackingNumber')->nullable();
            $table->string('uddoktapayInvoiceId')->nullable();
            $table->string('trxID')->nullable();
            $table->string('fraudFlag')->default('Normal');
            $table->text('notes')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
