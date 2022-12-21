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
        Schema::create('subpurchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_id');
//            $table->string('purchase_no');
            $table->string('madicine_id');
//            $table->string('date');
            $table->string('expire_date');
            $table->string('quantity');
            $table->string('alert');
            $table->string('price');
            $table->string('sub_total');
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
        Schema::dropIfExists('subpurchases');
    }
};
