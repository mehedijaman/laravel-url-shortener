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
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('url', 500);
            $table->string('alias')->nullable();
            $table->string('password')->nullable();
            $table->bigInteger('total_clicks')->default(0);
            $table->datetime('last_visited')->nullable();
            $table->datetime('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
