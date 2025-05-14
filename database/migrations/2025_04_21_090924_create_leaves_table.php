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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('user_id');

            $table->integer('requested_days');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('leave_status')->default(0);
            $table->text('remarks')->nullable();
            $table->string('sick_file', 255)->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable()->default(0);
            $table->dateTime('reviewed_date')->nullable();

            // Foreign key constraints
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
