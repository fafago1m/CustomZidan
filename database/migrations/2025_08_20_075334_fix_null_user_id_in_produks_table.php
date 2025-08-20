<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update semua user_id yang NULL menjadi admin (id=1) atau user default
        DB::table('produks')
            ->whereNull('user_id')
            ->update(['user_id' => 1]); // ganti 1 dengan id admin yang valid

        // Tambahkan constraint NOT NULL kalau mau dipaksa
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        // Kalau rollback, boleh dikembalikan jadi nullable
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
