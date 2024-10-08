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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_kamar');
            $table->foreign('id_kamar')->references('id')->on('kamars')->onDelete('cascade')->onUpdate('no action');
            $table->string('check_in');
            $table->string('check_out');
            $table->text('catatan')->nullable();
            $table->integer('jumlah_orang');
            $table->double('total_harga');
            $table->integer('rating')->nullable();
            $table->enum('status', ['Menunggu Konfirmasi', 'Ditolak', 'Disetujui', 'Selesai', 'Dibatalkan'])->default('Menunggu Konfirmasi');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
