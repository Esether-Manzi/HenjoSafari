<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages\CreateInquiry;
use App\Filament\Resources\Inquiries\Pages\EditInquiry;
use App\Filament\Resources\Inquiries\Pages\ListInquiries;
use App\Filament\Resources\Inquiries\Pages\ViewInquiry;
use App\Models\Inquiry;
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

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $navigationLabel = 'Inquiries';

    protected static ?string $modelLabel = 'Inquiry';

    protected static ?string $pluralModelLabel = 'Inquiries';

    protected static string|UnitEnum|null $navigationGroup = 'Bookings';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact')
                ->icon(Heroicon::OutlinedUserGroup)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('email')->email()->required()->prefixIcon(Heroicon::OutlinedEnvelope),
                    TextInput::make('phone')->maxLength(50)->prefixIcon(Heroicon::OutlinedPhone),
                    Select::make('package_id')
                        ->label('Tour Package')
                        ->relationship('safariPackage', 'title')
                        ->searchable()
                        ->preload(),
                ]),

            Section::make('Message')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                ->iconColor('gold')
                ->schema([
                    TextInput::make('subject')->maxLength(255)->columnSpanFull(),
                    Textarea::make('message')->rows(5)->columnSpanFull(),
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('maroon')
                ->schema([
                    Select::make('status')
                        ->options([
                            'new' => 'New',
                            'contacted' => 'Contacted',
                            'closed' => 'Closed',
                        ])
                        ->default('new')
                        ->required(),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact')
                ->icon(Heroicon::OutlinedUserGroup)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')->weight('bold'),
                    TextEntry::make('email')->icon(Heroicon::OutlinedEnvelope)->copyable(),
                    TextEntry::make('phone')->icon(Heroicon::OutlinedPhone)->placeholder('-'),
                    TextEntry::make('safariPackage.title')->label('Tour Package')->placeholder('-'),
                ]),

            Section::make('Message')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                ->iconColor('gold')
                ->schema([
                    TextEntry::make('subject')->placeholder('-')->columnSpanFull(),
                    TextEntry::make('message')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('maroon')
                ->schema([
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'new' => 'warning',
                            'contacted' => 'blue',
                            'closed' => 'success',
                            default => 'gray',
                        }),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('subject')->searchable(),
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
            'index' => ListInquiries::route('/'),
            'create' => CreateInquiry::route('/create'),
            'view' => ViewInquiry::route('/{record}'),
            'edit' => EditInquiry::route('/{record}/edit'),
        ];
    }
}
