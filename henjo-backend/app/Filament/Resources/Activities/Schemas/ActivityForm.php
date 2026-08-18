<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Support\SafariIcons;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
// use Filament\SpatieLaravelMediaLibraryPlugin\Forms\Components\SpatieMediaLibraryFileUpload;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
    ->components([
        Section::make('Activity Information')
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

                SpatieMediaLibraryFileUpload::make('image')
                        ->collection('image')
                        ->image()
                        ->required(),

                // SpatieMediaLibraryFileUpload::make('image')
                //     ->collection('image')
                //     ->image()
                //     ->required(),
                // SpatieMediaLibraryImageColumn::make('icon')
                //     ->collection('icons')
                    
                //     ->required(),
                    
                Textarea::make('description')
                    ->rows(5)
                    ->columnSpanFull(),
            ])->columns(2)
        ]);
    }
}
