<?php

namespace App\Filament\Resources\SafariPackages;

use App\Filament\Resources\SafariPackages\Pages\CreateSafariPackage;
use App\Filament\Resources\SafariPackages\Pages\EditSafariPackage;
use App\Filament\Resources\SafariPackages\Pages\ListSafariPackages;
use App\Filament\Resources\SafariPackages\Pages\ViewSafariPackage;
use App\Models\SafariPackage;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
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
            Section::make('Package Details')
                ->icon(Heroicon::OutlinedMap)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextInput::make('title')->required()->maxLength(255),
                    TextInput::make('slug')->maxLength(255),
                    Select::make('destination_id')
                        ->label('Destination')
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('currency')->default('USD')->maxLength(3),
                    Textarea::make('summary')->rows(3)->columnSpanFull(),
                    Textarea::make('description')->rows(5)->columnSpanFull(),
                ]),

            Section::make('Trip Facts')
                ->icon(Heroicon::OutlinedCalendarDays)
                ->iconColor('blue')
                ->columns(4)
                ->schema([
                    TextInput::make('duration_days')->numeric()->required(),
                    TextInput::make('duration_nights')->numeric()->required(),
                    TextInput::make('min_people')->numeric(),
                    TextInput::make('max_people')->numeric(),
                ]),

            Section::make('Pricing')
                ->icon(Heroicon::OutlinedBanknotes)
                ->iconColor('green')
                ->columns(2)
                ->schema([
                    TextInput::make('base_price')->numeric()->required()->prefix('$')
                        ->helperText('0 shows "Contact for Price" on the site.'),
                    TextInput::make('price_max')->numeric()->prefix('$')
                        ->helperText('Optional — set only if the price is a range.'),
                ]),

            Section::make('Trip Style')
                ->icon(Heroicon::OutlinedUserGroup)
                ->iconColor('gold')
                ->columns(3)
                ->schema([
                    Select::make('tour_privacy')
                        ->options([
                            'private' => 'Private',
                            'exclusive_private' => 'Exclusive Private',
                            'shared' => 'Shared / Group',
                        ]),
                    Select::make('comfort_level')
                        ->options([
                            'budget' => 'Budget',
                            'mid-range' => 'Mid-range',
                            'luxury' => 'Luxury',
                        ]),
                    TextInput::make('accommodation_style')->maxLength(255)
                        ->placeholder('e.g. Lodge-based'),
                    TextInput::make('min_age')->numeric()->label('Minimum Age'),
                    Toggle::make('customizable'),
                    Toggle::make('solo_travelers_ok')->label('Suitable for Solo Travelers'),
                    TextInput::make('start_flexibility')->maxLength(255)->columnSpan(3)
                        ->placeholder('e.g. Can start any day, subject to availability.'),
                ]),

            Section::make('Media')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->schema([
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
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('maroon')
                ->columns(3)
                ->schema([
                    Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                        ])
                        ->default('published')
                        ->required(),
                    Toggle::make('featured'),
                    Toggle::make('popular'),
                ]),

            Section::make('Itinerary')
                ->icon(Heroicon::OutlinedCalendarDays)
                ->iconColor('blue')
                ->schema([
                    Repeater::make('itineraryDays')
                        ->relationship('itineraryDays')
                        ->label('Days')
                        ->orderColumn('day_number')
                        ->reorderableWithButtons()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => isset($state['day_number'], $state['title'])
                            ? "Day {$state['day_number']}: {$state['title']}"
                            : null)
                        ->schema([
                            TextInput::make('day_number')->numeric()->required(),
                            TextInput::make('day_number_end')->numeric()
                                ->helperText('Only set if this entry spans multiple days, e.g. "Day 2-3".'),
                            TextInput::make('destination')->maxLength(255),
                            TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                            Textarea::make('description')->rows(3)->columnSpanFull(),
                            TextInput::make('accommodation')->maxLength(255)->columnSpanFull(),
                            Toggle::make('breakfast')->default(true),
                            Toggle::make('lunch')->default(true),
                            Toggle::make('dinner')->default(true),
                        ])
                        ->columns(3)
                        ->columnSpanFull(),
                ]),

            Section::make("What's Included / Excluded")
                ->icon(Heroicon::OutlinedClipboardDocumentList)
                ->iconColor('green')
                ->columns(2)
                ->schema([
                    Repeater::make('inclusions')
                        ->relationship('inclusions')
                        ->label('Inclusions')
                        ->orderColumn('display_order')
                        ->reorderableWithButtons()
                        ->simple(TextInput::make('item')->required()),
                    Repeater::make('exclusions')
                        ->relationship('exclusions')
                        ->label('Exclusions')
                        ->orderColumn('display_order')
                        ->reorderableWithButtons()
                        ->simple(TextInput::make('item')->required()),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Cover')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->visible(fn (SafariPackage $record) => $record->hasMedia('cover'))
                ->schema([
                    SpatieMediaLibraryImageEntry::make('cover')
                        ->collection('cover')
                        ->hiddenLabel()
                        ->height('16rem')
                        ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                ]),

            Section::make('Package Details')
                ->icon(Heroicon::OutlinedMap)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextEntry::make('title')->weight('bold')->size('lg'),
                    TextEntry::make('destination.name')->label('Destination')->icon(Heroicon::OutlinedMapPin),
                    TextEntry::make('summary')->placeholder('-')->columnSpanFull(),
                    TextEntry::make('description')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Trip Facts')
                ->icon(Heroicon::OutlinedCalendarDays)
                ->iconColor('blue')
                ->columns(4)
                ->schema([
                    TextEntry::make('duration_days')->label('Days')->numeric(),
                    TextEntry::make('duration_nights')->label('Nights')->numeric(),
                    TextEntry::make('min_people')->label('Min People')->placeholder('-'),
                    TextEntry::make('max_people')->label('Max People')->placeholder('-'),
                ]),

            Section::make('Pricing')
                ->icon(Heroicon::OutlinedBanknotes)
                ->iconColor('green')
                ->columns(2)
                ->schema([
                    TextEntry::make('base_price')
                        ->label('Base Price')
                        ->size('lg')
                        ->weight('bold')
                        ->money(fn (SafariPackage $record) => $record->currency ?? 'USD'),
                    TextEntry::make('price_max')
                        ->label('Price Max')
                        ->placeholder('-')
                        ->money(fn (SafariPackage $record) => $record->currency ?? 'USD'),
                ]),

            Section::make('Trip Style')
                ->icon(Heroicon::OutlinedUserGroup)
                ->iconColor('gold')
                ->columns(3)
                ->schema([
                    TextEntry::make('tour_privacy')->badge()->placeholder('-'),
                    TextEntry::make('comfort_level')->badge()->placeholder('-'),
                    TextEntry::make('accommodation_style')->placeholder('-'),
                    TextEntry::make('min_age')->label('Minimum Age')->placeholder('-'),
                    IconEntry::make('customizable')->boolean(),
                    IconEntry::make('solo_travelers_ok')->label('Solo-Friendly')->boolean(),
                    TextEntry::make('start_flexibility')->placeholder('-')->columnSpan(3),
                ]),

            Section::make('Gallery')
                ->icon(Heroicon::OutlinedSquares2x2)
                ->iconColor('teal')
                ->visible(fn (SafariPackage $record) => $record->hasMedia('gallery'))
                ->schema([
                    SpatieMediaLibraryImageEntry::make('gallery')
                        ->collection('gallery')
                        ->hiddenLabel()
                        ->extraImgAttributes(['class' => 'rounded-lg object-cover'])
                        ->height('6rem'),
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('maroon')
                ->columns(3)
                ->schema([
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => $state === 'published' ? 'success' : 'gray'),
                    IconEntry::make('featured')->boolean(),
                    IconEntry::make('popular')->boolean(),
                ]),
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
