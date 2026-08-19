<?php

namespace App\Filament\Resources\Menus;

use App\Filament\Resources\Menus\Pages\CreateMenu;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Models\Menu;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $navigationLabel = 'Menus';

    protected static ?string $modelLabel = 'Menu Item';

    protected static ?string $pluralModelLabel = 'Menus';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('location')
                ->options([
                    'navbar' => 'Navbar',
                    'footer' => 'Footer',
                ])
                ->required()
                ->live(),
            Select::make('parent_id')
                ->label('Parent (leave empty for a top-level item)')
                ->relationship(
                    'parent',
                    'label',
                    fn ($query, $get) => $query
                        ->where('location', $get('location'))
                        ->whereNull('parent_id'),
                )
                ->searchable()
                ->preload(),
            TextInput::make('label')->required()->maxLength(255),
            TextInput::make('url')->required()->maxLength(255)->placeholder('/safaris or https://...'),
            TextInput::make('sort_order')->numeric()->default(0),
            Checkbox::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location')->badge()->sortable(),
                TextColumn::make('label')->searchable()->sortable(),
                TextColumn::make('url'),
                TextColumn::make('parent.label')->label('Parent')->placeholder('— top level —'),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
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
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
}
