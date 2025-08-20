<?php

use App\Models\PaymentSetting;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (!function_exists('curlGet')) {
    /**
     * Request GET menggunakan cURL dengan User-Agent dan error handling.
     */
    function curlGet(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err) {
            throw new Exception("Curl error: {$err}");
        }

        if ($httpCode !== 200) {
            throw new Exception("Request failed with status code {$httpCode}");
        }

        return $response;
    }
}

Route::get('/', function () {
    $produks = Produk::all();
    return view('welcome', compact('produks'));
})->name('home');

Route::get('/beli/{id}', function ($id) {
    $produk = Produk::findOrFail($id);
    return view('beli', compact('produk'));
})->name('beli.produk');

Route::post('/beli', function (Request $request) {
    $request->validate([
        'nama' => 'required',
        'email' => 'nullable|email',
        'no_wa' => 'required',
        'produk_id' => 'required|exists:produks,id',
    ]);

    $produk = Produk::findOrFail($request->produk_id);
    $kodeUnik = rand(1, 99); // kode unik random
    $amount = $produk->harga + $kodeUnik;

    // Buat transaksi
    $transaksi = Transaksi::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'no_wa' => $request->no_wa,
        'produk_id' => $produk->id,
        'status' => 'pending',
        'amount' => $amount,
        'kode_unik' => $kodeUnik,
    ]);

    // Request pembayaran (sekali saja)
    $setting = PaymentSetting::first();
    $paymentResponse = null;

    if ($setting && $setting->apikey && $setting->codeqr) {
        $apikey = urlencode($setting->apikey);
        $amountEncoded = urlencode($amount);
        $codeqrEncoded = urlencode($setting->codeqr);

        $url = "https://apiku-fafa-main.vercel.app/api/orkut/createpayment?apikey=apikeyfafa1&amount={$amountEncoded}&codeqr=00020101021126670016COM.NOBUBANK.WWW01189360050300000879140214823323798771130303UMI51440014ID.CO.QRIS.WWW0215ID20243345208120303UMI5204541153033605802ID5925YULIASARI%20STORE%20OK17633726007BANDUNG61054011162070703A0163048BA9";

        try {
            $response = curlGet($url);
            $paymentResponse = json_decode($response, true);
        } catch (\Exception $e) {
            $paymentResponse = ['error' => 'Gagal request pembayaran: ' . $e->getMessage()];
        }
    }

    // Simpan ke session (sementara)
    Session::flash('payment', $paymentResponse);

    return redirect()->route('invoice.show', $transaksi->id);
})->name('beli.submit');

Route::get('/invoice/{id}', function ($id) {
    $transaksi = Transaksi::with('produk')->findOrFail($id);
    $payment = Session::get('payment'); // Ambil hanya dari session agar tidak request ulang

    return view('invoice', compact('transaksi', 'payment'));
})->name('invoice.show');

Route::get('/mutasi-manual/{id}', function ($id) {
    $transaksi = Transaksi::findOrFail($id);
    $setting = PaymentSetting::first();

    if (!$setting || !$setting->apikey || !$setting->username || !$setting->token) {
        if (request()->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Pengaturan pembayaran belum lengkap.']);
        }
        return redirect()->back()->with('error', 'Pengaturan pembayaran belum lengkap.');
    }

    $apikey = urlencode($setting->apikey);
    $username = urlencode($setting->username);
    $token = urlencode($setting->token);

    $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey={$apikey}&username={$username}&token={$token}";

    try {
        $response = curlGet($url);
        $data = json_decode($response, true);

        if (!isset($data['result']) || empty($data['result'])) {
            if (request()->ajax()) {
                return response()->json(['status' => 'pending', 'message' => 'Data mutasi kosong.']);
            }
            return redirect()->route('invoice.show', $transaksi->id)->with('error', '❌ Data mutasi kosong.');
        }

        foreach ($data['result'] as $mutasi) {
            $nominal = (int) str_replace('.', '', $mutasi['kredit']);

            if (
                $transaksi->status === 'pending' &&
                $transaksi->amount == $nominal
            ) {
                $transaksi->status = 'paid';
                $transaksi->save();

                if (request()->ajax()) {
                    return response()->json(['status' => 'paid', 'message' => "✅ Transaksi berhasil dibayar."]);
                }

                return redirect()->route('invoice.show', $transaksi->id)
                    ->with('success', "✅ Transaksi berhasil dibayar via mutasi sebesar Rp {$nominal}");
            }
        }

        if (request()->ajax()) {
            return response()->json(['status' => 'pending', 'message' => '❌ Tidak ada mutasi dengan nominal yang cocok.']);
        }
        return redirect()->route('invoice.show', $transaksi->id)->with('error', '❌ Tidak ada mutasi dengan nominal yang cocok.');
    } catch (\Exception $e) {
        if (request()->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal cek mutasi: ' . $e->getMessage()]);
        }
        return redirect()->back()->with('error', 'Gagal cek mutasi: ' . $e->getMessage());
    }
})->name('mutasi.manual');

Route::get('/create-payment', [\App\Http\Controllers\PaymentSettingController::class, 'createPayment']);
Route::get('/cek-mutasi', [\App\Http\Controllers\PaymentSettingController::class, 'cekMutasi']);
