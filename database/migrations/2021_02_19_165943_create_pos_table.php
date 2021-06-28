<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
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
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('inquiry_id');
            $table->unsignedBigInteger('payment_term_id');
            $table->unsignedBigInteger('shipping_term_id');//
            $table->string('delivery');//
            $table->string('place_of_delivery');//
            $table->string('txt_points')->nullable();//
            $table->integer('material_id');//
            $table->integer('material_qty');//
            $table->string('material_qty_unit');//
            $table->integer('working_standard_qty');//
            $table->string('working_standard_qty_unit');//
            $table->double('material_price_per_unit');//
            $table->double('material_total_price');// material_qty * material_price_per_unit
            $table->double('working_standard_price_per_unit');//
            $table->double('working_standard_total_price');//working_standard_qty * working_standard_price_per_unit
            $table->double('po_total_price');//Material_total_price + working_standard_total_price

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bos');
    }
}
