<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingCalcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_clacs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_rate');
            $table->integer('total_users');
            $table->integer('website_id')->unsigned();
            $table->foreign('website_id')->references('id')->on('websites');
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
        Schema::table('rating_clacs', function (Blueprint $table) {
            //
        });
    }
}
