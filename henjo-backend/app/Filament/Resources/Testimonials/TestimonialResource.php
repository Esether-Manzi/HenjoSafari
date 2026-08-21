<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Resources\Testimonials\Pages\ListTestimonials;
use App\Filament\Resources\Testimonials\Pages\ViewTestimonial;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
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

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeft;

    protected static ?string $navigationLabel = 'Testimonials';

    protected static ?string $modelLabel = 'Testimonial';

    protected static ?string $pluralModelLabel = 'Testimonials';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Traveler')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->collection('avatar')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->avatar()
                        ->columnSpanFull(),
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('country')->maxLength(255),
                    TextInput::make('trip_name')->maxLength(255),
                ]),

            Section::make('Testimonial')
                ->icon(Heroicon::OutlinedChatBubbleLeft)
                ->iconColor('purple')
                ->columns(2)
                ->schema([
                    Textarea::make('testimonial')->rows(5)->columnSpanFull(),
                    TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->suffix('★'),
                    Checkbox::make('featured'),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Traveler')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    SpatieMediaLibraryImageEntry::make('avatar')
                        ->collection('avatar')
                        ->hiddenLabel()
                        ->circular()
                        ->size(64)
                        ->columnSpanFull(),
                    TextEntry::make('name')->weight('bold'),
                    TextEntry::make('country')->icon(Heroicon::OutlinedGlobeAlt)->placeholder('-'),
                    TextEntry::make('trip_name')->label('Trip')->placeholder('-'),
                ]),

            Section::make('Testimonial')
                ->icon(Heroicon::OutlinedChatBubbleLeft)
                ->iconColor('purple')
                ->columns(2)
                ->schema([
                    TextEntry::make('testimonial')->placeholder('-')->columnSpanFull(),
                    TextEntry::make('rating')->suffix(' ★'),
                    IconEntry::make('featured')->boolean(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('trip_name')->searchable(),
                TextColumn::make('rating'),
                IconColumn::make('featured')->boolean(),
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
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'view' => ViewTestimonial::route('/{record}'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }
}
