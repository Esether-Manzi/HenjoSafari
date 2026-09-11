<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Pages\ViewPage;
use App\Models\Page;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
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
                ->icon(Heroicon::OutlinedDocumentText)
                ->iconColor('gold')
                ->schema([
                    TextInput::make('title')->required()->maxLength(255)->live(onBlur: true),
                    TextInput::make('slug')->maxLength(255)->helperText('Used by the frontend to fetch this page, e.g. "about", "booking-policy".'),
                    Checkbox::make('is_active')->default(true),
                ])->columns(2),

            Section::make('Hero')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
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
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->label('Featured Image (card / share thumbnail)')
                        ->collection('featured_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Body Content')
                ->icon(Heroicon::OutlinedNewspaper)
                ->iconColor('blue')
                ->schema([
                    Textarea::make('content')->hiddenLabel()->rows(10)->helperText('Long-form copy. Separate paragraphs with a blank line.'),
                ]),

            Section::make('Content Sections')
                ->icon(Heroicon::OutlinedSquares2x2)
                ->iconColor('purple')
                ->description('Repeatable icon/title/description cards, e.g. "Why Travel With Us" or "Our Services". Use the same Group name to render several cards together on the frontend. For the Travel Information page\'s "articles" group, fill in Slug, Full Article Body, and the Official Government Link too - those cards render as a grid with a "Read More" button to a full article page.')
                ->schema([
                    Repeater::make('sections')
                        ->hiddenLabel()
                        ->schema([
                            TextInput::make('group')->required()->maxLength(100)->helperText('e.g. why-travel, features, offers, articles'),
                            TextInput::make('icon')->maxLength(100),
                            TextInput::make('title')->required()->maxLength(255),
                            TextInput::make('slug')->maxLength(255)->helperText('Only needed for cards that link to a full article, e.g. entry-requirements-kenya. Must be unique within the group.'),
                            Textarea::make('description')->rows(3)->helperText('Short teaser shown on the card (2-3 sentences).')->columnSpanFull(),
                            Textarea::make('body')->rows(10)->helperText('Full article text for the "Read More" page. Leave blank lines between paragraphs. Start a line with "## " for a subheading, or "- " for a bullet point.')->columnSpanFull(),
                            Textarea::make('body_sw')->label('Full Article Body (Kiswahili)')->rows(10)->helperText('Optional Kiswahili translation of the body above, using the same "## " and "- " formatting. Shown when a visitor switches language on the article page.')->columnSpanFull(),
                            TextInput::make('source_url')->label('Official Government Link')->url()->maxLength(500)->helperText('Link to the official government immigration/visa website, e.g. https://www.etakenya.go.ke'),
                            TextInput::make('source_label')->label('Government Link Button Text')->maxLength(150)->helperText('e.g. "Visit the Kenya eTA website"'),
                            TextInput::make('sort_order')->numeric()->default(0),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                ]),

            Section::make('SEO')
                ->icon(Heroicon::OutlinedGlobeAlt)
                ->iconColor('green')
                ->schema([
                    TextInput::make('meta_title')->maxLength(255),
                    Textarea::make('meta_description')->rows(2),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Page')
                ->icon(Heroicon::OutlinedDocumentText)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextEntry::make('title')->weight('bold'),
                    TextEntry::make('slug')->badge()->color('gray'),
                    IconEntry::make('is_active')->boolean(),
                ]),

            Section::make('Hero')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->columns(2)
                ->schema([
                    SpatieMediaLibraryImageEntry::make('hero_image')
                        ->collection('hero_image')
                        ->height('10rem')
                        ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                    SpatieMediaLibraryImageEntry::make('featured_image')
                        ->collection('featured_image')
                        ->height('10rem')
                        ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                    TextEntry::make('hero_title')->placeholder('-'),
                    TextEntry::make('hero_subtitle')->placeholder('-'),
                    TextEntry::make('hero_cta_text')->placeholder('-'),
                    TextEntry::make('hero_cta_href')->placeholder('-'),
                ]),

            Section::make('Body Content')
                ->icon(Heroicon::OutlinedNewspaper)
                ->iconColor('blue')
                ->schema([
                    TextEntry::make('content')->hiddenLabel()->placeholder('-')->prose(),
                ]),

            Section::make('Content Sections')
                ->icon(Heroicon::OutlinedSquares2x2)
                ->iconColor('purple')
                ->schema([
                    RepeatableEntry::make('sections')
                        ->hiddenLabel()
                        ->columns(2)
                        ->schema([
                            TextEntry::make('group')->badge()->color('purple'),
                            TextEntry::make('title')->weight('bold'),
                            TextEntry::make('slug')->placeholder('-')->badge()->color('gray'),
                            TextEntry::make('source_url')->label('Government Link')->placeholder('-')->url(fn ($state) => $state, true),
                            TextEntry::make('description')->placeholder('-')->columnSpanFull(),
                            TextEntry::make('body')->label('Full Article Body')->placeholder('-')->columnSpanFull()->prose(),
                        ]),
                ]),

            Section::make('SEO')
                ->icon(Heroicon::OutlinedGlobeAlt)
                ->iconColor('green')
                ->columns(2)
                ->schema([
                    TextEntry::make('meta_title')->placeholder('-'),
                    TextEntry::make('meta_description')->placeholder('-'),
                ]),

            Section::make('Record')
                ->icon(Heroicon::OutlinedClock)
                ->columns(2)
                ->collapsible()
                ->schema([
                    TextEntry::make('created_at')->dateTime()->placeholder('-'),
                    TextEntry::make('updated_at')->dateTime()->placeholder('-'),
                ]),
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
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'view' => ViewPage::route('/{record}'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
