<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uruns', function (Blueprint $table) {
            //
            $table->string('led_dizilim'); 
            $table->string('led_adet'); 
            $table->string('led_alıcı'); 
            $table->string('kompozit_ral'); 
            $table->string('arka_celik_not');
            $table->string('tasıyıcı_celik_ayak');
            $table->string('celik_ayak_model');
            $table->string('tasıyıcı_celik_not');
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
            //
        });
    }
};
