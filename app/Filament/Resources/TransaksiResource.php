<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Toko';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('email')->email(),
                TextInput::make('no_wa')->label('No WhatsApp')->required(),
                Select::make('produk_id')->relationship('produk', 'nama')->required(),
                Select::make('status')->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                ]),
                TextInput::make('kode_unik')->numeric()->readOnly(),
                TextInput::make('amount')->numeric()->readOnly(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Pembeli')->searchable(),
                Tables\Columns\TextColumn::make('no_wa')->label('No. WA'),
                Tables\Columns\TextColumn::make('produk.nama')->label('Produk')->searchable(),
                Tables\Columns\TextColumn::make('produk.user.name')->label('Reseller')->searchable()->sortable()->visible(fn () => Auth::user()->hasRole('admin')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user()->hasRole('resseler')) {
            $query->whereHas('produk', function (Builder $query) {
                $query->where('user_id', Auth::id());
            });
        }

        return $query;
    }
}
