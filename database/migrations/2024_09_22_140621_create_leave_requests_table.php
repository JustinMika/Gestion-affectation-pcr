<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();  // Relation avec Employee
            $table->date('start_date');  // Date de début du congé
            $table->date('end_date');    // Date de fin du congé
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Statut : pending, approved, rejected
            $table->text('reason')->nullable();  // Raison du congé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
