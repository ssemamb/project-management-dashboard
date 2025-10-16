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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'email')->unique();
            $table->string(column: 'phone')->nullable();
            $table->string(column: 'address')->nullable();
            $table->enum(column: 'status', allowed: ['active', 'in_active'])->default(value: 'active');
            $table->foreignId(column: 'created_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->foreignId(column: 'updated_by')->constrained(table: 'users')->onDelete(action: 'cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
