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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type')->nullable(); 
            $table->text('description')->nullable(); 
            $table->integer('assign_days')->nullable(); 
            $table->enum('apply_base', ['month', 'year'])->default('month'); 
            $table->enum('paid_type', ['paid', 'unpaid'])->default('paid'); 
            $table->string('early_leave')->default(0); 
            $table->string('status')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
