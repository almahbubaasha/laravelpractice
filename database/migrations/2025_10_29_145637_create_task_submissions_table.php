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
    Schema::create('task_submissions', function (Blueprint $table) {
        $table->id();

        // task id (which task was assigned)
        $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');

        // which student submitted
        $table->foreignId('student_id')->constrained('users')->onDelete('cascade');

        // student uploaded file path
        $table->string('file_path')->nullable();

        // extra note from student (optional)
        $table->text('remarks')->nullable();

        $table->timestamps();

        // one student can submit one time per task
        $table->unique(['task_id', 'student_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('task_submissions');
}
};