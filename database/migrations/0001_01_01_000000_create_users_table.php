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
        // 1. TABEL USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Kolom Profil Tambahan Fitkomove
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('job')->nullable();
            $table->integer('target_weight')->nullable();
            $table->string('fitness_goal')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        // 2. TABEL WORKOUTS
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('activity');
            $table->integer('duration');
            $table->integer('calories');
            $table->date('date');
            $table->timestamps();
        });

        // 3. TABEL NUTRITIONS
        Schema::create('nutritions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('food_name');
            $table->integer('calories');
            $table->string('meal_type');
            $table->date('date');
            $table->timestamps();
        });

        // 4. TABEL PROGRESS
        Schema::create('progress_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 5, 2);
            $table->decimal('waist', 5, 2)->nullable();
            $table->date('date');
            $table->timestamps();
        });

        // --- TABEL BAWAAN LARAVEL ---
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // --- [PENYEBAB ERROR] TABEL CACHE (INI YANG KURANG TADI) ---
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('progress_logs');
        Schema::dropIfExists('nutritions');
        Schema::dropIfExists('workouts');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};