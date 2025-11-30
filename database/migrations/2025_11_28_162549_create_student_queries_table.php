<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_queries', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // Student identifier (21-15-4346)
            $table->string('teacher_id'); // Teacher identifier (T-123)
            $table->text('query');
            $table->timestamps();

            // No foreign keys needed since these are identifiers, not IDs
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_queries');
    }
};