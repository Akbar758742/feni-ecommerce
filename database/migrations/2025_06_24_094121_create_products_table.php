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
            $table->string('name');
         
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->longText('product_details')->nullable();
            $table->text('delivery_policy')->nullable();
            $table->text('return_policy')->nullable();


            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('set null');
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);

                         
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
