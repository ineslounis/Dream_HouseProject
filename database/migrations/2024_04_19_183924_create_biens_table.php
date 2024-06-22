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
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('type');
            $table->integer('surface');
            $table->integer('nombre_etages')->nullable(); 
            $table->integer('nombre_chambre')->nullable(); 
            $table->integer('prix');
            $table->string('wilaya');
            $table->string('adresse');
            $table->string('transaction');
            $table->string('image');
            $table->string('imgs');
            $table->longText('description');
            $table->boolean('etat');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
