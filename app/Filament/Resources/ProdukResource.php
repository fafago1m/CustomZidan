<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // PERBAIKAN: Hanya satu field untuk user_id.
                // Field ini hanya akan muncul jika user yang login adalah admin.
                Forms\Components\Select::make('user_id')
                    ->label('Pemilik')
                    // Menggunakan relationship() lebih bersih dan efisien.
                    ->relationship('user', 'name', modifyQueryUsing: function (Builder $query) {
                        return $query->whereHas('roles', function ($q) {
                            $q->where('name', 'reseller');
                        });
                    })
                    ->searchable()
                    ->required() // Wajib diisi oleh admin.
                    ->visible(fn () => Auth::user()->hasRole('admin')),

                // Untuk reseller, user_id akan diisi otomatis di backend,
                // jadi tidak perlu field Hidden lagi.

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
                    ->live(), // Menggunakan live() lebih disarankan daripada reactive() di v3

                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload File Produk')
                    ->directory('produk-files')
                    ->visible(fn ($get) => $get('tipe') === 'file'),

                Forms\Components\TextInput::make('link')
                    ->label('Link Produk')
                    ->url()
                    ->visible(fn ($get) => $get('tipe') === 'link'),

                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->required()
                    ->default(0),
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

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->sortable()
                    ->visible(fn () => Auth::user()->hasRole('admin')),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipe')
                    ->badge(),
            ])
            ->filters([
                //
            ])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Reseller hanya lihat produknya sendiri
        if (Auth::user()->hasRole('reseller')) {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }

    // PERBAIKAN: Logika disederhanakan.
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika yang membuat adalah reseller, otomatis set user_id.
        if (Auth::user()->hasRole('reseller')) {
            $data['user_id'] = Auth::id();
        }

        // Jika admin, user_id sudah ada dari form Select, jadi tidak perlu diubah.
        return $data;
    }

    // FUNGSI INI TETAP DIPERLUKAN: Untuk menjaga agar reseller tidak mengubah
    // kepemilikan produk saat proses edit/update.
    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Saat edit, pastikan reseller tidak bisa mengubah user_id produk.
        if (Auth::user()->hasRole('reseller')) {
            $data['user_id'] = Auth::id();
        }

        return $data;
    }
}