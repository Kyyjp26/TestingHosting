<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('IDtrans');
            $table->bigInteger('IDproduk')->unsigned();
            $table->timestamp('tanggal');
            $table->integer('qty');
            $table->integer('hargajual');
            $table->integer('total');
            $table->integer('dibayar');
            $table->integer('kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
