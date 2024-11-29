<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('studio');
            $table->json('genres');
            $table->integer('hype');
            $table->text('description');
            $table->string('title');
            $table->datetime('start_date');
            $table->string('image');
            $table->timestamps();
            $table->string('link')->nullable();

        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
