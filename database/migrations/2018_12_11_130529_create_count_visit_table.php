<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_visit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count');
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
        Schema::table('count_visit', function (Blueprint $table) {
            //
        });
    }
}
