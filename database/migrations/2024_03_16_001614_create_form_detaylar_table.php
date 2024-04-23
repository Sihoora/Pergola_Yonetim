<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetaylarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_detaylar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proje_ekle_id');
            $table->string('sistem_adi')->nullable();
            $table->string('en')->nullable();
            $table->string('acilim')->nullable();
            $table->string('on_yukseklik')->nullable();
            $table->string('arka_yukseklik')->nullable();
            $table->string('motor_tipi')->nullable();
            // Buraya form_detay1 ve form_detay2'den gelen diğer alanlar eklenebilir.
            $table->timestamps();

            // proje_ekle tablosu ile ilişkilendirme
            $table->foreign('proje_ekle_id')->references('id')->on('proje_ekle')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_detaylar');
    }
}
