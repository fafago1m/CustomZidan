<?php

namespace App\Filament\Resources\TransaksiResource\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalPembelian extends BaseWidget
{
    protected function getCards(): array
    {
        $totalPaid = Transaksi::where('status', 'paid')
            ->with('produk')
            ->get()
            ->sum(fn ($transaksi) => $transaksi->produk->harga ?? 0);

        $totalPending = Transaksi::where('status', 'pending')
            ->with('produk')
            ->get()
            ->sum(fn ($transaksi) => $transaksi->produk->harga ?? 0);

        return [
            Card::make('Total Pembelian (Paid)', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
                ->description('Total transaksi berhasil')
                ->color('success'),

            Card::make('Total Pending', 'Rp ' . number_format($totalPending, 0, ',', '.'))
                ->description('Menunggu pembayaran')
                ->color('warning'),

            Card::make('Total Transaksi', Transaksi::count())
                ->description('Jumlah semua transaksi')
                ->color('primary'),
        ];
    }
}
