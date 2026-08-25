<?php

namespace App\Filament\Resources\Accommodations;

use App\Filament\Resources\Accommodations\Pages\CreateAccommodation;
use App\Filament\Resources\Accommodations\Pages\EditAccommodation;
use App\Filament\Resources\Accommodations\Pages\ListAccommodations;
use App\Filament\Resources\Accommodations\Pages\ViewAccommodation;
use App\Models\Accommodation;
use App\Support\ValidationPatterns;
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

class AccommodationResource extends Resource
{
    protected static ?string $model = Accommodation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Accommodation';

    protected static ?string $modelLabel = 'Accommodation';

    protected static ?string $pluralModelLabel = 'Accommodation';

    protected static string|UnitEnum|null $navigationGroup = 'Tour Management';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Property Details')
                ->icon(Heroicon::OutlinedHome)
                ->iconColor('gold')
                ->description('The core identity of the accommodation.')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('slug')->maxLength(255),
                    Select::make('type')
                        ->options([
                            'hotel' => 'Hotel',
                            'lodge' => 'Lodge',
                            'camp' => 'Camp',
                            'resort' => 'Resort',
                            'guesthouse' => 'Guesthouse',
                        ])
                        ->required(),
                    TextInput::make('star_rating')->numeric()->suffix('★')->minValue(1)->maxValue(5),
                    TextInput::make('location')->maxLength(255)->columnSpanFull(),
                    Textarea::make('description')->rows(5)->columnSpanFull(),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->description('How guests or the office can reach this property.')
                ->columns(2)
                ->schema([
                    TextInput::make('website')->url()->maxLength(255)->prefixIcon(Heroicon::OutlinedGlobeAlt),
                    TextInput::make('phone')->maxLength(50)->regex(ValidationPatterns::PHONE)->prefixIcon(Heroicon::OutlinedPhone),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Property Details')
                ->icon(Heroicon::OutlinedHome)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')->weight('bold'),
                    TextEntry::make('type')->badge()->color('gold')->placeholder('-'),
                    TextEntry::make('star_rating')->label('Rating')->suffix(' ★')->placeholder('-'),
                    TextEntry::make('location')->icon(Heroicon::OutlinedMapPin)->placeholder('-'),
                    TextEntry::make('description')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('website')->url(fn ($state) => $state, true)->placeholder('-'),
                    TextEntry::make('phone')->placeholder('-'),
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
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('type'),
                TextColumn::make('location'),
                TextColumn::make('phone'),
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
            'index' => ListAccommodations::route('/'),
            'create' => CreateAccommodation::route('/create'),
            'view' => ViewAccommodation::route('/{record}'),
            'edit' => EditAccommodation::route('/{record}/edit'),
        ];
    }
}
