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
        //
        Schema::create('proje_surec_tarihleri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proje_id');
            $table->string('surec');
            $table->timestamp('tarih');
            $table->foreign('proje_id')->references('id')->on('proje_ekle')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
