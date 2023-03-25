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
		Schema::create('games', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('thumbnail')->nullable();
			$table->string('slug')->nullable();
			$table->unsignedBigInteger('author');
            $table->timestamps();
			
			$table->foreign('author')->references('id')->on('platform_users')->onDelete('cascade');
        });
		
		Schema::create('game_versions', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('game_id');
			$table->string('version');
			$table->string('file_path');
            $table->timestamps();
			
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
		
        Schema::create('game_scores', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('game_version_id');
			$table->unsignedBigInteger('platform_user_id');
			$table->integer('score');
            $table->timestamps();
			
			$table->foreign('game_version_id')->references('id')->on('game_versions')->onDelete('cascade');
			$table->foreign('platform_user_id')->references('id')->on('platform_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::dropIfExists('games');
		Schema::dropIfExists('game_versions');
        Schema::dropIfExists('game_scores');
    }
};
