<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('for_admin')->default('no');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('inquiry_id');
            $table->string('title');
            $table->string('readed')->default('no');
            $table->timestamps();
        });
        Schema::table('notifications',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
