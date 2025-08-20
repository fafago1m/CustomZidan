<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TransaksiResource;
use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestTransactions extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(self::getEloquentQuery())
            ->columns([
                Tables\Columns\TextColumn::make('produk.nama')->label('Produk'),
                Tables\Columns\TextColumn::make('nama')->label('Pembeli'),
                Tables\Columns\TextColumn::make('amount')->money('IDR')->label('Total'),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    default => 'gray',
                }),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->url(fn (Transaksi $record): string => TransaksiResource::getUrl('edit', ['record' => $record])),
            ]);
    }

    protected static function getEloquentQuery(): Builder
    {
        $query = Transaksi::query()->latest()->limit(5);
        $user = Auth::user();

        if ($user->hasRole('resseler')) {
            $query->whereHas('produk', function (Builder $q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        return $query;
    }
}
