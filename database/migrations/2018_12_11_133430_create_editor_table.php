<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->foreign('website_id')->references('id')->on('websites');
            $table->integer('website_editor_role_id')->unsigned();
            $table->foreign('website_editor_role_id')->references('id')->on('website_editor_roles');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('validation_link');
            $table->boolean('validation_status');
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
        Schema::table('editor', function (Blueprint $table) {
            //
        });
    }
}
