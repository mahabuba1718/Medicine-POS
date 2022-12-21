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
        Schema::create('subpos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pos_id');
            $table->string('madicine_id');
            $table->string('quantity');
            $table->string('per_price');
            $table->string('subtotal_price');
            $table->foreign('pos_id')->references('id')->on('pos')->onDelete('cascade');
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
        Schema::table('subpos', function (Blueprint $table) {
            $table->dropForeign('subpos_pos_id_foreign');
        });
        Schema::dropIfExists('subpos');
    }
};
