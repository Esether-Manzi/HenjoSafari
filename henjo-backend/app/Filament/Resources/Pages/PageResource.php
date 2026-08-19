<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Pages\ViewPage;
use App\Models\Page;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $navigationLabel = 'Pages';

    protected static ?string $modelLabel = 'Page';

    protected static ?string $pluralModelLabel = 'Pages';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Page')
                ->schema([
                    TextInput::make('title')->required()->maxLength(255)->live(onBlur: true),
                    TextInput::make('slug')->maxLength(255)->helperText('Used by the frontend to fetch this page, e.g. "about", "booking-policy".'),
                    Checkbox::make('is_active')->default(true),
                ])->columns(2),

            Section::make('Hero')
                ->schema([
                    TextInput::make('hero_title')->maxLength(255),
                    TextInput::make('hero_subtitle')->maxLength(500),
                    TextInput::make('hero_cta_text')->maxLength(100),
                    TextInput::make('hero_cta_href')->maxLength(255),
                    SpatieMediaLibraryFileUpload::make('hero_image')
                        ->collection('hero_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Body Content')
                ->schema([
                    Textarea::make('content')->rows(10)->helperText('Long-form copy. Separate paragraphs with a blank line.'),
                ]),

            Section::make('Content Sections')
                ->description('Repeatable icon/title/description cards, e.g. "Why Travel With Us" or "Our Services". Use the same Group name to render several cards together on the frontend.')
                ->schema([
                    Repeater::make('sections')
                        ->schema([
                            TextInput::make('group')->required()->maxLength(100)->helperText('e.g. why-travel, features, offers'),
                            TextInput::make('icon')->maxLength(100),
                            TextInput::make('title')->required()->maxLength(255),
                            Textarea::make('description')->rows(3),
                            TextInput::make('sort_order')->numeric()->default(0),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                ]),

            Section::make('SEO')
                ->schema([
                    TextInput::make('meta_title')->maxLength(255),
                    Textarea::make('meta_description')->rows(2),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('title'),
            TextEntry::make('slug'),
            TextEntry::make('hero_title'),
            TextEntry::make('hero_subtitle'),
            TextEntry::make('content'),
            TextEntry::make('is_active'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->searchable(),
                IconColumn::make('is_active')->boolean(),
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
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'view' => ViewPage::route('/{record}'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
