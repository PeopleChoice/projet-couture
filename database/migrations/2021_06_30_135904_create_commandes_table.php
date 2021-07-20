<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date_commande');
            $table->string('date_livraison');
            $table->string('libelle');
            $table->string('accompt')->default('0');
            $table->string('remise')->default('0');
            $table->string('payer')->nullable();;
            $table->string('status');
            $table->integer('clients_id')->unsigned();
            $table->foreign('clients_id')
                ->references('id')->on('clients')
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
        Schema::dropIfExists('commandes');
    }
}
