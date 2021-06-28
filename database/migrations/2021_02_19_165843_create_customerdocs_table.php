<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerdocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerdocs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customerdoc_inquiry', function (Blueprint $table) {
            $table->unsignedBigInteger('inquiry_id');
            $table->unsignedBigInteger('customerdoc_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     **/
    public function down()
    {
        Schema::dropIfExists('customerdocs');
        Schema::dropIfExists('customerdocs_inquiries');
    }
}
