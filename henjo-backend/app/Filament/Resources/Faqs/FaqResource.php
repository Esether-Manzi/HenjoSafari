<?php

namespace App\Filament\Resources\Faqs;

use App\Filament\Resources\Faqs\Pages\CreateFaq;
use App\Filament\Resources\Faqs\Pages\EditFaq;
use App\Filament\Resources\Faqs\Pages\ListFaqs;
use App\Filament\Resources\Faqs\Pages\ViewFaq;
use App\Models\Faq;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static ?string $navigationLabel = 'FAQs';

    protected static ?string $modelLabel = 'FAQ';

    protected static ?string $pluralModelLabel = 'FAQs';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'question';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Question & Answer')
                ->icon(Heroicon::OutlinedQuestionMarkCircle)
                ->iconColor('purple')
                ->schema([
                    TextInput::make('question')->required()->maxLength(255)->columnSpanFull(),
                    Textarea::make('answer')->rows(5)->columnSpanFull(),
                ]),

            Section::make('Display')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextInput::make('display_order')->numeric()->default(0),
                    Checkbox::make('is_active')->default(true),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Question & Answer')
                ->icon(Heroicon::OutlinedQuestionMarkCircle)
                ->iconColor('purple')
                ->schema([
                    TextEntry::make('question')->weight('bold')->columnSpanFull(),
                    TextEntry::make('answer')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Display')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('display_order')->numeric()->badge()->color('gray'),
                    IconEntry::make('is_active')->boolean(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->searchable()->sortable(),
                TextColumn::make('display_order')->sortable(),
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
            'index' => ListFaqs::route('/'),
            'create' => CreateFaq::route('/create'),
            'view' => ViewFaq::route('/{record}'),
            'edit' => EditFaq::route('/{record}/edit'),
        ];
    }
}
