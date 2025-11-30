<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add columns to tasks table
        Schema::table('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'student_identifier')) {
                $table->string('student_identifier')->after('teacher_id');
            }
            if (!Schema::hasColumn('tasks', 'file_original_name')) {
                $table->string('file_original_name')->nullable()->after('file_path');
            }
            
            $table->index('student_identifier');
        });

        // Add column to task_assignments table
        Schema::table('task_assignments', function (Blueprint $table) {
            if (!Schema::hasColumn('task_assignments', 'reply_file_original_name')) {
                $table->string('reply_file_original_name')->nullable()->after('submission_file');
            }
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['student_identifier', 'file_original_name']);
        });

        Schema::table('task_assignments', function (Blueprint $table) {
            $table->dropColumn('reply_file_original_name');
        });
    }
};