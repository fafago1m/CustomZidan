<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan semua transaksi punya user_id
        \App\Models\Transaksi::whereNull('user_id')->update(['user_id' => 1]); // ganti 1 dengan ID user default/admin

        Schema::table('transaksis', function (Blueprint $table) {
            // Ubah kolom jadi NOT NULL
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Tambahkan foreign key baru (jika belum ada, MySQL akan error tapi lebih aman dari Doctrine)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['user_id']);
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
