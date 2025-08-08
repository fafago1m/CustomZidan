<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PaymentSetting;
use App\Models\Transaksi;

class CekMutasiCommand extends Command
{
    protected $signature = 'mutasi:cek';
    protected $description = 'Cek mutasi QRIS dan update status transaksi';

    public function handle()
    {
        $setting = PaymentSetting::first();

        if (!$setting || !$setting->apikey || !$setting->username || !$setting->token) {
            $this->error('Pengaturan pembayaran tidak lengkap');
            return 1;
        }

        $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey={$setting->apikey}&username={$setting->username}&token={$setting->token}";

        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (!isset($data['data'])) {
                $this->error('Data mutasi kosong');
                return 1;
            }

            $this->info("Cek mutasi: " . count($data['data']) . " data ditemukan.");

            foreach ($data['data'] as $mutasi) {
                $nominal = (int) $mutasi['amount'];

                // Cek apakah ada transaksi pending dengan amount sesuai
                $transaksi = Transaksi::where('status', 'pending')
                    ->where('amount', $nominal)
                    ->first();

                if ($transaksi) {
                    $transaksi->status = 'paid';
                    $transaksi->save();

                    $this->info("Transaksi #{$transaksi->id} diupdate ke paid (nominal: Rp {$nominal})");
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Gagal ambil mutasi: ' . $e->getMessage());
            return 1;
        }
    }
}
