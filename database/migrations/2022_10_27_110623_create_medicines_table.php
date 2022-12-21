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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('genericname');
            $table->bigInteger('category_id');
            $table->string('unit_id');
            $table->string('type_id');
            $table->string('price');
            $table->string('purchaseprice');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('show_at_purchase')->default(0);
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
        Schema::dropIfExists('medicines');
    }
};
