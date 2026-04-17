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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
            $table->foreignId('product_type_id')->nullable()->after('brand_id')->constrained()->nullOnDelete();
            $table->decimal('compare_price', 10, 2)->nullable()->after('price');
            $table->enum('condition', ['new', 'refurbished', 'used'])->default('new')->after('compare_price');
            $table->string('warranty')->nullable()->after('condition');
            $table->decimal('weight', 10, 2)->nullable()->after('warranty');
            $table->json('dimensions')->nullable()->after('weight');

            $table->index('brand_id');
            $table->index('product_type_id');
            $table->index('condition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['product_type_id']);
            $table->dropIndex(['brand_id']);
            $table->dropIndex(['product_type_id']);
            $table->dropIndex(['condition']);
            $table->dropColumn([
                'brand_id',
                'product_type_id',
                'compare_price',
                'condition',
                'warranty',
                'weight',
                'dimensions',
            ]);
        });
    }
};
