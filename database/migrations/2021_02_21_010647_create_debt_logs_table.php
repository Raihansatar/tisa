<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['status', 'new_debt', 'pay_debt', 'partial_payment']);
            $table->foreignId('user_id')->constrained('users');
            $table->string('user_name');
            $table->foreignId('debt_id')->constrained('debts');
            $table->string('debt_name');
            $table->decimal('debt_amount', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->enum('debt_old_status', ['unpaid', 'partial', 'paid'])->nullable();
            $table->enum('debt_new_status', ['unpaid', 'partial', 'paid'])->nullable();
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
        Schema::dropIfExists('debt_logs');
    }
}
