<?php

namespace App\Filament\Resources\PaymentSettingResource\Pages;

use App\Filament\Resources\PaymentSettingResource;
use App\Models\PaymentSetting;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Http;

class MutasiQr extends Page
{
    protected static string $resource = PaymentSettingResource::class;

    protected static string $view = 'filament.resources.payment-setting-resource.pages.mutasi-qr';

    public $mutasi = [];

    public function mount(): void
    {
        $setting = PaymentSetting::first();

        if (!$setting) {
            $this->mutasi = ['error' => 'API key belum diatur'];
            return;
        }

        $url = "https://actressapi.vercel.app/orderkuota/mutasiqr?apikey={$setting->apikey}&username={$setting->username}&token={$setting->token}";

        try {
            $response = Http::timeout(10)->get($url);
            $this->mutasi = $response->json();
        } catch (\Exception $e) {
            $this->mutasi = ['error' => 'Gagal mengambil data: ' . $e->getMessage()];
        }
    }
}
