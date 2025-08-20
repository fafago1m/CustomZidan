<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Auth;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (Auth::user()->hasRole('reseller')) {
            $data['user_id'] = Auth::id();
        }

        return $data;
    }
}
