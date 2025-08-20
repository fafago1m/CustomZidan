<?php

namespace App\Notifications;

use App\Models\Transaksi;
use App\Models\User;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSaleNotification extends Notification
{
    use Queueable;

    public Transaksi $transaksi;

    /**
     * Create a new notification instance.
     */
    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(User $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Penjualan Baru!')
            ->icon('heroicon-o-shopping-cart')
            ->body("Produk '{$this->transaksi->produk->nama}' telah dibeli oleh {$this->transaksi->nama}.")
            ->actions([
                FilamentNotification\Actions\Action::make('view')
                    ->label('Lihat Transaksi')
                    ->url(route('filament.admin.resources.transaksis.edit', $this->transaksi)),
            ])
            ->getDatabaseMessage();
    }
}
