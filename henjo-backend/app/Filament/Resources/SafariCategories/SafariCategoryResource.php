<?php

namespace App\Filament\Resources\SafariCategories;

use App\Filament\Resources\SafariCategories\Pages\CreateSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\EditSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\ListSafariCategories;
use App\Filament\Resources\SafariCategories\Pages\ViewSafariCategory;
use App\Models\SafariCategory;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SafariCategoryResource extends Resource
{
    protected static ?string $model = SafariCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Categories';

    protected static ?string $modelLabel = 'Category';

    protected static ?string $pluralModelLabel = 'Categories';

    protected static string|UnitEnum|null $navigationGroup = 'Tour Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('slug')->maxLength(255),
            Textarea::make('description')->rows(5),
            TextInput::make('icon')->maxLength(100),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name'),
            TextEntry::make('slug'),
            TextEntry::make('description'),
            TextEntry::make('icon'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('icon'),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSafariCategories::route('/'),
            'create' => CreateSafariCategory::route('/create'),
            'view' => ViewSafariCategory::route('/{record}'),
            'edit' => EditSafariCategory::route('/{record}/edit'),
        ];
    }
}
