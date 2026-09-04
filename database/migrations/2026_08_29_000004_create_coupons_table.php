<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('code')->unique();
            $table->string('discountType')->default('flat');
            $table->decimal('discountValue', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('minSpend', 12, 2)->default(0);
            $table->integer('usageLimit')->default(100);
            $table->integer('usageCount')->default(0);
            $table->string('badge')->default('EXCLUSIVE FLASH PROMO');
            $table->string('headline')->nullable();
            $table->text('subtext')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->boolean('is_active')->default(true);
            $table->timestamp('expiresAt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
