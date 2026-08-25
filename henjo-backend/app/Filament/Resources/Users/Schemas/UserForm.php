<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Support\ValidationPatterns;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->icon(Heroicon::OutlinedIdentification)
                    ->iconColor('gold')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->avatar()
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->regex(ValidationPatterns::EMAIL)
                            ->required(),
                    ]),

                Section::make('Security')
                    ->icon(Heroicon::OutlinedShieldCheck)
                    ->iconColor('blue')
                    ->columns(2)
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->required(),
                        DateTimePicker::make('email_verified_at'),
                    ]),
            ]);
    }
}
