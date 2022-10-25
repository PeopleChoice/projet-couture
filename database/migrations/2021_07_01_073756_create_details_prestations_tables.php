<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsPrestationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_prestations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date_prestation');
            $table->string('prix');
            $table->string('libelle');
            $table->string('status');
            $table->string('qt');
            $table->integer('prestataires_id')->unsigned();
            $table->foreign('prestataires_id')
                ->references('id')->on('prestataires')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('details_prestations');
    }
}
