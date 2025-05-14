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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('department_id')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('avatar')->nullable();
            $table->string('role')->nullable();
            $table->string('staff_id')->nullable();
            $table->decimal('monthly_salary', 10, 2)->nullable();
            $table->boolean('is_supervisor')->default(false);
            $table->boolean('password_reset')->default(false);
            $table->boolean('lock_unlock')->default(false);
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->boolean('can_be_assigned')->default(true);
            $table->date('joining_date')->nullable();
            $table->date('dob')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
