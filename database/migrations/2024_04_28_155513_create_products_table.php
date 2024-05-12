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
            $table->bigInteger('category_id');
            $table->string('english_title')->nullable();
            $table->string('urdu_title')->nullable();
            $table->string('english_description')->nullable();
            $table->string('urdu_description')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('weight')->nullable();
            $table->string('english_type')->nullable();
            $table->string('urdu_type')->nullable();
            $table->longText('images')->nullable();
            $table->string('status')->default('0')->nullable();
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
