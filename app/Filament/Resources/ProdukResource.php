<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->maxLength(1000),

            Forms\Components\FileUpload::make('gambar')
                ->label('Foto Produk')
                ->image()
                ->directory('produk-images')
                ->imagePreviewHeight('200')
                ->required(),

            Forms\Components\Select::make('tipe')
                ->options([
                    'file' => 'File',
                    'link' => 'Link',
                ])
                ->required()
                ->reactive(),

            Forms\Components\FileUpload::make('file_path')
                ->label('Upload File Produk')
                ->directory('produk-files')
                ->visible(fn ($get) => $get('tipe') === 'file'),

            Forms\Components\TextInput::make('link')
                ->label('Link Produk')
                ->visible(fn ($get) => $get('tipe') === 'link'),

            Forms\Components\TextInput::make('harga')
                ->numeric()
                ->required()
                ->prefix('Rp'),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('gambar')
                ->label('Foto')
                ->circular()
                ->height(50),

            Tables\Columns\TextColumn::make('nama')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('harga')
                ->money('IDR')
                ->sortable(),

            Tables\Columns\TextColumn::make('tipe')
                ->badge(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
