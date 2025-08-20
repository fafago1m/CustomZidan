<?php

namespace App\Notifications;

use App\Models\Transaksi;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSaleNotification extends Notification
{
    use Queueable;

    public Transaksi $transaksi;

    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Penjualan Baru!')
            ->icon('heroicon-o-shopping-cart')
            ->body("Produk '{$this->transaksi->produk->nama}' telah dibeli oleh {$this->transaksi->nama}.")
            ->actions([
                Action::make('view')
                    ->label('Lihat Transaksi')
                    ->url(route('filament.admin.resources.transaksis.edit', $this->transaksi)),
            ])
            ->getDatabaseMessage();
    }
}
