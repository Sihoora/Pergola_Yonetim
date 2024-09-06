<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('files', function (Blueprint $table) {
        $table->string('file_type')->default('general'); // Default olarak 'general' seçilebilir
    });
}

public function down()
{
    Schema::table('files', function (Blueprint $table) {
        $table->dropColumn('file_type');
    });
}

};
