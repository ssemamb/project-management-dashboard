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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->text(column: 'descripton')->nullable();
            $table->string(column: 'image_path')->nullable();
            $table->enum(column: 'status', allowed: ['pending', 'on_hold', 'in_progress', 'completed', 'cancelled'])->default(value: 'pending');
            $table->enum(column: 'priority', allowed: ['low', 'medium', 'high'])->default(value: 'medium');
            $table->date(column: 'due_date')->nullable();
            $table->foreignId(column: 'asigned_user_id')->nullable()->constrained(table: 'users')->nullOnDelete();
            $table->foreignId(column: 'project_id')->constrained(table: 'projects')->onDelete(action: 'cascade');
            $table->foreignId(column: 'created_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'updated_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'category_id')->constrained(table: 'categories')->onDelete(action: 'cascade');

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
