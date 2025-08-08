<?php

use App\Models\PaymentSetting;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        $url = "https://apiku-fafa-main.vercel.app/api/orkut/createpayment?apikey=apikeyfafa1&amount={$amount}&codeqr=00020101021126670016COM.NOBUBANK.WWW01189360050300000879140214836503664512180303UMI51440014ID.CO.QRIS.WWW0215ID20232876797160303UMI5204541153033605802ID5923FAFA%20STORE%20ID%20OK13001586006BANTUL61055518162070703A0163044BBE";

        try {
            $response = file_get_contents($url);
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

// ====================================================================
// PERBAIKAN LOGIKA PADA ROUTE INI
// ====================================================================
Route::get('/mutasi-manual/{id}', function ($id) {
    $transaksi = \App\Models\Transaksi::findOrFail($id);
    $setting = \App\Models\PaymentSetting::first();

    if (!$setting || !$setting->apikey || !$setting->username || !$setting->token) {
        // Mengembalikan JSON jika permintaan datang dari AJAX
        if (request()->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Pengaturan pembayaran belum lengkap.']);
        }
        return redirect()->back()->with('error', 'Pengaturan pembayaran belum lengkap.');
    }

    $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey={$setting->apikey}&username={$setting->username}&token={$setting->token}";

    try {
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Perbaikan: Pastikan data mutasi ada di 'result'
        if (!isset($data['result']) || empty($data['result'])) {
             // Mengembalikan JSON untuk AJAX
            if (request()->ajax()) {
                return response()->json(['status' => 'pending', 'message' => 'Data mutasi kosong.']);
            }
            return redirect()->route('invoice.show', $transaksi->id)->with('error', '❌ Data mutasi kosong.');
        }

        foreach ($data['result'] as $mutasi) {
            // Perbaikan: Ambil nominal dari field 'kredit' dan bersihkan titik
            $nominal = (int) str_replace('.', '', $mutasi['kredit']);

            // Cocokkan nominal mutasi dengan transaksi saat ini
            if (
                $transaksi->status === 'pending' &&
                $transaksi->amount == $nominal
            ) {
                $transaksi->status = 'paid';
                $transaksi->save();

                // Mengembalikan JSON dengan status 'paid' untuk AJAX
                if (request()->ajax()) {
                    return response()->json(['status' => 'paid', 'message' => "✅ Transaksi berhasil dibayar."]);
                }

                // Jika bukan AJAX, kembalikan ke halaman invoice
                return redirect()->route('invoice.show', $transaksi->id)
                    ->with('success', "✅ Transaksi berhasil dibayar via mutasi sebesar Rp {$nominal}");
            }
        }

        // Jika tidak ada mutasi yang cocok setelah looping
        if (request()->ajax()) {
            return response()->json(['status' => 'pending', 'message' => '❌ Tidak ada mutasi dengan nominal yang cocok.']);
        }
        return redirect()->route('invoice.show', $transaksi->id)->with('error', '❌ Tidak ada mutasi dengan nominal yang cocok.');
    } catch (\Exception $e) {
        // Mengembalikan JSON untuk AJAX
        if (request()->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal cek mutasi: ' . $e->getMessage()]);
        }
        return redirect()->back()->with('error', 'Gagal cek mutasi: ' . $e->getMessage());
    }
})->name('mutasi.manual');

// Tambahan untuk API, sebaiknya dihapus jika tidak digunakan
Route::get('/create-payment', [\App\Http\Controllers\PaymentSettingController::class, 'createPayment']);
Route::get('/cek-mutasi', [\App\Http\Controllers\PaymentSettingController::class, 'cekMutasi']);