<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('query_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('query_id'); // Links to student_queries.id
            $table->string('teacher_id'); // Teacher identifier (T-123)
            $table->text('reply');
            $table->timestamps();

            $table->foreign('query_id')->references('id')->on('student_queries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('query_replies');
    }
};