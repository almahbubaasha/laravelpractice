<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'supervisor_name')) {
                $table->string('supervisor_name')->nullable()->after('supervisor_id');
            }
            if (!Schema::hasColumn('users', 'supervisor_email')) {
                $table->string('supervisor_email')->nullable()->after('supervisor_name');
            }
            if (!Schema::hasColumn('users', 'supervisor_department')) {
                $table->string('supervisor_department')->nullable()->after('supervisor_email');
            }
            if (!Schema::hasColumn('users', 'supervisor_img')) {
                $table->string('supervisor_img')->nullable()->after('supervisor_department');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['supervisor_name', 'supervisor_email', 'supervisor_department', 'supervisor_img']);
        });
    }
};