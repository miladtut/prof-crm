<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Constraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquiries',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('spec_id')->references('id')->on('specs')->onDelete('cascade');
            $table->foreign('end_market_id')->references('id')->on('countries')->onDelete('cascade');

        });
        Schema::table('quotations',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
            $table->foreign('spec_id')->references('id')->on('specs')->onDelete('cascade');
            $table->foreign('shipping_term_id')->references('id')->on('shipping_terms')->onDelete('cascade');
            $table->foreign('payment_term_id')->references('id')->on('payment_terms')->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('countries')->onDelete('cascade');
        });
        Schema::table('document_quotation',function (Blueprint $table){
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
        Schema::table('statuses_logs',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });

        Schema::table('stages',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });

        Schema::table('files',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('samples',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });

        Schema::table('pilots',function (Blueprint $table){
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });

        Schema::table('supplier_products',function (Blueprint $table){
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });

        Schema::table('supplier_documents',function (Blueprint $table){
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('pos',function (Blueprint $table){
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });
        Schema::table('companies',function (Blueprint $table){
            $table->foreign('country')->references('id')->on('countries')->onDelete('cascade');
        });
        Schema::table('suppliers',function (Blueprint $table){
            $table->foreign('country')->references('id')->on('countries')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
