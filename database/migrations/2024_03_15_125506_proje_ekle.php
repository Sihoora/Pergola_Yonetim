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
        Schema::create('proje_ekle', function (Blueprint $table) {
            $table->id();
            $table->integer('proje_kodu')->unique();
            $table->string('proje_adi');
            $table->string('musteri');
            $table->date('teslim_tarihi');
            $table->string('urun_ailesi')->nullable();
            $table->string('urun_grubu')->nullable();
            $table->string('urun_alt_grubu')->nullable();
            $table->string('uretim_sablonu')->nullable();
            $table->timestamps(); // created_at ve updated_at sütunları otomatik olarak eklenir.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proje_ekle');
    }
};
