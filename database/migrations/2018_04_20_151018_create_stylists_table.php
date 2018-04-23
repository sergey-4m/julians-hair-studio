<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('stylists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            //$table->integer('service_id')->unsigned()->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        /*Schema::table('stylists', function (Blueprint $table) {
            $table->foreign('service_id')
                ->references('stylist_id')
                ->on('services')
                ->onDelete('cascade');
        });*/
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stylists');
    }
}
