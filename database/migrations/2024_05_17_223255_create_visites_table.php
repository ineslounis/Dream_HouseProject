<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_client')->constrained('users');
            $table->string('nom_prenom');
            $table->foreignId('id_annonce')->constrained('biens');
            $table->string('titre');
            $table->string('agent_immobilier');
            $table->string('id_proprietaire');
            $table->date('date_visite');
            $table->time('heure_visite');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};