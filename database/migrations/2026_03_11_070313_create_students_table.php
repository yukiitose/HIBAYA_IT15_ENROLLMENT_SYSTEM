<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->enum('gender', ['Male','Female','Other']);
            $table->date('birth_date');
            $table->string('address');
            $table->string('department');
            $table->string('course');
            $table->integer('year_level');
            $table->enum('enrollment_status', ['Active','Inactive','Graduated'])->default('Active');
            $table->date('enrollment_date');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('students'); }
};