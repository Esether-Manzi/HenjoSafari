<?php

namespace App\Filament\Resources\SafariCategories;

use App\Filament\Resources\SafariCategories\Pages\CreateSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\EditSafariCategory;
use App\Filament\Resources\SafariCategories\Pages\ListSafariCategories;
use App\Filament\Resources\SafariCategories\Pages\ViewSafariCategory;
use App\Models\SafariCategory;
use App\Support\SafariIcons;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
            Section::make('Category')
                ->icon(Heroicon::OutlinedTag)
                ->iconColor('purple')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('slug')->maxLength(255),
                    Select::make('icon')
                        ->label('Icon')
                        ->options(SafariIcons::selectOptions())
                        ->allowHtml()
                        ->searchable()
                        ->native(false)
                        ->helperText('Shown next to this category on the public site.')
                        ->columnSpanFull(),
                    Textarea::make('description')->rows(5)->columnSpanFull(),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Category')
                ->icon(Heroicon::OutlinedTag)
                ->iconColor('purple')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')->weight('bold'),
                    TextEntry::make('slug')->badge()->color('gray'),
                    TextEntry::make('icon')
                        ->label('Icon')
                        ->html()
                        ->state(fn (SafariCategory $record): string => ($record->icon
                            ? SafariIcons::preview($record->icon).' '.e(SafariIcons::label($record->icon))
                            : null) ?? '-'),
                    TextEntry::make('description')->placeholder('-')->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')
                    ->label('Icon')
                    ->html()
                    ->state(fn (SafariCategory $record): string => SafariIcons::preview($record->icon) ?? '—'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->searchable(),
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
            'index' => ListSafariCategories::route('/'),
            'create' => CreateSafariCategory::route('/create'),
            'view' => ViewSafariCategory::route('/{record}'),
            'edit' => EditSafariCategory::route('/{record}/edit'),
        ];
    }
}
