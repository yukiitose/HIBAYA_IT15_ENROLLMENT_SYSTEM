<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('school_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type', ['School Day','Holiday','Event','Exam','No Class'])->default('School Day');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('present')->default(0);
            $table->integer('absent')->default(0);
            $table->integer('late')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('school_days'); }
};