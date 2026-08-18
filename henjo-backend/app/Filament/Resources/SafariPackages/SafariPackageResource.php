<?php

namespace App\Filament\Resources\SafariPackages;

use App\Filament\Resources\SafariPackages\Pages\CreateSafariPackage;
use App\Filament\Resources\SafariPackages\Pages\EditSafariPackage;
use App\Filament\Resources\SafariPackages\Pages\ListSafariPackages;
use App\Filament\Resources\SafariPackages\Pages\ViewSafariPackage;
use App\Models\SafariPackage;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SafariPackageResource extends Resource
{
    protected static ?string $model = SafariPackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $navigationLabel = 'Safari Packages';

    protected static ?string $modelLabel = 'Safari Package';

    protected static ?string $pluralModelLabel = 'Safari Packages';

    protected static string|UnitEnum|null $navigationGroup = 'Tour Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->maxLength(255),
            TextInput::make('slug')->maxLength(255),
            Select::make('destination_id')
                ->relationship('destination', 'name')
                ->searchable()
                ->preload()
                ->required(),
            Textarea::make('summary')->rows(3),
            Textarea::make('description')->rows(5),
            TextInput::make('duration_days')->numeric()->required(),
            TextInput::make('duration_nights')->numeric()->required(),
            TextInput::make('base_price')->numeric()->required(),
            TextInput::make('currency')->default('USD')->maxLength(3),
            TextInput::make('min_people')->numeric(),
            TextInput::make('max_people')->numeric(),
            Toggle::make('featured'),
            Toggle::make('popular'),
            TextInput::make('status')->default('published')->maxLength(50),
            SpatieMediaLibraryFileUpload::make('cover')
                ->collection('cover')
                ->image()
                ->imageEditor()
                ->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('gallery')
                ->collection('gallery')
                ->image()
                ->multiple()
                ->reorderable()
                ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('title'),
            TextEntry::make('destination.name')->label('Destination'),
            TextEntry::make('summary'),
            TextEntry::make('base_price')->money('USD'),
            TextEntry::make('status'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label('Cover'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('destination.name')->label('Destination')->sortable(),
                TextColumn::make('base_price')->money('USD')->sortable(),
                IconColumn::make('featured')->boolean(),
                TextColumn::make('status')->badge(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSafariPackages::route('/'),
            'create' => CreateSafariPackage::route('/create'),
            'view' => ViewSafariPackage::route('/{record}'),
            'edit' => EditSafariPackage::route('/{record}/edit'),
        ];
    }
}
