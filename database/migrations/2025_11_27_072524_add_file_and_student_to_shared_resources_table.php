<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shared_resources', function (Blueprint $table) {
            // Add new columns
            if (!Schema::hasColumn('shared_resources', 'student_identifier')) {
                $table->string('student_identifier')->after('teacher_id');
            }
            if (!Schema::hasColumn('shared_resources', 'file_path')) {
                $table->string('file_path')->nullable()->after('resource_link');
            }
            if (!Schema::hasColumn('shared_resources', 'file_original_name')) {
                $table->string('file_original_name')->nullable()->after('file_path');
            }
            
            // Add index
            $table->index('student_identifier');
        });
    }

    public function down()
    {
        Schema::table('shared_resources', function (Blueprint $table) {
            $table->dropColumn(['student_identifier', 'file_path', 'file_original_name']);
        });
    }
};