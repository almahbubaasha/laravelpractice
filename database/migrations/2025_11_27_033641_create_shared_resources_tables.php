<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shared_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // Who shared the resource
            $table->string('student_identifier'); // Who will receive (e.g., "213-15-4346")
            $table->string('title'); // Resource title/name
            $table->text('link')->nullable(); // URL link
            $table->string('file_path')->nullable(); // Uploaded file path
            $table->string('file_original_name')->nullable(); // Original filename
            $table->timestamps();

            // Indexes for faster queries
            $table->index('teacher_id');
            $table->index('student_identifier');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shared_resources');
    }
};