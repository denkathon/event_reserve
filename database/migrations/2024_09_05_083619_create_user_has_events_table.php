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
        Schema::create('user_has_events', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->string('user_id', 191);
            $table->string('event_id', 191);
            $table->boolean('status');
            $table->timestamp('created_at', 3)->useCurrent();
            $table->timestamp('updated_at', 3)->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes('deleted_at', 3);

            $table->foreign('user_id', 'user_has_events_user_id_fkey')
                ->references('id')
                ->on('users')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');
            $table->foreign('event_id', 'user_has_events_event_id_fkey')
                ->references('id')
                ->on('events')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');
            $table->unique(['user_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_events');
    }
};
