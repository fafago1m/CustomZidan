<?php

namespace App\Filament\Resources\PaymentSettingResource\Pages;

use App\Filament\Resources\PaymentSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentSetting extends EditRecord
{
    protected static string $resource = PaymentSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
            Actions\Action::make('Lihat Mutasi QR')
                ->url('/admin/payment-settings/mutasi-qr
') // ini route yang kamu ingin buka
                ->openUrlInNewTab() // opsional: buka di tab baru
                ->icon('heroicon-o-arrow-up-right')
                ->color('primary'),
        ];
    }
}
