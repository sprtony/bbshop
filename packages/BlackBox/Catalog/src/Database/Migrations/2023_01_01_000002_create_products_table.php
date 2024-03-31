<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->boolean('can_be_sale')->nullable();
            $table->boolean('can_manage_inventory')->nullable();
            $table->boolean('can_be_shipped')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('private')->nullable();

            $table->string('thumbnail')->nullable();
            $table->text('gallery')->nullable();

            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('special_price', 12, 4)->nullable();
            $table->dateTime('special_price_from')->nullable();
            $table->dateTime('special_price_to')->nullable();

            $table->integer('inventory')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('products')->cascadeOnDelete();

            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
