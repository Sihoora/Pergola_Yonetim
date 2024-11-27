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
            $table->integer('proje_kodu');
            $table->string('proje_adi');
            $table->string('musteri');
            $table->date('teslim_tarihi');
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
