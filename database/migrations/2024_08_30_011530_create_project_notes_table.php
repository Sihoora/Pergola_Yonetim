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
        Schema::create('project_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proje_id');
            $table->string('surec'); // Süreç aşamaları
            $table->text('not');    
            $table->boolean('checked')->default(false); // Checkbox için
            $table->timestamps();
    
            $table->foreign('proje_id')->references('id')->on('proje_ekle')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_notes');
    }
};
