<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('brand')->nullable()->constrained('product_brands');
            $table->foreignId('category')->constrained('product_categories');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('brand')->references('id')->on('product_brands');
            // $table->foreign('category')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
