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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('tax_id')->nullable(); // Vergi Kimlik Numarası
            $table->string('address')->nullable(); // Adres bilgisi
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('contact_person')->nullable(); // Yetkili kişi
            $table->string('contact_phone')->nullable(); // Yetkili kişi telefon numarası
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
        Schema::dropIfExists('companies');
    }
};
