<?php

use App\Enums\StatusTasks;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Foreign key to the clients table
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to the projects table, nullable
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Task description, nullable
            $table->enum('status', StatusTasks::values())->default(StatusTasks::Pending->value);
            $table->date('due_date')->nullable(); // Due date, nullable
            $table->softDeletes(); // Soft deletes column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
