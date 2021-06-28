<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('contact_person_name');
            $table->string('phone_key');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('country');
            $table->string('logo_img')->nullable();
            $table->integer('no_of_logistics_inquiries')->default(0);
            $table->integer('no_of_materials')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('material_supplier',function (Blueprint $table){
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('material_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
