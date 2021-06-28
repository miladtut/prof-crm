<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('type');
            $table->unsignedBigInteger('material_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('spec_id')->nullable();
            $table->integer('qty')->nullable();
            $table->string('qty_unit')->nullable();
            $table->enum('project_status', [
                'commercial',
                'R&D'
            ])->nullable();
            $table->string('pcoa_status')->nullable();
            $table->string('draft_status')->nullable();
            $table->string('final_status')->nullable();
            $table->unsignedBigInteger('end_market_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('status_name');
            $table->string('swift_no')->nullable();
            $table->boolean('paid')->default(0);
            $table->string('awb_no')->nullable();
            $table->string('tracking_number_of_original_documents')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('document_inquiry',function (Blueprint $table){
            $table->unsignedBigInteger('inquiry_id');
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
        Schema::dropIfExists('inquiries');
    }
}



//            $table->integer('sample_min_qty')->nullable();
//            $table->enum('sample_qty_unit', [
//                'microgram',
//                'milligram',
//                'gram',
//                'kilogram',
//                'tonne',
//                'pound',
//                'ounce'
//            ])->nullable();
//            $table->string('sample_shipping_instructions')->nullable();

//            $table->integer('pilot_qty')->nullable();
//            $table->enum('pilot_qty_unit', [
//                'microgram',
//                'milligram',
//                'gram',
//                'kilogram',
//                'tonne',
//                'pound',
//                'ounce'
//            ])->nullable();
//            $table->double('pilot_price')->nullable();


//            $table->string('coa_attachment')->nullable();
//            $table->string('pi_file')->nullable();
//            $table->string('po_file')->nullable();
//            $table->string('pcoa_file')->nullable();
//            $table->string('draft_ship_file1')->nullable();
//            $table->string('draft_ship_file2')->nullable();
//            $table->string('draft_ship_file3')->nullable();
//            $table->string('draft_ship_file4')->nullable();
//            $table->string('final_ship_file1')->nullable();
//            $table->string('final_ship_file2')->nullable();
//            $table->string('final_ship_file3')->nullable();
//            $table->string('final_ship_file4')->nullable();
