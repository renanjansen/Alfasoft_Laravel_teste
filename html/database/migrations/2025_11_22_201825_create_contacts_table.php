<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('country_code');
            $table->string('number', 9);
            $table->softDeletes();
            $table->timestamps();

            // Unique constraint para evitar duplicatas de country_code + number
            $table->unique(['country_code', 'number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
