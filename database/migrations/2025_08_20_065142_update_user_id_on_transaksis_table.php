<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan semua transaksi lama punya user_id default (misal admin id=1)
        Transaksi::whereNull('user_id')->update(['user_id' => 1]);

        Schema::table('transaksis', function (Blueprint $table) {
            // Cek dan hapus foreign key lama jika ada
            $sm = DB::select("SELECT CONSTRAINT_NAME 
                              FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                              WHERE TABLE_NAME = 'transaksis' 
                                AND COLUMN_NAME = 'user_id' 
                                AND CONSTRAINT_SCHEMA = DATABASE()");

            if (!empty($sm)) {
                foreach ($sm as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
            }

            // Ubah kolom jadi NOT NULL
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Tambah foreign key baru
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
