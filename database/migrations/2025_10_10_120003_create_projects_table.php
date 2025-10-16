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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->text(column: 'description')->nullable();
            $table->timestamp(column: 'start_date')->nullable();
            $table->timestamp(column: 'end_date')->nullable();
            $table->string(column: 'image_path')->nullable();
            $table->enum(column: 'status', allowed: ['pending', 'on_hold', 'in_progress', 'completed', 'cancelled'])->default(value: 'pending');
            $table->foreignId(column: 'created_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'updated_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'client_id')->constrained(table: 'clients')->onDelete(action: 'cascade');
            $table->foreignId(column: 'category_id')->constrained(table: 'categories')->onDelete(action: 'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
