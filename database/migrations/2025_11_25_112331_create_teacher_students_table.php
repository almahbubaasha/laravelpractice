<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teacher_students', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id');  // String for identifier
            $table->string('student_id');  // String for identifier
            $table->timestamps();

            // Index for faster queries
            $table->index('teacher_id');
            
            // Unique constraint: One student can only be assigned to ONE teacher
            $table->unique('student_id', 'unique_student_assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_students');
    }
};