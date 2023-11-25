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
        Schema::create('datawp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteriawp_id')->constrained('kriteriawp')->onDelete('cascade');
            $table->foreignId('alternatifwp_id')->constrained('alternatifwp')->onDelete('cascade');
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datawp');
    }
};
