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
        Schema::create('retailer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retailer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['business', 'shipping', 'billing'])->default('business');
            $table->boolean('is_default')->default(false);

            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country')->default('United States');

            // Contact for this address
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();

            $table->timestamps();

            $table->index('retailer_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailer_addresses');
    }
};
