<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('count')->nullable();
            $table->string('items_count')->nullable();
            $table->text('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->text('desc')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('showInTopCategories')->default(true);
            $table->boolean('showInSidebar')->default(true);
            $table->string('type')->default('main');
            $table->string('level')->default('main');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
