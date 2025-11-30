<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // Who sent the notification
            $table->string('student_id'); // Student identifier (e.g., "213-15-4346")
            $table->text('message'); // Notification message
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamps();

            // Indexes for faster queries
            $table->index('teacher_id');
            $table->index('student_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};