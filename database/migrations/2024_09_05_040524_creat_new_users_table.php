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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->string('auth_id', 191)->unique()->nullable();
            $table->string('name', 191);
            $table->string('e_mail', 191)->nullable();
            $table->string('phone_number', 191)->nullable();
            $table->integer('has_stamp')->default(0);
            $table->timestamp('created_at', 3)->useCurrent();
            $table->timestamp('updated_at', 3)->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes('deleted_at', 3);

            $table->foreign('auth_id', 'users_user_auth_id_fkey')
                ->references('id')
                ->on('auths')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
