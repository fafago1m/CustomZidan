<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.settings';
    protected static ?string $navigationGroup = 'Admin';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSettings());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('web_name')
                    ->label('Nama Website')
                    ->required(),
                TextInput::make('social_media_link_1')
                    ->label('Link Media Sosial 1'),
                TextInput::make('social_media_link_2')
                    ->label('Link Media Sosial 2'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $this->form->validate();
        $this->saveSettings($this->form->getState());
        Notification::make()
            ->title('Pengaturan disimpan')
            ->success()
            ->send();
    }

    protected function getSettings(): array
    {
        if (Storage::disk('local')->exists('settings.json')) {
            return json_decode(Storage::disk('local')->get('settings.json'), true);
        }
        return [
            'web_name' => config('app.name'),
            'social_media_link_1' => '',
            'social_media_link_2' => '',
        ];
    }

    protected function saveSettings(array $data): void
    {
        Storage::disk('local')->put('settings.json', json_encode($data));
    }

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('admin');
    }
}
