<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentSettingResource\Pages;
use App\Filament\Resources\PaymentSettingResource\RelationManagers;
use App\Models\PaymentSetting;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentSettingResource extends Resource
{
    protected static ?string $model = PaymentSetting::class;

   protected static ?string $navigationGroup = 'Pembayaran';
protected static ?string $navigationLabel = 'Pengaturan Pembayaran & Mutasi';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

  public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('apikey')
                ->label('API Key')
                ->required()
                ->maxLength(255),

            TextInput::make('username')
                ->label('Username')
                ->required()
                ->maxLength(255),

            TextInput::make('token')
                ->label('Token')
                ->required()
                ->maxLength(255),

            \Filament\Forms\Components\Textarea::make('codeqr')
                ->label('Kode QR')
                ->rows(5)
                ->required()
                ->columnSpan('full'),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPaymentSettings::route('/'),
            'create' => Pages\CreatePaymentSetting::route('/create'),
            'edit' => Pages\EditPaymentSetting::route('/{record}/edit'),
            'mutasi' => Pages\MutasiQr::route('/mutasi-qr'),
        ];
    }
}
