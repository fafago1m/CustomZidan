<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Models\Transaksi;

class PaymentSettingController extends Controller
{
    public function showMutasiQR()
    {
        $setting = PaymentSetting::first();

        if (!$setting) {
            return response()->json(['error' => 'Pengaturan pembayaran belum diset'], 404);
        }

        $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey={$setting->apikey}&username={$setting->username}&token={$setting->token}";

        // Jika kamu ingin langsung ambil datanya dari API
        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data: ' . $e->getMessage()], 500);
        }
    }

    public function createPayment(Request $request)
{
    $amount = $request->get('amount', 1000); // default 1000
    $setting = PaymentSetting::first();

    if (!$setting || !$setting->apikey || !$setting->codeqr) {
        return response()->json(['error' => 'Pengaturan belum lengkap'], 400);
    }

    $url = "https://apiku-fafa-main.vercel.app/api/orkut/createpayment?apikey=apikeyfafa1&amount={$amount}&codeqr=" . urlencode($setting->codeqr);

    try {
        $response = file_get_contents($url);
        return response()->json(json_decode($response, true));
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal request API: ' . $e->getMessage()], 500);
    }
}
public function cekMutasi()
{
    $setting = PaymentSetting::first();

    if (!$setting || !$setting->apikey || !$setting->username || !$setting->token) {
        return response()->json(['error' => 'Pengaturan belum lengkap.']);
    }

    $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey=fafa1&username=fafagamin&token=1300158%3AAf2nKqxvLzFQHbU87JO5BWtiTr3D";

    try {
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Perbaikan: data mutasi ada di 'result', bukan 'data'
        if (!isset($data['result']) || empty($data['result'])) {
            return response()->json(['error' => 'Data mutasi kosong.']);
        }

        $berhasil = 0;
        $gagal = 0;

        foreach ($data['result'] as $mutasi) {
            $kredit = (int) str_replace('.', '', $mutasi['kredit']);

            // Cari transaksi yang amount-nya sama dan masih pending
            $transaksi = Transaksi::where('status', 'pending')
                ->where('amount', $kredit)
                ->first();

            if ($transaksi) {
                $transaksi->status = 'paid';
                $transaksi->save();
                $berhasil++;
            } else {
                $gagal++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "✅ {$berhasil} transaksi berhasil diproses. ❌ {$gagal} tidak cocok.",
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal request: ' . $e->getMessage()]);
    }
}

}
