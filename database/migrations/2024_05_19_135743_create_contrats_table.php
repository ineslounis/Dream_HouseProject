<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id'); // ID du client
            $table->string('nom_client'); 
            $table->string('prenom_client'); 
            $table->string('adresse_client'); 
            $table->string('email_client'); 
            // $table->unsignedBigInteger('proprietaire_id'); // ID du propriétaire
            $table->string('nom_proprietaire'); 
            $table->string('prenom_proprietaire'); 
            $table->string('adresse_proprietaire'); 
            $table->string('email_proprietaire'); 
            // $table->unsignedBigInteger('bien_id'); // ID du bien immobilier
            $table->string('titre'); 
            $table->string('type');
            $table->string('adresse_bien');
            $table->string('description'); 
            $table->integer('duree_location')->nullable(); 
            $table->decimal('prix_initial', 10, 2); 
            $table->decimal('prix_final', 10, 2);  
            $table->timestamps();
            
            // Clés étrangères
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('proprietaire_id')->references('id')->on('users');
            // $table->foreign('bien_id')->references('id')->on('biens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrats');
    }
}
