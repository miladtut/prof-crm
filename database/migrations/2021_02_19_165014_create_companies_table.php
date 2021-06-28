<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_person_name');
            $table->string('phone_key');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->enum('register_type',['website','profect']);
            $table->enum('account_type',['regular','logistic']);
            $table->boolean('blocked')->default(0);
            $table->unsignedBigInteger('country');
            $table->string('logo_img')->nullable();
            $table->integer('number _of_inquiries')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('companies');
    }
}
