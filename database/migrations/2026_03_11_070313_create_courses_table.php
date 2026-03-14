<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->string('department');
            $table->integer('units');
            $table->string('instructor');
            $table->integer('capacity');
            $table->integer('enrolled')->default(0);
            $table->enum('schedule', ['MWF','TTH','SAT','ONLINE'])->default('MWF');
            $table->string('room')->nullable();
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};