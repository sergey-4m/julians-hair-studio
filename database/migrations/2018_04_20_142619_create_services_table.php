<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id', true);
            $table->date('date_at');
            $table->string('brand');
            $table->string('bleach');
            $table->string('tint');
            $table->string('peroxide_volume');
            $table->integer('service_id')->unsigned();
            $table->string('perm');
            $table->double('charge');
            $table->integer('client_id')->unsigned();
            $table->integer('stylist_id')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('services', function (Blueprint $table) {
            $table->foreign('service_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
            $table->foreign('stylist_id')
                ->references('id')
                ->on('stylists')
                ->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
