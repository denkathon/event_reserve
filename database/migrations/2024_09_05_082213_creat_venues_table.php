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
        Schema::create('venues', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->string('name', 191);
            $table->text('information')->nullable(); 
            $table->string('address', 191)->nullable();
            $table->timestamp('created_at', 3)->useCurrent();
            $table->timestamp('updated_at', 3)->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes('deleted_at', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
