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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('episode_id');
            $table->text('opening_crawl');
            $table->string('director');
            $table->string('producer');
            $table->date('release_date');
            $table->string('url');
            $table->string('adult')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('language')->nullable();
            $table->string('popularity')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('video')->nullable();
            $table->string('vote_average')->nullable();
            $table->string('vote_count')->nullable();
            $table->datetime('movie_created_at')->nullable();
            $table->datetime('movie_edited_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
