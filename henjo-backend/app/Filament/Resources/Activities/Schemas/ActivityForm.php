<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Support\SafariIcons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Activity Information')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->iconColor('gold')
                    ->description('The name, icon, and description shown on the public site.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),

                        Select::make('icon')
                            ->label('Icon')
                            ->options(SafariIcons::selectOptions())
                            ->allowHtml()
                            ->searchable()
                            ->native(false)
                            ->helperText('Shown next to the activity on the public site.'),

                        Textarea::make('description')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Image')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->iconColor('teal')
                    ->description('A cover photo representing this activity.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
