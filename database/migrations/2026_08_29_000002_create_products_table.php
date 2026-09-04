<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('category');
            $table->string('categoryName')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('supplierCost', 12, 2)->default(0);
            $table->decimal('oldPrice', 12, 2)->nullable();
            $table->decimal('original_price', 12, 2)->nullable();
            $table->integer('discount')->default(0);
            $table->decimal('rating', 3, 2)->default(5.0);
            $table->integer('reviews')->default(0);
            $table->text('image')->nullable();
            $table->integer('inStock')->default(10);
            $table->integer('stock')->default(10);
            $table->integer('totalStock')->default(50);
            $table->integer('minStockThreshold')->default(5);
            $table->string('category_id')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_flash_sale')->default(false);
            $table->boolean('isTrending')->default(false);
            $table->boolean('isFeatured')->default(false);
            $table->boolean('isFlashSale')->default(false);
            $table->string('section')->default('catalog');
            $table->text('description')->nullable();
            $table->text('badges')->nullable();
            $table->string('badge')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
