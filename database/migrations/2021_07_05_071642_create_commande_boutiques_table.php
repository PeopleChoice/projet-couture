<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeBoutiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_boutiques', function (Blueprint $table) {
            $table->increments("id");
            $table->string("date_commande");
            $table->string("nom");
            $table->string("prenom");
            $table->string("adresse");
            $table->string("tel");
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
        Schema::dropIfExists('commande_boutiques');
    }
}
