<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title' , 120);
            $table->text('description')->nullable();
            $table->float('price', 5, 2);
            $table->tinyInteger('rooms_number')->unsigned();
            $table->tinyInteger('guests_number')->unsigned();
            $table->tinyInteger('bathrooms')->unsigned();
            $table->integer('area_sm');
            $table->float('address_lat', 10, 6);
            $table->float('address_lon', 10, 6);
            $table->string('address');
            $table->boolean('visibility');
            $table->string('image');
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
        Schema::dropIfExists('apartments');
    }
}
