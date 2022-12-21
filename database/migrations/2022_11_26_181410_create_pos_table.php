<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('invoice_no');
            $table->string('seller_id');
            $table->string('customer_id');
            $table->string('total_quantity');
            $table->string('net_total');
            $table->string('vat')->default(0);
            $table->string('discount_amount')->default(0);
            $table->string('total_amount');
            $table->string('paid_amount')->default(0);
            $table->string('change_amount');
            $table->string('due_amount');
            $table->boolean('status')->default(0); 
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
        Schema::dropIfExists('pos');
    }
};
