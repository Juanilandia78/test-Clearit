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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'closed'])->default('pending');
            $table->enum('type', [1, 2, 3])->default(1);
            $table->enum('transport_mode', ['air', 'land', 'sea'])->nullable();
            $table->string('product')->nullable();
            $table->string('origin_country')->nullable();
            $table->string('destination_country')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Creador
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
