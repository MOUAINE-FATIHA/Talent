<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_job_offers_table.php
    public function up(){
    Schema::create('job_offers', function(Blueprint $table){
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->string('type_contrat');
        $table->string('entreprise');
        $table->string('image')->nullable();
        $table->foreignId('recruteur_id')->constrained()->onDelete('cascade');

        $table->timestamps();
    });
    }  


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers');
    }
};
