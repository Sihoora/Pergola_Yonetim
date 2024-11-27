<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderFilesTable extends Migration
{
    public function up()
    {
        Schema::create('order_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Order ile ilişkili
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_files');
    }
}