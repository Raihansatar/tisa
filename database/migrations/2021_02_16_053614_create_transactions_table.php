<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->string('product_variant_name')->default('Untracked Product');
            $table->unsignedBigInteger('unit_sales')->nullable();
            $table->decimal('price_per_unit', 10, 2)->nullable();
            $table->decimal('total_sales', 10, 2);
            $table->timestamp('date')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
