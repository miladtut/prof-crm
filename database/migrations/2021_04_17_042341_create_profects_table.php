<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profects', function (Blueprint $table) {
            $table->id();
            $table->text('about_us')->nullable();
            $table->text('contact_info')->nullable();
            $table->text('ext_1')->nullable();
            $table->text('ext_2')->nullable();
            $table->text('ext_3')->nullable();
            $table->text('ext_4')->nullable();
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
        Schema::dropIfExists('profects');
    }
}
