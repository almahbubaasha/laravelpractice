<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('supervisor_infos', function (Blueprint $table) {
            $table->string('contact')->nullable()->after('department'); // contact কলাম যোগ করলো
        });
    }

    public function down()
    {
        Schema::table('supervisor_infos', function (Blueprint $table) {
            $table->dropColumn('contact');  // যদি রোলব্যাক করতে চাও তাহলে কলাম ড্রপ হবে
        });
    }
};