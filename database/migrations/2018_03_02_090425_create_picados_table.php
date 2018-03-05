<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idd');
            $table->string('empleado', 25);
            $table->dateTime('tiempo');
            $table->boolean('dedo');
            $table->integer('tipo');
            $table->date('fecha');
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
        Schema::dropIfExists('picados');
    }
}
