<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inquiry_id');
            $table->double('price');
            $table->string('unit');
            $table->unsignedBigInteger('spec_id');
            $table->string('lead_time');
            $table->date('validity');
            $table->unsignedBigInteger('shipping_term_id');
            $table->unsignedBigInteger('payment_term_id');
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('currency_id');
            $table->enum('status',['approved','rejected'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('document_quotation',function (Blueprint $table){
            $table->unsignedBigInteger('quotation_id');
            $table->unsignedBigInteger('document_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
