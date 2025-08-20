<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        // Admin sees all, Reseller sees their own
        $produkCount = $user->hasRole('admin')
            ? Produk::count()
            : Produk::where('user_id', $user->id)->count();

        $transaksiQuery = $user->hasRole('admin')
            ? Transaksi::query()
            : Transaksi::whereHas('produk', fn($q) => $q->where('user_id', $user->id));

        $transaksiCount = $transaksiQuery->count();
        $totalRevenue = $transaksiQuery->where('status', 'paid')->sum('amount');

        $stats = [
            Stat::make('Total Produk', $produkCount)
                ->description('Jumlah produk yang dikelola')
                ->icon('heroicon-o-rectangle-stack'),
            Stat::make('Total Transaksi', $transaksiCount)
                ->description('Jumlah semua transaksi')
                ->icon('heroicon-o-shopping-cart'),
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Pendapatan dari transaksi lunas')
                ->icon('heroicon-o-banknotes'),
        ];

        // Total Users only visible to admin
        if ($user->hasRole('admin')) {
            array_unshift($stats, Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->icon('heroicon-o-users'));
        }

        return $stats;
    }
}
