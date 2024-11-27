<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('urun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proje_id');
            $table->foreign('proje_id')->references('id')->on('proje_ekle')->onDelete('cascade');
            $table->string('urun_name');
            $table->string('ral_kodu');
            $table->string('kumas_cinsi');
            $table->string('kumas_profil_ral');
            $table->string('led_model');
            $table->string('motor_model');
            $table->string('kumanda');
            $table->string('flans');
            $table->string('arka_celik');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('urun');
    }
};
