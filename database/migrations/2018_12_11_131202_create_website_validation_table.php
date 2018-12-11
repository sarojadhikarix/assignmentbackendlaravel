<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_validation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->foreign('website_id')->references('id')->on('websites');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('validation_code');
            $table->timestamp('expire_date');
            $table->boolean('status');
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
        Schema::table('website_validation', function (Blueprint $table) {
            //
        });
    }
}
