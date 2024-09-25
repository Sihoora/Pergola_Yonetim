<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnBoyToUrunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uruns', function (Blueprint $table) {
            $table->string('en_boy')->nullable()->after('arka_celik'); // "En/Boy" sütununu ekle
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uruns', function (Blueprint $table) {
            $table->dropColumn('en_boy'); // Geri almak için sütunu kaldır
        });
    }
}
